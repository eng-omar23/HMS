<?php
require_once "../../conn.php";
require_once "../functions.php";

$hallId = trim($_POST['hallId']);
$bookId = trim($_POST['bookid']);
$customerId = trim($_POST['cid']);
$startDate = trim($_POST['startDate']);
$endDate = trim($_POST['endDate']);
$starttime = trim($_POST['starttime']);
$endtime = trim($_POST['endtime']);
$bookStatus = trim($_POST['bstatus']);
$attendee = trim($_POST['attend']);
$rate = trim($_POST['rate']);
$date = date('Y-m-d');
$credit = 0;
$bookingType=0;
$selectedFacilities = isset($_POST['facility_id']) ? $_POST['facility_id'] : [];
$food = $_POST['food'];



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

// Ensure required fields are not empty
if (empty($bookId)) {
// Insert into bookings table
$sql = "INSERT INTO bookings (hall_id, customer_id, start_date, end_date, booking_status,bookingType, attendee, rate, created_at)
        VALUES ('$hallId', '$customerId', '$startDate', '$endDate', '$bookStatus','$bookingType', '$attendee', '$rate', '$date')";
$query = mysqli_query($conn, $sql);
$lastInsertedID = mysqli_insert_id($conn);

if ($query) {
    // Calculate debit amount
    if ($food == null && empty($food)) {

        $duration = calculateTimeDuration($starttime, $endtime);
        $newRate = getHallPrice($conn, $hallId);
       $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
       $debit = calculateDebit($newRate, $duration);
       $totalDebit = $debit + $totalFacilityPrice;
    $sql="update bookings set Rate= '$newRate' where booking_id='$lastInsertedID'";
    $query=mysqli_query($conn,$sql);
    } 
    else{ 
        $debit = calculateDebit($rate, $attendee);
        $totalFacilityPrice = calculateFacilityPrice($selectedFacilities, $conn);
        $totalDebit = $debit + $totalFacilityPrice;
    }

    // Insert into transactions table
    $transactionSql = "INSERT INTO transactions (refID, custid, credit, transactionDate, debit) 
                       VALUES ('$lastInsertedID', '$customerId', '$credit', '$date', '$totalDebit')";
    $transactionQuery = mysqli_query($conn, $transactionSql);

    if ($transactionQuery) {
        $result = [
            'message' => 'Booking created successfully.',
            'status' => 200
        ];
        echo json_encode($result);
    } else {
        $result = [
            'message' => 'Failed to create transaction.',
            'status' => 404
        ];
        echo json_encode($result);
    }
} else {
    $result = [
        'message' => 'Failed to create booking.',
        'status' => 404
    ];
    echo json_encode($result);
}
}
?>
