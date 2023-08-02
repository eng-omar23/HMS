<?php
session_start();
require_once "../../conn.php";
require_once "../functions.php";

// Check if the customer ID is set in the session
if (!isset($_SESSION['email'])) {
    $result = [
        'message' => 'Customer ID Not Found.',
        'status' => 404
    ];
    echo json_encode($result);
    exit;
}

$hall_id = $_POST['hid'];
$bid = $_POST['bid'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$stime = $_POST['starttime'];
$etime = $_POST['endtime'];
$attend = $_POST['attend'];
$food = $_POST['food'];
$credit = $_POST['upfront'];
$date = date('y-m-d');
$bookingStatus = 0;
$bookingType = 0;
$rate = 0;
$customerID = 0;
$email = $_SESSION['email'];
$facility_ids = isset($_POST['facility_id']) ? $_POST['facility_id'] : [];

if (isset($_POST['facility_id'])) {
    $selectedCheckboxes = $_POST['facility_id'];

    // Process the selected checkboxes as needed
    foreach ($selectedCheckboxes as $checkboxValue) {
        // Perform further processing or database operations
        array_push($facility_ids, $checkboxValue);
    }
} else {
    $result = [
        'message' => 'No checkboxes selected.',
        'status' => 404
    ];
    echo json_encode($result);
    exit;
}

// Get the customer ID from the session
$sql = "SELECT * FROM customers WHERE email = '$email'";
$customerID = getCustomerID($conn, $sql);

if (empty($bid)) {
    if (empty($startDate) || empty($endDate) || empty($stime) || empty($etime) || empty($attend)) {
        $result = [
            'message' => 'All fields are required.',
            'status' => 404
        ];
        echo json_encode($result);
        exit;
    }

    // Insert data into the database using prepared statement
    $sql = "INSERT INTO bookings
            (hall_id, customer_id, start_date, end_date, starttime, endtime, booking_status,
            bookingType, attendee, Rate, foodId) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iisssiiisii", $hall_id, $customerID, $startDate, $endDate, $stime, $etime,
        $bookingStatus, $bookingType, $attend, $rate, $food);

    $query = mysqli_stmt_execute($stmt);
    $lastInsertedID = mysqli_insert_id($conn);

    if ($query) {
        // Calculate debit amount
        if ($food == null && empty($food)) {
            $duration = calculateTimeDuration($stime, $etime);
            $newRate = getHallPrice($conn, $hall_id);
            $totalFacilityPrice = calculateFacilityPrice($facility_ids, $conn);
            $debit = calculateDebit($newRate, $duration);
            $totalDebit = $debit + $totalFacilityPrice;
            $sql = "UPDATE bookings SET Rate = ?, bookingType = '1' WHERE booking_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "di", $newRate, $lastInsertedID);
            $query = mysqli_stmt_execute($stmt);
        } else {
            $rate = getFoodPrice($conn, $food);
            $debit = calculateDebit($rate, $attend);
            $totalFacilityPrice = calculateFacilityPrice($facility_ids, $conn);
            $totalDebit = $debit + $totalFacilityPrice;
            $sql = "UPDATE bookings SET Rate = ?, bookingType = '0' WHERE booking_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "di", $rate, $lastInsertedID);
            $query = mysqli_stmt_execute($stmt);
        }

        // Insert into transactions table
        $transactionSql = "INSERT INTO transactions (refID, tranType, custid, credit, transactionDate, debit) 
                           VALUES (?, 'cusBooking', ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $transactionSql);
        mysqli_stmt_bind_param($stmt, "iidsd", $lastInsertedID, $customerID, $credit, $date, $totalDebit);
        $transactionQuery = mysqli_stmt_execute($stmt);

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
