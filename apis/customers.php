<?php
use function PHPSTORM_META\type;

require '../conn.php';

$cname = @$_POST['cname'];
$cid = @$_POST['cid'];
$address = @$_POST['address'];
$email = @$_POST['email'];
$phone = @$_POST["number"];
$date= date('y-m-d');

if (empty($cid)) {
    if (empty($address) && empty($email) && empty($phone) && empty($cname)) {

    } 
    else {

        $sql = "insert into customers values (null,'$cname','$phone','$address','$email','$date')";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $result = [
                'message' => 'successfully inserted a new row',
                'status' => 200
            ];
            echo json_encode($result);
            return;
        } else {

            $result = [
                'message' => 'Could Not Create new Hall',
                'status' => 404
            ];
            echo json_encode($result);
            return;
        }
    }
} else {
    $sql = "update customers set firstname='$cname',address='$address',email='$email',phone='$phone' where custid='$cid' ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
       
        $result = [
            'message' => 'successfully Updated a new row',
            'status' => 200
        ];
        echo json_encode($result);
        return;
    } else {

        $result = [
            'message' => 'Could Not Updated',
            'status' => 404
        ];
        echo json_encode($result);
        return;
    }

    
}

if (isset($_POST['itemId'])) {
    $itemId = $_POST['itemId'];
    $success = deleteItemFromDatabase($itemId, $conn);
    if ($success) {
        echo "success.";
        exit(); 
    } else {
        echo "Failed to delete the item.";
    }
}

// Function to delete the item from the database
function deleteItemFromDatabase($itemId, $conn) {

    $sql = "delete from customers where custid = '$itemId' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}


if (isset($_POST['custid'])) {
    $id = $_POST['custid'];
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT * FROM customers WHERE custid= '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $hallData = [
            'cid' => $row['custid'],
            'cname' => $row['firstname'],
            'caddress' => $row['address'],
            'cphone' => $row['phone'],
            'cemail' => $row['email'],
            
        ];
        echo json_encode($hallData);
    } else {
        echo json_encode(['error' => 'Customer Not found']);
    }
}