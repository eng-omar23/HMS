<?php
session_start();
require_once "../../conn.php";
require_once "../functions.php";

// Check if the customer ID is set in the session
if (empty($_SESSION['email'])) {
    $result = [
        'message' => 'Customer ID Not Found.',
        'status' => 404
    ];
    echo json_encode($result);
    exit;
}

// Sanitize and validate input data
$hallId = intval($_POST['hid']);
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$attendee = $_POST['attend'];
$food = $_POST['food'];
$upfront = floatval($_POST['upfront']);
$date = date('Y-m-d');
$facility_ids = isset($_POST['facility_id']) ? $_POST['facility_id'] : [];
$emal=$_SESSION['email'];

// Function to handle facilities checkboxes
function handleFacilities(&$selectedFacilities) {
    if (isset($_POST['facility_id'])) {
        $selectedCheckboxes = $_POST['facility_id'];
        // Process the selected checkboxes as needed
        foreach ($selectedCheckboxes as $checkboxValue) {
            // Perform further processing or database operations
            array_push($selectedFacilities, intval($checkboxValue));
        }
    } else {
        echo "No checkboxes selected.";
    }
}



// Start transaction
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

try {

    // Insert into bookings table
    $sql = "INSERT INTO bookings (hall_id, customer_id, start_date, end_date, starttime, endtime, booking_status, bookingType, attendee, rate, created_at, foodid)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $customerId =getCustomerIdbasedonEmail($conn,$email);// Assuming the customer_id is stored in the session
    $bookStatus = 0; // Assuming default booking status
    $bookingType = 0; // Assuming default booking type
    $rate = 0; // Default rate, you may need to set this differently
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $hallId, $customerId, $startDate, $endDate, $starttime, $endtime, $bookStatus, $bookingType, $attendee, $rate, $date, $food);
    mysqli_stmt_execute($stmt);
    $lastInsertedID = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    // Insert selected facilities into booking_facility table
    $sql = "INSERT INTO booking_facility (booking_id, facility_id, date) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    foreach ($facility_ids as $facility_id) {
        mysqli_stmt_bind_param($stmt, "iss", $lastInsertedID, $facility_id, $date);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);

    handleFacilities($selectedFacilities);

    // Calculate debit amount and update Rate
    if ($food == null && empty($food)) {
        $duration = calculateTimeDuration($starttime, $endtime);
        $newRate = getHallPrice($conn, $hallId);
       
        $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
        $debit = calculateDebit($newRate, $duration);
        $totalDebit = $debit + $totalFacilityPrice;
        $sql = "UPDATE bookings SET Rate = ?, bookingType = '1' WHERE booking_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $newRate, $lastInsertedID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $rate = getFoodprice($conn, $food);
        $selectedFacilities = [];
        $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
        $debit = calculateDebit($rate, $attendee);
        $totalDebit = $debit + $totalFacilityPrice;
        $sql = "UPDATE bookings SET Rate = ?, bookingType = '0' WHERE booking_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $rate, $lastInsertedID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Insert into transactions table
    $booking='Booking';
    // Insert into transactions table
    $transactionSql = "INSERT INTO transactions (refID, tranType, custid, credit, transactionDate, debit) 
                       VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $transactionSql);
    mysqli_stmt_bind_param($stmt, "ssssss", $lastInsertedID, $booking, $customerId, $credit, $date, $totalDebit);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Commit the transaction
    mysqli_commit($conn);

    $result = [
        'message' => 'Booking created successfully.',
        'status' => 200
    ];
    echo json_encode($result);
  

} catch (Exception $e) {
    // Rollback the transaction in case of any error
    mysqli_rollback($conn);
    $result = [
        'message' => 'Booking failed.',
        'status' => 200
    ];
    echo json_encode($result);
}
?>
