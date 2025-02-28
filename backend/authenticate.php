<?php
session_start();
require 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST['email-username']);
    $password = trim($_POST['password']);

    if (empty($input)) {
        $_SESSION['error'] = "Username or email is required.";
        $_SESSION['field'] = "username";
        header("Location: /front-website/login.php");
        exit();
    }

    if (empty($password)) {
        $_SESSION['error'] = "Password is required.";
        $_SESSION['field'] = "password";
        header("Location: /front-website/login.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, first_name, last_name, username, password, profile_pic, is_admin FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $first_name, $last_name, $username, $hashed_password, $profile_pic, $is_admin);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['user_name'] = $username;
            $_SESSION['profile_pic'] = $profile_pic ?: "/images/barangay-logo.png";
            $_SESSION['is_admin'] = $is_admin;

            $_SESSION['message'] = "Welcome, " . htmlspecialchars($first_name) . "!";

            if ($is_admin) {
                header("Location: /admin-website/admin-manage-users.php"); 
            } else {
                header("Location: /user-website/home.php"); 
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
            $_SESSION['field'] = "password";
            header("Location: /front-website/login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User not found.";
        $_SESSION['field'] = "username";
        header("Location: /front-website/login.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
