
<?php
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

 