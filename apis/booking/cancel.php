<?php
require '../../conn.php';
require '../functions.php';

if (isset($_POST['cancelid'])) {
    $itemId = $_POST['cancelid'];
    $sql="UPDATE bookings set booking_status =3 where booking_id='$itemId'";
    $query = mysqli_query($conn, $sql);
 
    if ($query) {
      
        echo "cancalled This Record.";
        
    } else {
        echo "Failed to delete the item.";
    }
}