<?php 

use function PHPSTORM_META\type;

require '../conn.php';


$Facility_id = @$_POST['fac_id'];
$Facility_name = @$_POST['fname'];
$price = @$_POST['price'];


if (empty($Facility_id)){

    if (empty($Facility_name) && empty($price )){

    }
    else{

        $sql = "INSERT INTO facility (facility_name, Price)
        VALUES ('$Facility_name', '$price')";
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
        'message' => 'Could Not Create new Facility',
        'status' => 404
    ];
    echo json_encode($result);
    return;
}

    }

}else {

    $sql = "update facility set facility_name='$Facility_name',Price='$price' where facility_id='$Facility_id' ";
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
            'message' => 'Could Not Create new Facility',
            'status' => 404
        ];
        echo json_encode($result);
        return;
    }
    


}

if (isset($_POST['fac_id'])) {
    $id = $_POST['fac_id'];
    $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT facility_id,facility_name,Price FROM facility WHERE facility_id= '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $faciData = [
            'fac_id' => $row['facility_id'],
            'fname' => $row['facility_name'],
            'price' => $row['Price'],
            
        ];
        echo json_encode($faciData);
    } else {
        echo json_encode(['error' => 'Facility not found']);
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

function deleteItemFromDatabase($itemId, $conn) {

    $sql = "delete from facility where facility_id = '$itemId' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        return true;
    } else {
        return false;
    }
}

?>

