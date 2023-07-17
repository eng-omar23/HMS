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
 $selectedFacilities = [];
 $food=$_POST['food'];


 function getHallPrice($conn,$sql){
    $query=mysqli_query($conn,$sql);
    if($query &&  $row=mysqli_fetch_row($query)){
       
        return $row;
    }
return 0;
   
 }

//  if(empty($food)){
//     $sql="select "
    
//  }

 


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

function calculateFacilityPrice($facilityIds, $conn) {
    // Convert the array of facility IDs to a comma-separated string
    $facilityIdsString = implode(',', $facilityIds);

    // Query to get the sum of prices for the selected facilities
    $sql = "SELECT SUM(Price) AS total FROM facility WHERE facility_id IN ($facilityIdsString)";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalPrice = $row['total'];
        return $totalPrice;
    }

    return 0; // Return 0 if no facilities or prices found
}


if($bookId==null && empty($bookId)){

//check if the textbox empty and trim them before insertion
   

$sql = "INSERT INTO bookings
        VALUES (null,'$hallId', '$customerId', '$startDate', '$endDate', '$bookStatus', '$attendee', '$rate',null,null)";

$query = mysqli_query($conn, $sql);
$lastInsertedID = mysqli_insert_id($conn);

if ($query) {


    // Calculate debit amount
    $debit = calculateDebit($rate, $attendee);
    $totalFacilityPrice = calculateFacilityPrice($selectedFacilities,$conn);
    $totaldebit=$debit+$totalFacilityPrice;
    // Insert into transactions table
    $transactionSql = "INSERT INTO transactions (refID, custid, credit, transactionDate, debit) 
                       VALUES ('$lastInsertedID', '$customerId', '$credit', '$date', '$totaldebit')";

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
