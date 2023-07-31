<!doctype html>
<html lang="en">


<!-- Mirrored from skote-h-light.codeigniter.themesbrand.com/auth-login-2 by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jun 2023 12:23:26 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="utf-8" />
<title>HMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- CSS styles -->
    <style>
        .container {
            margin-top: -10%;
        }
        .sign {
            background: #00487a; 
            /* background: #485ec4; */
        }
        .log {
            background: #FFFFFF;
        }
        .col-xl-6 {
         /* border-radius: 20px; */
        }
        .text-center {
            margin-top: 70px;
        }
        .btn-primary {
    color: #fff;
    background-color: #00487a !important;
    border-color: #00487a !important;
}
    </style>

    <!-- owl.carousel css -->
    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="">

    <div>
        <div class="container">
            <div class="row" style="    margin-top: 20%;   ">

                <div class="sign col-xl-6" style="border-radius: 10px 0 0 10px; box-shadow: -5px 5px 10px rgb(49 48 48 / 50%);">
                    <div class="p-md-12 p-2">
                        <div class="w-100">
                            <div class="bg"></div>
                            <div class="d-flex h-100 flex-column">
                                
                                <div class="p-12 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="text-center">

                                                <h4 class="mb-4 text-white"><i class="bx bxs-quote-alt-left text-white h1 align-middle me-3"></i><span class="text-white">5k</span>+ Satisfied clients  <i class="bx bxs-quote-alt-right text-white h1 align-middle me-3"></i></h4>
                                                <div dir="ltr" class="mt-20">
                                                    <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                        <div class="item">
                                                            <div class="py-6">
                                                                <p class="font-size-16 mb-6 text-white">" Fantastic theme with a ton of options. 
                                                                    If you just want the HTML to integrate with your project, 
                                                                    then this is the package. You can find the files in the 'dist' folder...
                                                                    no need to install git and all the other stuff the documentation talks about. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-white">Aweys</h4>
                                                                    <p class="font-size-14 mb-0 text-white">- Skote User</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="log col-xl-6" style="border-radius: 0 10px 10px 0;  box-shadow: 5px 5px 10px rgb(49 48 48 / 50%);">
                    <div class="p-md-12 p-2">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <!-- <p class="text-muted">Sign in to continue to Skote.</p> -->
                                    </div>

                                    <div class="mt-2">
                                        <form id="login" action="../../../apis/login_handler.php" method="Post">

                                            <div class="mb-3">
                                                <label for="username" class="form-label">Email</label>
                                                <input type="Email" class="form-control" name="Email" id="Email" placeholder="Enter Email">
                                            </div>

                                            <div class="mb-3">
                                                <div class="float-end">
                                                    <a href="auth-recoverpw-2.html" class="text-muted">Forgot password?</a>
                                                </div>
                                                <label class="form-label">Password</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                    <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                </div>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <label class="form-check-label" for="remember-check">
                                                    Remember me
                                                </label>
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                            </div>

<!-- 
                                            <div class="mt-4 text-center">
                                                <h5 class="font-size-14 mb-3">Sign in with</h5>

                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                            <i class="mdi mdi-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                            <i class="mdi mdi-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                            <i class="mdi mdi-google"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div> -->

                                        </form>
                                        <div class="mt-5 text-center">
                                            <p>If You Are Customer  ? <a href="auth-register-2.html" class="fw-medium text-primary"> Signup now </a> </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> Skote. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                                </div> -->
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
    <!-- owl.carousel js -->
    <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- auth-2-carousel init -->
    <script src="assets/js/pages/auth-2-carousel.init.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>
</html>

<script>
     $("#login").submit(function(e){   
            e.preventDefault();
            $.ajax({
                url:"../../../apis/login_handler.php",
                    data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                    method: 'POST',
                type: 'POST',
                success: function(resp) {
                    var res = jQuery.parseJSON(resp);
                    
                    if (res.status == 300) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'adminDashboard.php';
                            }
                        });
                    }
                    else if (res.status == 500) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'dashboard.php';
                            }
                        });
                    }
                     else if (res.status == 404) {
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