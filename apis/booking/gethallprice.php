<?php
require_once "../../conn.php";
require_once "../functions.php";


if (isset($_POST['hid'])) {
    $id = $_POST['hid'];
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM halls WHERE hall_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $hallpriceData = [
            'hprice' => $row['hallPrice'],
           
        ];
        echo json_encode($hallpriceData);
    } else {
        echo json_encode(['error' => 'Food not found']);
    }
}


// gooooooood joop

