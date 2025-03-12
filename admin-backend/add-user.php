<?php
session_start();
require ('../backend/db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $sql = "INSERT INTO users (username, first_name, last_name, email, password, is_admin) 
        VALUES ('$username', '$first_name', '$last_name', '$email', '$password', '$role')";

    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "User added successfully!";
    } else {
        $_SESSION['error'] = "Error adding user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: ../admin-website/admin-manage-users.php");
    exit();
}
?>