<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../../conn.php';
require_once '../../../apis/functions.php';
session_start();

// Store data in the session
$email=$_SESSION['email'] ;


if(!empty($email)){

    $sqlUser = "SELECT * FROM users WHERE email = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("i", $email);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();
    
    $sqlCustomer = "SELECT * FROM customers WHERE email = ?";
    $stmtCustomer = $conn->prepare($sqlCustomer);
    $stmtCustomer->bind_param("i", $email);
    $stmtCustomer->execute();
    $resultCustomer = $stmtCustomer->get_result();

    if ($resultUser && $resultCustomer && $resultUser->num_rows > 0 && $resultCustomer->num_rows > 0) {
        $rowUser = $resultUser->fetch_assoc();
        $rowCustomer = $resultCustomer->fetch_assoc();
    
        // Prepare the JSON response
        $response = [
            'user' => [
                'password' => $rowUser['password']
            ],
            'customer' => [
                'fullName' => $rowCustomer['firstname'],
                'email' => $rowCustomer['email'],
                'phone' => $rowCustomer['phone']
                // Add more customer fields as needed
            ]
        ];
    
        // Close prepared statements
        $stmtUser->close();
        $stmtCustomer->close();
    
        // Return the JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // No user or customer found
        $response = [
            'status' => 400, // or 500
            'message' => 'User or customer not found'
        ];
    
        // Close prepared statements
        $stmtUser->close();
        $stmtCustomer->close();
    
        // Return the JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}