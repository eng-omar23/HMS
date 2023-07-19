
<?php

// require '../conn.php';
// Function to delete the item from the database
function allqueryHandler($conn, $sql) {
    $query = mysqli_query($conn, $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}
function if_record_exists($conn,$sql){
    $query=mysqli_query($conn,$sql);
    if ($query && mysqli_num_rows($query)){
        return true;
    }
    return false;

    }

 //calculate the debit 
function calculateDebit($rate,$attendee){
    if(empty($rate)){
        return 0;
    }
    else if (empty($attendee)){
        return 0;
    }
    $result = $rate * $attendee;
    return $result;
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

function getHallPrice($conn, $hallId) {
    $sql = "SELECT * FROM halls WHERE hall_id = '$hallId'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $result = mysqli_fetch_array($query);
        $hallPrice = $result['hallPrice'];
        if ($hallId <= 0){
            return 0;

        }
        else{
            return $hallPrice;
        }
    }
    else{
        return 0;
    }
      
}




function calculateTimeDuration($startTime, $endTime) {
    $start = strtotime($startTime);
    $end = strtotime($endTime);

    // Calculate the duration in seconds
    $duration = $end - $start;

    // Convert seconds to hours
    $durationInHours = $duration / 3600;

    return $durationInHours;
}
// $starttime = "09:00";
// $endtime = "11:30";

// $duration = calculateTimeDuration($starttime, $endtime);
// echo "Duration: $duration hours";