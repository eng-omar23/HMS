<?php include 'header.php'; ?>
<?php include 'nav.php'; ?>   
<?php include '../../../conn.php'; ?>   
<style>
  .checkbox-label {
    display: inline-block;
    margin-left: 5px;
    font-size: 12px;
    font-weight: bold;
 
    color: #333;
  }

  .custom-checkbox {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 20px;
   
    height: 20px;
    border: 2px solid #ccc;
    border-radius: 4px;
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
  }

  .custom-checkbox:checked {
    background-color: #2196F3;
    border-color: #2196F3;
  }

  .custom-checkbox:focus {
    box-shadow: 0 0 3px #2196F3;
  }
</style>



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
<!-- end page title -->
                        <div class="row">
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
                                                            <div class="mb-3">
                                                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".orderdetailsModal"><i class="mdi mdi-plus me-1"></i></button>
                                                            </div>
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
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <?php
                // Select query
                $sql = "SELECT  b.bookingType as btype, b.booking_id AS id, DATE(b.created_at) AS bdate, b.updated_at AS bupdatedate, c.firstname AS cname, b.booking_status AS STATUS, h.hall_type AS htype, b.start_date AS sdate, b.end_date AS edate, b.attendee AS attend, b.Rate AS rate, SUM(tr.debit - tr.credit) AS balance FROM hbs.bookings b LEFT JOIN hbs.transactions tr ON b.booking_id = tr.refID LEFT JOIN hbs.customers c ON c.custid = tr.custid LEFT JOIN hbs.halls h ON h.hall_id = b.hall_id GROUP BY b.booking_id";
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
                            <a href='#' class='text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' data-id='$id '><i class='bx bxs-edit-alt'></i></a>
                            </li>
                            <li class='list-inline-item'>
                            <a href='#' class='text-danger p-2 delete-btn' data-item-id='$id '><i class='bx bxs-trash'></i></a>
                        </li>
                    
                        
                     
                    
                        
                        </td>";
                            echo "</tr>";
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
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <!-- Modal -->
                <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                         
                                <h5 class="modal-title" id="orderdetailsModalLabel">Booking</h5>
                              
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          
                            <div class="modal-body">
                            <div class="alert alert-danger" id="error"> </div>
                              <div class="alert alert-success" id="success"></div>
                            <form id="Book" method="post" action="../../../apis/booking/book.php" >
                            <input type="hidden" class="form-control" id="bookid" name="bookid">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                    <label for="formrow-address-input" class="form-label">Hall Name</label>
                                        <select class="form-select" name="hallId" id="hallId">
                                        <?php
                                        $query="select * from halls";
                                        $result=mysqli_query($conn,$query);
                                        ?>
                                        <option value=""> Choose Halls </option>
                                        <?php
                                        if($result&& mysqli_num_rows($result)>0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                <option value="<?php echo $row['hall_id']?>"><?php echo $row['hall_type']?></option>
                                                <?php
                                            }

                                        }
                                        else{
                                            ?>
                                            <option> NO Data found</option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                    <label for="formrow-address-input" class="form-label">Customer Name</label>
                                        <select class="form-select" aria-label="Default select example" name="cid" id="cid">

                                        <?php
                                        $sql="select * from customers";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0 ){
                                      ?>
                                            <option value=""> Choose Customer </option>
                                            <?php
                                            while($row = mysqli_fetch_array($result)){
                                                ?>
                                           
                                                <option value="<?php echo $row['custid']?>"><?php echo $row['firstname']?></option>
                                                <?php
                                            }

                                        }
                                        else{
                                            ?>
                                            <option> NO Data found</option>
                                            <?php
                                        }
                                        ?>
                                                
                                        </select>
                                    </div>
                                </div>

                            </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-address-input" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" id="startDate" name="startDate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">End Date</label>
                                                <input type="date" class="form-control" id="endDate" name="endDate" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-address-input" class="form-label">Start Time</label>
                                                <input type="time" class="form-control" id="starttime" name="starttime">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">End Time</label>
                                                <input type="time" class="form-control" id="endtime" name="endtime" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                    <label for="formrow-address-input" class="form-label">Book Status</label>
                                        <select class="form-select" aria-label="Default select example" name="bstatus" id="bstatus">
                                                <option value="">Choose Booking Status</option>
                                                <option value="0">pending</option>
                                                <option value="1">approved</option>
                                                <option value="2">cancelled</option>
                                                
                                         </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">attend</label>
                                                <input type="text" class="form-control" id="attend" name="attend" placeholder="Enter Attendee">
                                            </div>
                                            

                                </div>
                                </div>
                                            
                                <div class="row">
                             
                                <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Food">Food</label>
                                    <select name="food" class="form-control" id="food">
                                    <?php

                                        $sql="select * from food";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0 ){
                                            ?>
                                            <option value="">choose food Type </option>
                                            <?php
                                            while($row = mysqli_fetch_array($result)){
                                  
                                                ?>
                                              
                                               
                                                <option value="<?php echo $row['foodPrice']?>"><?php echo $row['foodType']?></option>
                                                <?php
                                            }

                                        }
                                        else{
                                            ?>
                                            <option> NO Data found</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                            <label for="formrow-email-input" class="form-label">Rate</label>
                                                <input type="text" class="form-control" id="rate" name="rate" readonly=true>
                                          
                                </div>
                                </div>
                               
                             
                                </div>  
                                            
                                           <div class="mb-3">
                                            <?php
                                        $sql="select * from facility";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0 ){
                                            ?>
                                            <h6>choose Facility</h1>
                                            <?php
                                            while($row = mysqli_fetch_array($result)){
                                                ?>  
                                         
                                                 <label for="checkbox" class="form-label" class="checkbox-label">  <?php echo $row['facility_name']?></label>        
                                            <input type="checkbox" class="custom-checkbox" id="<?php echo $row['facility_id[]']?>" name="facility_id[]" value="<?php echo $row['facility_id']?>">
                                                <?php
                                            }

                                        }
                                        else{
                                            ?>
                                            <option> NO Data found</option>
                                            <?php
                                        }
                                        ?>
                                           

                                            </div>

                                            <div class="row">
                           
                                    </div>
                                   
                                    </div>
                                    <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"  id="btnbooking">Save Changes</button>
                                
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
                           
                            </div>
                                </form>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <!-- end modal -->
         
    </div>

    <?php include 'footer.php'; ?>

    <script>
        $(document).ready(function(){
           
     
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        deleteItem(itemId);
    });
   
    $("#error").css("display", "none");
    $("#success").css("display", "none");
   
                })
    $("#Book").submit(function(e){   
             e.preventDefault();
             $.ajax({
                url:"../../../apis/booking/book.php",
                 data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                 method: 'POST',
                type: 'POST',
                success: function(resp) {
                alert(resp)
                 var res = jQuery.parseJSON(resp);
                 if (res.status == 200) {
                    
                   $("#success").css("display", "block");
                    $("#success").text(res.message);
                    window.location.href = 'Booking.php';
              }     else if (res.status == 404) {
                //   $("#success").css("display", "none");
                //    $("#error").css("display", "block");
                //    $("#error").text(res.message);
              }
            
                 }
             });


         });
           
   
 

   
    $('.edit-btn').click(function() {
        var cid = parseInt($(this).data('id'), 10);
        $.ajax({
            url:"../../../api/booking/getBooking.php",
            type: 'POST',
            data: { custid: cid },
            success: function(response) {
                alert(response)
                var customerData = JSON.parse(response);
                
                console.log(customerData.cname);
                $('#cname').val(customerData.cname);
                $('#cid').val(customerData.cid);
                $('#address').val(customerData.caddress);
                $('#number').val(customerData.cphone);
                $('#email').val(customerData.cemail);
          
          
            }
        });
    });



function deleteItem(itemId) {
    $.ajax({
        url:"../../../apis/booking/delete.php",
        method: 'POST',
        data: { itemId: itemId },
        success: function(response) {
            window.location.href = 'booking.php';
            console.log(response);
            // Reload the page or update the UI as needed
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
        }
    });
}




  // Get references to the select element and the textbox
  const selectElement = document.getElementById('food');
  const textboxElement = document.getElementById('rate');

  // Listen for the change event on the select element
  selectElement.addEventListener('change', function() {
    // Set the value of the textbox to the selected option value
    textboxElement.value = selectElement.value;
  });
</script>
<!-- 
goood jop -->