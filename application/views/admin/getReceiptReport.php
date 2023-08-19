<?php

//header('Content-Type: application/json');

include '../../../conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a table named 'employees' in your database
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Sanitize the input to prevent SQL injection (assuming 'startDate' and 'endDate' are date values)
    $startDate = mysqli_real_escape_string($conn, $startDate);
    $endDate = mysqli_real_escape_string($conn, $endDate);

    // Fetch data from the database based on the date range
    $sql = "SELECT c.custid, c.firstname AS customer_name, c.phone AS customer_phone, c.address AS customer_address, c.email AS customer_email, t.tranID AS transaction_id, t.tranType AS transaction_type, t.transactionDate AS transaction_date, t.credit, t.debit FROM customers c JOIN transactions t ON c.custid = t.custid WHERE t.transactionDate BETWEEN '$startDate' AND '$endDate' ORDER BY c.custid, t.transactionDate DESC";

    $result = mysqli_query($conn, $sql);

    $data = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

}
?>

