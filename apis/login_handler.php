<?php
 session_start();
require '../conn.php';

$email = $_POST['Email'];
$pass = $_POST['Password'];

if (empty($email) || empty($pass)) {
    // Handle empty email or password here
} else {
    // Sanitize user input to prevent SQL injection (recommended)
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Check user credentials in the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $query = mysqli_query($conn, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $type = $row['type'];
        $_SESSION['user_id'] = $row['user_id']; // Store the user ID in the session
        $_SESSION['type'] = $type; // Store the user type in the session
        $_SESSION['email'] = $row['email']; // Store the user type in the session

        if ($type == "admin") {
            header("Location: ../application/views/admin/adminDashboard.php");
            exit(); // Important to exit after the header redirect
        } else {
            header("Location: ../application/views/customer/dashboard.php");
            exit(); // Important to exit after the header redirect
        }
    } else {
        echo "User does not exist";
    }
}
?>
