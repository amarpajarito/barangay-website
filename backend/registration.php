<?php
session_start();
require 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /front-website/register.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: /front-website/register.php");
        exit();
    }

    $check_query = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Username or email already exists.";
        $stmt->close();
        header("Location: /front-website/register.php");
        exit();
    }
    $stmt->close();

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $default_profile_pic = "/images/barangay-logo.png"; 

    $insert_query = "INSERT INTO users (first_name, last_name, username, email, password, profile_pic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $hashed_password, $default_profile_pic);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful. You can now log in.";
        header("Location: /front-website/login.php");
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again.";
        header("Location: /front-website/register.php");
    }

    $stmt->close();
    $conn->close();
}
?>
