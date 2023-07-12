<?php
require_once "../../conn.php";
require_once "../functions.php";

$hallId = $_POST['hallId'];
$bookId = $_POST['bookid'];
$customerId = $_POST['cid'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$bookStatus = $_POST['bstatus'];
$attendee = $_POST['attend'];
$rate = $_POST['rate'];
$date = date('y-m-d');
$credit = 0;

// Perform any necessary data validation here

// Perform the database insert

if($bookId==null && empty($bookId)){


$sql = "INSERT INTO bookings
        VALUES (null,'$hallId', '$customerId', '$startDate', '$endDate', '$bookStatus', '$attendee', '$rate',null,null)";

$query = mysqli_query($conn, $sql);
$lastInsertedID = mysqli_insert_id($conn);

if ($query) {
    // Calculate debit amount
    $debit = calculateDebit($rate, $attendee);

    // Insert into transactions table
    $transactionSql = "INSERT INTO transactions (refID, custid, credit, transactionDate, debit) 
                       VALUES ('$lastInsertedID', '$customerId', '$credit', '$date', '$debit')";

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
            'status' => 400
        ];
        echo json_encode($result);
    }
} else {
    $result = [
        'message' => 'Failed to create booking.',
        'status' => 400
    ];
    echo json_encode($result);
}
}
?>
