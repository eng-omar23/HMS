

<style>
  
</style>
<?php
session_start();
include_once "../../../conn.php";
include_once 'header.php'; 
include_once 'nav.php'; 




?>

 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Booking</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="element mt5">
        <!-- Content of the element -->
 

<div class="row">
                            
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
                                                        
                                                    </div>
                                                </form>
                                                
                                                <div class="table-responsive mt-2">
                                                    <table class="table table-hover datatable dt-responsive nowrap" id ="tblBooking" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">HallName</th>
                                                                <th scope="col">Customer</th>
                                                                <th scope="col">StarDate</th>
                                                                <th scope="col">EndDate</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Attendee</th>
                                                                <th scope="col">Rate</th>
                                                                <th scope="col">Balance</th>
                                                                <th scope="col">date</th>
                                                                <th scope="col">Actions</th>
                                                              
                                                            </tr>
                                                            
                                                        </thead>
                                                        <?php
                                                        $email=$_SESSION['email'];
                                                        
                // Select query
                $sql = "SELECT
                b.bookingType AS btype,
                b.booking_id AS id,
                DATE(b.created_at) AS bdate,
                b.updated_at AS bupdatedate,
                c.firstname AS cname,
                b.booking_status AS STATUS,
                h.hall_type AS htype,
                b.start_date AS sdate,
                b.end_date AS edate,
                b.attendee AS attend,
                b.Rate AS rate,
                SUM(tr.debit - tr.credit) AS balance
            FROM
                hbs.bookings b
            LEFT JOIN
                hbs.transactions tr ON b.booking_id = tr.refID
            LEFT JOIN
                hbs.customers c ON c.custid = tr.custid
            LEFT JOIN
                hbs.halls h ON h.hall_id = b.hall_id
            WHERE
                c.email = '$email'
            GROUP BY
                b.booking_id;
            ";
                $result = mysqli_query($conn, $sql);
                $n=1;
                // Check if the query was successful
                if ($result) {
                    //Check if there are any rows returned
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cname  = $row['cname'];
                            $id  = $row['id'];
                            $status = $row['STATUS'];
                            $rate = $row['rate'];
                            $htype  = $row['htype'];
                            $sdate = $row['sdate'];
                            $edate = $row['edate'];
                            $attend = $row['attend'];
                            $balance = $row['balance'];
                            $btype=$row['btype'];
                            $date = $row['bdate'];
                            // $date = $row['bdate'];
                            
                            // Display the data
                        
                            echo "<tr>";
                            echo "<td>$n</td>";   
                            echo "<td>$htype</td>";                      
                            echo "<td>$cname</td>";                         
                            echo "<td>$sdate</td>";                         
                            echo "<td>$edate</td>";     
                                          
                          
                           if($status==0){
                            echo "<td style='color: green;font-weight: bold; font-style: normal;'>Pending</td>";
                           }
                           else if($status==1){
                           echo "<td style='color: blue; font-weight: bold; font-style: italic;'>Approved</td>";
                           }
                           else {
                            echo "<td style='color: Red; font-weight: bold; font-style: italic;'>Cancelled</td>";
                           }
                           if($btype==0){
                            echo "<td>onlyHall</td>";
                           }
                           else{
                            echo "<td>withFood</td>";
                           }
                   
                            echo "<td>$attend</td>";
                            echo "<td>$rate</td>";
                            
                          
                            echo "<td>$balance</td>";
                            echo "<td>$date</td>";
                            echo "<td>
                            <li class='list-inline-item'>
                            <a href='#' class='text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' data-id='$bid'><i class='fas fa-check-circle'></i></a>
                            </li>
                            <li class='list-inline-item'>
                            <a href='#' class='text-danger p-2 delete-btn' data-item-id='$bid'> <i class='fas fa-times-circle'></i></a>
                        </li></td>";
echo "</tr>";
                         ?>

                    <!-- //     <td>
                    //     <button class='btn btn-dark btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false' data-item-id='<?php echo $id; ?>'>Action</button>
                    //     <div class='dropdown-menu dropdown-menu-sm' >
                    //         <a class='dropdown-item text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-edit-alt'></i>Update</a>
                    //         <a class='dropdown-item text-danger p-2 receipt-btn' data-bs-toggle='modal' data-bs-target='.receiptModal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-edit-alt'></i>Reception</a>
                    //         <a class='dropdown-item text-secondary p-2 delete-btn' data-bs-toggle='modal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-trash'></i>Delete</a>
                    //         <a class='dropdown-item text-dark p-2 refund-btn' data-bs-toggle='modal' data-bs-target='.refundModal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-edit-alt'></i>Refund</a>
                    //         <a class='dropdown-item text-warning p-2 discount-btn' data-bs-toggle='modal' data-bs-target='.discountModal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-edit-alt'></i>Discount</a>
                    //         <a class='dropdown-item text-secondary p-2 cancel-btn-btn' data-bs-toggle='modal' data-item-id='<?php echo $id; ?>' href='#'><i class='bx bxs-cancel'></i><i class='bx bxs-edit-alt'></i>Cancel</a>
                    //     </div>
                    // </td> -->
                    <?php
                    
                            // echo "</tr>";
                            $n+=+1;
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Booking found</td></tr>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
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
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>