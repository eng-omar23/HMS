<?php
session_start();
require_once "../../conn.php";
require_once "../functions.php";

// Check if the customer ID is set in the session
if (empty($_SESSION['email'])) {
    $result = [
        'message' => 'Email ID Not Found.',
        'status' => 404
    ];
    echo json_encode($result);
    exit;
}

// Sanitize and validate input data
$hallId = $_POST['hid'];
$bid = $_POST['bid'];
$startDate = $_POST['startDate']; 
$endDate = $_POST['endDate'];
$starttime = $_POST['starttime'];
$endtime = $_POST['endtime'];
$attendee = $_POST['attend'];
$food = $_POST['food'];
$upfront = floatval($_POST['upfront']);
$date = date('Y-m-d');
$facility_ids = isset($_POST['facility_id']) ? $_POST['facility_id'] : [];
$email=$_SESSION['email'];
$customer_id =3;//getCustomerIdbasedonEmail($conn,$email);

// Function to handle facilities checkboxes
function handleFacilities(&$selectedFacilities) {
    if (isset($_POST['facility_id'])) {
        $selectedCheckboxes = $_POST['facility_id'];
        // Process the selected checkboxes as needed
        foreach ($selectedCheckboxes as $checkboxValue) {
            // Perform further processing or database operations
            array_push($selectedFacilities, $checkboxValue);
        }
    } else {
        echo "No checkboxes selected.";
    }
}

$bookStatus = 0; // Assuming default booking status
$bookingType = 0; // Assuming default booking type
$booking = 'Booking'; // Assuming default booking type
$rate = 0; // Default rate, you may need to set this differently

if (empty($bid)) {
    if (empty($hallId) || empty($startDate) || empty($endDate) || empty($starttime) || empty($endtime) || empty($attendee) || empty($food) || empty($upfront) || empty($facility_ids)) {
        $result = [
            'message' => 'All fields are required.',
            'status' => 400
        ];
        echo json_encode($result);
        exit;
    }

    // Insert the booking record into the "bookings" table
    $sql = "INSERT INTO bookings (hall_id, customer_id, start_date, end_date, starttime, endtime, booking_status, bookingType, attendee, Rate, foodId)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iisssssssdd", $hallId, $customer_id, $startDate, $endDate, $starttime, $endtime, $bookStatus, $bookingType, $attendee, $rate, $food);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        // Get the ID of the last inserted booking
        $lastInsertedID = mysqli_insert_id($conn);

        // Handle facilities checkboxes
        $selectedFacilities = [];
        handleFacilities($selectedFacilities);

        // Insert facilities into the "booking_facility" table
        foreach ($selectedFacilities as $facility_id) {
            $sql = "INSERT INTO booking_facility (booking_id, facility_id, date) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sss", $lastInsertedID, $facility_id, $date);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Calculate rate and update bookingType based on food availability
        if (empty($food)) {
            $duration = calculateTimeDuration($starttime, $endtime);
            $newRate = getHallPrice($conn, $hallId);
            $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
            $debit = calculateDebit($newRate, $duration);
            $totalDebit = $debit + $totalFacilityPrice;

            $sql = "UPDATE bookings SET Rate = ?, bookingType = '1' WHERE booking_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "di", $newRate, $lastInsertedID);
        } else {
            $rate = getFoodprice($conn, $food);
            $selectedFacilities = [];
            $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
            $debit = calculateDebit($rate, $attendee);
            $totalDebit = $debit + $totalFacilityPrice;

            $sql = "UPDATE bookings SET Rate = ?, bookingType = '0' WHERE booking_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "di", $rate, $lastInsertedID);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Insert into transactions table
        $transactionSql = "INSERT INTO transactions (refID, tranType, custid, credit, transactionDate, debit) 
                           VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $transactionSql);
        mysqli_stmt_bind_param($stmt, "isidd", $lastInsertedID, $booking, $customer_id, $upfront, $date, $totalDebit);
        $transactionQuery = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($transactionQuery) {
            $result = [
                'message' => 'Booking created successfully.',
                'status' => 200
            ];
            echo json_encode($result);
        } else {
            $result = [
                'message' => 'Error creating booking.',
                'status' => 500
            ];
            echo json_encode($result);
        }
    } else {
        $result = [
            'message' => 'Error creating booking.',
            'status' => 404
        ];
        echo json_encode($result);
    }
} else {
    $result = [
        'message' => 'Error creating booking.',
        'status' => 404
    ];
    echo json_encode($result);
}
?>
