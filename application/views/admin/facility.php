<?php include 'header.php'; 
include 'nav.php'; 
include '../../../conn.php'; ?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- CSS styles -->
<style>
.btn-primary {
    color: #fff;
    background-color: #00487a !important;
    border-color: #00487a !important;
}

.selected-image-container {
    text-align: center;
}

#selected-image {
    max-width: 100%;
    max-height: 200px;
    border-radius: 50px;
}

.logo-thumbnail {
    max-width: 100px;
    max-height: 100px;
    border-radius: 50px;
}
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Facility</h4>

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
                                            <!-- <div class="col-xl col-sm-6">
                                            </div>
                                            <div class="col-xl col-sm-6">
                                            </div> -->
                                            <div class="col-xl col-sm-6 align-self-end">
                                                <div class="mb-3">
                                                    <button type="button" id="openModal"
                                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                                        data-bs-toggle="modal" data-bs-target=".facilityModal"><i
                                                            class="mdi mdi-plus me-1"></i> Add Facility</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive mt-2">
                                        <table class="table table-hover datatable dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Facility Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    

                                                    // Select query
                                                    $sql = "SELECT `facility_id`, `facility_name`, `Price` FROM `facility` WHERE 1";
                                                    $result = mysqli_query($conn, $sql);

                                                    // Check if the query was successful
                                                    if ($result) {
                                                        // Check if there are any rows returned
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $Facility_id = $row['facility_id'];
                                                                $Facility_name = $row['facility_name'];
                                                                $price = $row['Price'];
                                                              

                                                                // Display the data
                                                                echo "<tr>";
                                                                echo "<td>$Facility_id</td>";
                                                                echo "<td>$Facility_name</td>";
                                                                echo "<td>$price</td>";
                                                                echo "<td>

                                                               
                                                                <li class='list-inline-item'>
                                                                <a href='#' class='text-success p-2 edit-btn' data-bs-toggle='modal' data-bs-target='.facilityModal' data-id=$Facility_id'><i class='bx bxs-edit-alt'></i></a>
                                                                </li>
                                                                <li class='list-inline-item'>
                                                                <a href='#' class='text-danger p-2 delete-btn' data-item-id=$Facility_id'><i class='bx bxs-trash'></i></a>
                                                                </li></td>";
                                                                echo "</tr>";

                                                                
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='6'>Not found Facility</td></tr>";
                                                        }
                                                    } else {
                                                        echo "Error: " . mysqli_error($conn);
                                                    }

                                                    mysqli_close($conn);
                                                ?>
                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
        </div><!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    <!-- Modal -->
    <div class="modal fade facilityModal"  id="facilityModal" tabindex="-1" role="dialog" aria-labelledby="facilityModalarielabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="facilityModalarielabel">Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form method = "post" id="facility_form" action = "../../../apis/facilities.php">
                        <div class="alert alert-danger" id="error"> </div>
                        <div class="alert alert-success" id="success"></div>
                        <input type="hidden" name="facility_id" id="facility_id">



                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label">Facility Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                placeholder="Enter Facility Name">
                        </div>

                        <div class="row">
                            <div class="col-md-13">
                                <div class="mb-3">
                                    <label for="formrow-address-input" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter Price">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnSubmit" class="btn btn-primary" data-bs-dismiss="modal">Save
                                Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
<!-- end main content-->


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

            $("#facility_form").submit(function(e){   
                e.preventDefault();
                $.ajax({
                    url:"../../../apis/facilities.php",
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
                    window.location.href = 'facility.php';
                    //    $("#success").css("display", "block");
                    //     $("#success").text(res.message);
                      }     else if (res.status == 404) {
                    //   $("#success").css("display", "none");
                    //    $("#error").css("display", "block");
                    //    $("#error").text(res.message);
                    }
            
                 }
             });


          });

          $(document).ready(function() {
            $('.edit-btn').click(function() {
                var fac_id = parseInt($(this).data('id'), 10);
                $.ajax({
                url: '../../../apis/facilities.php',
                type: 'POST',
                data: { fac_id: fac_id },
                success: function(response) {
                alert(response)
                var faciData = JSON.parse(response);
                
                console.log(faciData.fac_id);
                $('#fname').val(faciData.fname);
                $('#price').val(faciData.price);
               
            }
        });
    });
});


function deleteItem(itemId) {
    $.ajax({
        url: '../../../apis/facilities.php',
        method: 'POST',
        data: { itemId: itemId },
        success: function(response) {
            window.location.href = 'facility.php';
            console.log(response);
            // Reload the page or update the UI as needed
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(error);
        }
    });
}





     </script>

