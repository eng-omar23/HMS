<?php
session_start();
require_once "../../conn.php";
require_once "../functions.php";

$hall_id = $_POST['hall_id'];
$bid = $_POST['bid'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$attend = $_POST['attend'];
$food = $_POST['food'];
$upfront = $_POST['Upfront'];
$date=date('y-m-d');
$bookingStatus = 0;
$bookingType = 0;
$credit = $upfront;
$rate = 0;
$customerID=0;
$email=$_SESSION['email'];
$facility_ids = isset($_POST['facility_id']) ? $_POST['facility_id'] : [];

if (isset($_POST['facility_id'])) {
    $selectedCheckboxes = $_POST['facility_id'];

    // Process the selected checkboxes as needed
    foreach ($selectedCheckboxes as $checkboxValue) {
        // Perform further processing or database operations
        array_push($facility_ids, $checkboxValue);
    }
} else {
    echo "No checkboxes selected.";
}

// Check if the customer ID is set in the session
if (isset($_SESSION['email'])) {
    $sql="select * from customers where email='$email'";
    $customerID = getCustid($conn,$sql);
} else {
    // Handle the case when the customer ID is not set in the session
    echo json_encode(['message' => 'Customer ID not found in session.', 'status' => 404]);
    exit;
}

if ($bid == null || empty($bid)) {

    // Insert data into the database
    $sql = "INSERT INTO bookings (hall_id,customer_id,start_date,end_date,starttime,endtime,booking_status,
    bookingType,attendee,Rate,foodId)
    VALUES ('$hall_id', '$customerID', '$startDate', '$endDate', '$stime', '$etime', 
                    '$bookingStatus', '$bookingType', '$attend','$rate','$food')
                    ";

    $query = mysqli_query($conn, $sql);
    $lastInsertedID = mysqli_insert_id($conn);
    if ($query) {
       
        // // Calculate debit amount
        if ($food == null && empty($food)) {
            $duration = calculateTimeDuration($stime, $etime);
            $newRate = getHallPrice($conn, $hall_id);
            $totalFacilityPrice = calculateFacilityPrice($facility_ids, $conn);
            $debit = calculateDebit($newRate, $duration);
            $totalDebit = $debit + $totalFacilityPrice;
            $sql = "UPDATE bookings SET Rate = '$newRate', bookingType = '1' WHERE booking_id = '$lastInsertedID'";
            $query = mysqli_query($conn, $sql);
        } else {
            $rate = getFoodPrice($conn, $food);
            $debit = calculateDebit($rate, $attend);
            $totalFacilityPrice = calculateFacilityPrice($facility_ids, $conn);
            $totalDebit = $debit + $totalFacilityPrice;
            $sql = "UPDATE bookings SET Rate = '$rate', bookingType = '0' WHERE booking_id = '$lastInsertedID'";
            $query = mysqli_query($conn, $sql);
        }

        // Insert into transactions table
        $transactionSql = "INSERT INTO transactions (refID, tranType, custid, credit, transactionDate, debit) 
                           VALUES ('$lastInsertedID', 'cusBooking', '$customerID', '$credit', '$date', '$totalDebit')";
        $transactionQuery = mysqli_query($conn, $transactionSql);

        if ($transactionQuery) {
            $result = [
                'message' => 'Booking created successfully.',
                'status' => 200
            ];
            echo json_encode($result);
        } 
        else {
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

