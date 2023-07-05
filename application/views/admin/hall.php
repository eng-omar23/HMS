<?php include 'header.php';  ?>
<?php include 'nav.php';  ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container justify-content-center">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Halls</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Create New Hall</h4>
                                <form class="outer-repeater"  method="post">
                                    <div data-repeater-list="outer-group" class="outer">
                                        <div data-repeater-item class="outer">
                                            <div class="form-group row mb-4">
                                                <label for="hallname" class="col-form-label col-lg-2">Hall Name</label>
                                                <div class="col-lg-6">
                                                    <input id="hallname" name="hallname" type="text" class="form-control" placeholder="Enter Hall Name...">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="hotelname" class="col-form-label col-lg-2">Hotel Name</label>
                                                <div class="col-lg-6">
                                                    <input id="hotelname" name="hotelname" type="text" class="form-control" placeholder="Enter Hotel Name...">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="capacity" class="col-form-label col-lg-2">Capacity</label>
                                                <div class="col-lg-4">
                                                    <input id="capacity" name="capacity" type="text" class="form-control" placeholder="..." required="">
                                                </div>
                                                <label for="price" class="col-form-label col-lg-2">Price Per Person</label>
                                                <div class="col-lg-4">
                                                    <input id="price" name="price" type="text" class="form-control" placeholder="..." required="">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label for="image" class="col-form-label col-lg-2">Hotel Image</label>
                                                <div class="col-lg-6">
                                                    <input id="image" name="image" type="file" class="form-control" placeholder="Enter Hotel Name...">
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                                <div class="row justify-content-start mr">
                                    <div class="col-lg-10">
                                        <button type="submit" class="btn btn-primary float-end">Save Changes</button>
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
    </div>
<?php include 'footer.php';  ?>