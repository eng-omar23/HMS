<!DOCTYPE html>
<html lang="en">
<head>
<!-- Latest version of jQuery from Google CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest version of jQuery from Microsoft CDN -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.min.js"></script>

<!-- Latest version of jQuery from jQuery's CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle .password-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .submit-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 3px;
            cursor: pointer;
        }
        .signup-btn {
            margin-left: 5%;
            background-color: #808190;
            color: #fff4ff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 3px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
        }
        .signup-btn {
        background-color: #4CAF50; /* Green color */
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-right: 10px; /* Add some spacing between buttons */
        text-decoration: none; /* Remove underline from the link */
    }

    .signup-btn:hover {
        background-color: #45a049; /* Darker green color on hover */
    }

    /* Center the buttons horizontally */
    .button-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px; /* Add some margin at the top of the button container */
    }
</style>
    </style>
</head>
 <!-- Latest version of jQuery from Google CDN -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Add the necessary DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

    <!-- SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<body>
    <div class="login-container">
        <center><h2>Armaan Halls </h2></center>
        
        <form id="login-form" action="loginhandler.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="Email" required>
            </div>
            <div class="form-group password-toggle">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="password-icon" onclick="togglePasswordVisibility()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12h12M6 12a4 4 0 011-2.533M6 12a4 4 0 001 2.533m11.132-1.979a9 9 0 10-12.263 0m12.263 0H6"></path>
                    </svg>
                </span>
            </div>
            <div class="button-container">
            <button type="submit" class="submit-btn">Login</button>
            <a href="signup.php" class="signup-btn">Signup</a>
        </div>
        <p class="error-message" id="error-message"></p>
    </div>
        
        </form>
    </div>

    <!-- JavaScript to handle form submission -->
   
<script>
       function togglePasswordVisibility() {
            // Your password visibility toggle function...
        }

        $("#login-form").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "loginhandler.php",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (resp) {
                    var res = jQuery.parseJSON(resp);

                    if (res.status == 300) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './application/views/admin/adminDashboard.php';
                            }
                        });
                    } else if (res.status == 500) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './application/views/customer/dashboard.php';
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
</script>
</body>
</html>
