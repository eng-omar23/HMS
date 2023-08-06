
<style>
    .mt5{
        margin-top: -55%;
    }
</style>
<?php
session_start(); ?>
<?php 
 include_once '../../../conn.php'; 
include_once 'header.php'; 
include_once 'footer.php'; 

 




// Retrieve the bookings for the customer from the database
$sql = "SELECT * FROM bookings b
        LEFT JOIN customers c ON b.customer_id = c.custid
        LEFT JOIN halls h on h.hall_id=b.hall_id 
       ";
$query = mysqli_query($conn, $sql);
?>
<center>
<div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <div class="tab-pane active" id="all-order" role="tabpanel">
                                        <form>
                                            <div class="row">
                                                <div class="col-xl col-sm-6">
                                                </div>
                                                <div class="col-xl col-sm-6">
                                                </div>
                                                <div class="col-xl col-sm-6">
                                                </div>
                                                <div class="col-xl col-sm-6">
                                                </div>
                                                <div class="col-xl col-sm-6">
                                                </div>
                                                <div class="col-xl col-sm-6 align-self-end">
                                                   
                                                </div>
                                            </div>
                                        </form>



        <div class="table-responsive">
            <table id="tblCustomer" class="table table-bordered dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Hall</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                    $starttime_seconds = strtotime($row['starttime']);
$endtime_seconds = strtotime($row['endtime']);

// Step 2: Calculate the total time in seconds
$total_seconds = $endtime_seconds - $starttime_seconds;

// Step 3: Calculate the total time in hours
$total_hours = $total_seconds / 3600;
                    // Display each booking as a row in the table
                    $bid=$row['booking_id'];
                    $hall=$row['hall_type'];
                    // Step 1: Create a DateTime object from the datetime string
$datetime = new DateTime($row['created_at']);

// Step 2: Format the DateTime object to display only the date
$date = $datetime->format('Y-m-d');
                    echo "<tr>";
                    echo "<td>" . $row['booking_id'] . "</td>";
                    echo "<td>" . $hall. "</td>";
                    // echo "<td>" . $row['starttime'] . "</td>";
                    echo "<td>" . $date. "</td>";
                    echo "<td>" . $total_hours . " hours</td>";
                    // echo "<td>" . $row['endtime'] . "</td>";
                    $bstatus = $row['booking_status'];
                    echo "<td>";
                    if ($bstatus == 0) {
                        echo "Your booking is Pending";
                    } 
                    echo "</td>";
                    echo "<td>
                                                                    <li class='list-inline-item'>
                                                                    <a href='#' class='text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' data-id='$bid'><i class='fas fa-check-circle'></i></a>
                                                                    </li>
                                                                    <li class='list-inline-item'>
                                                                    <a href='#' class='text-danger p-2 delete-btn' data-item-id='$bid'> <i class='fas fa-times-circle'></i></a>
                                                                </li></td>";
                    echo "</tr>";
                }
           
                ?>
                                       </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                </center>
    <!-- Add Bootstrap JS (Optional) -->
    <!-- You can include it at the end of the body tag if needed -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script> -->
</body>
</html>
