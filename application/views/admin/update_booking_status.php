<?php
// Place your database connection code here
// Replace 'your_db_host', 'your_db_username', 'your_db_password', and 'your_db_name' with your actual database credentials
include_once('../../../conn.php');
$id=$_POST['bid'];
 $status=$_POST['booking_status'];


// Check if the AJAX request contains the required data
if (isset($id) && $status='approved') {
    $bid = $_POST['bid'];
    $booking_status = $_POST['booking_status'];
    // Update the booking_status in the database
        $sql="UPDATE bookings SET booking_status = booking_status WHERE booking_id ='$bid'";
        $query=mysqli_query($conn,$sql);
         
if($query){
    $result = [
        'message' => 'successfully Approved ',
        'status' => 200
    ];
    echo json_encode($result);
    return;
}
else {
    $result = [
        'message' => 'Failed to Approved ',
        'status' => 200
    ];
    echo json_encode($result);
    return;
}

}
else if (isset($id) && $status='rejected'){
    $bid = $_POST['bid'];
    $booking_status = $_POST['booking_status'];
    // Update the booking_status in the database
        $sql="UPDATE bookings SET booking_status = booking_status WHERE booking_id ='$bid'";
        $query=mysqli_query($conn,$sql);
         
if($query){
    $result = [
        'message' => 'Successfull Reject this booking',
        'status' => 200
    ];
    echo json_encode($result);
    return;
}
else{
    $result = [
        'message' => 'failed to Reject this booking',
        'status' => 200
    ];
    echo json_encode($result);
    return;
}

}

else{
    $result = [
        'message' => 'No valid data passed in the url',
        'status' => 200
    ];
    echo json_encode($result);
    return;
}
