<?php   session_start(); ?>
<?php include_once 'header.php'; ?>
<?php include_once 'nav.php'; ?>
<?php include_once '../../../conn.php'; ?>
    <!-- end main content-->
    <div class="main-content">
        <!-- START Page-content -->
        <div class="page-content">
            <div class="container-fluid"> <!-- container-fluid -->
<?php 
$email=$_SESSION['email'];
$sql="select * from Customers where email='$email'";
$result=mysqli_query($conn,$sql);
$record=mysqli_fetch_array($result);
$fullname=$record['firstname'];

?>
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18"><?php echo $fullname ?></h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Armaan Halls</a></li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- begin row -->
                <?php

                $sql="select * from halls ";
                $result=mysqli_query($conn,$sql);
                if($result){

                
                if( mysqli_num_rows($result)>0){

                    while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="row">
                       <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 align-self-start">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <img   src= "../../<?php echo $row['hall_photo']?> " height="70px"width="70px" alt="" class="">
                                            </div>
                                            <div class="flex-grow-1 align-self-center">
                                                <div class="text-muted">
                                                    <p class="mb-2">Hall Type ☕</p>
                                                    <h5 class="mb-1"><?php echo $row['hall_type']?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-3 align-self-center">
                                        <div class="text-lg-center mt-4 mt-lg-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted text-truncate mb-2">Capacity</p>
                                                        <h5 class="mb-0"><?php echo $row['capacity']?></h5>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted text-truncate mb-2">Hall Price</p>
                                                        <h5 class="mb-0"><?php echo $row['hallPrice']?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="text-muted text-truncate mb-2">Locattion</p>
                                                        <h5 class="mb-0"><?php echo $row['location']?></h5>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-lg-1 d-none d-lg-block">
                                        <div class="clearfix mt-4 mt-lg-0">
                                            <div class="dropdown float-end">
                                                <button class="btn btn-sm btn-primary dropdown-toggle " data-bs-target=".orderdetailsModal"  data-bs-toggle="modal" data-item-id="<?php echo $id; ?>" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class=""></i>Book Now</button>
                                                <!-- <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Manage Halls</a>
                                                    <a class="dropdown-item" href="#">View Halls</a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
                        <?php
                    }
                }

                }
                else{
                    echo "no Records halls found";
                }

                ?>
               
                <!-- end row -->
                <!-- Modal -->
                <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                         
                                <h5 class="modal-title" id="orderdetailsModalLabel">Booking</h5>
                              
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          
                            <div class="modal-body">
                    
                            <form id="Book" method="post" action="../../../apis/booking/book.php" >
                            <input type="hidden" class="form-control" id="bookid" name="bookid">

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
                            
                            
                                    <div class="mb-3">
                                                <label for="formrow-email-input" class="form-label">attend</label>
                                                <input type="text" class="form-control" id="attend" name="attend" placeholder="Enter Attendee">
                                            </div>
                                            

                                </div>
                              
                                            
                                <div class="row">
                             
                                
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
                                              
                                               
                                                <option value="<?php echo $row['foodId']?>"><?php echo $row['foodType']?></option>
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
                   
                                    <div class="mb-3">
                                            <!-- <label for="formrow-email-input" class="form-label">Rate</label> -->
                                                <input type="hidden" class="form-control" id="rate" name="rate" readonly=true>
                                          
                           
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
                                         
                                                 <!-- <label for="checkbox" class="form-label" class="checkbox-label">  <?php echo $row['facility_name']?></label>         -->
                                            <!-- <input type="checkbox" class="custom-checkbox" id="<?php echo $row['facility_id[]']?>" name="facility_id[]" value="<?php echo $row['facility_id']?>"> -->
                                            <!-- <input type="checkbox" class="custom-checkbox" id="<?php echo $row['facility_id[]']?>" name="facility_id[]" value="<?php echo $row['facility_id']?>"> -->
                                            <!-- <input type="checkbox" class="custom-checkbox" id="facility1" name="facility_id[]" value="1">
                                            <input type="checkbox" class="custom-checkbox" id="facility2" name="facility_id[]" value="2"> -->
                                            <input type="checkbox" id="checkbox" name="facility_id[]" value="1">
<label for="checkbox" class="form-label checkbox-label"><?php echo $row['facility_name']?></label>



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

              
                <!-- end row -->


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
          
    </div>
    <!-- end main content-->
<?php include 'footer.php'; ?>


<script>
       $("#customers").submit(function(e){   
            e.preventDefault();
            $.ajax({
                url:"../../../apis/booking/custBooking.php",
                    data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                    method: 'POST',
                type: 'POST',
                success: function(resp) {
                    var res = jQuery.parseJSON(resp);
                    
                    if (res.status == 200) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'dashboard.php';
                            }
                        });
                    } else if (res.status == 404) {
                        // Use SweetAlert for error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
</script>