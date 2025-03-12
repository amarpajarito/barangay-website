<?php
session_start();
require ('../backend/db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Check if email already exists for another user
    $emailCheckQuery = "SELECT id FROM users WHERE email = '$email' AND id != '$id'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);
    
    if (mysqli_num_rows($emailCheckResult) > 0) {
        $_SESSION['error'] = "Email is already in use by another user!";
        header("Location: ../admin-manage-users.php");
        exit();
    }

    // Check if username already exists for another user
    $usernameCheckQuery = "SELECT id FROM users WHERE username = '$username' AND id != '$id'";
    $usernameCheckResult = mysqli_query($conn, $usernameCheckQuery);
    
    if (mysqli_num_rows($usernameCheckResult) > 0) {
        $_SESSION['error'] = "Username is already in use by another user!";
        header("Location: ../admin-manage-users.php");
        exit();
    }

    // Update query without password change
    $updateQuery = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', email='$email', is_admin='$role' WHERE id='$id'";

    // Check if password is provided and update it
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $updateQuery = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', email='$email', password='$password', is_admin='$role' WHERE id='$id'";
    }

    if (mysqli_query($conn, $updateQuery)) {
        $_SESSION['message'] = "User updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header("Location: ../admin-website/admin-manage-users.php");
    exit();
}
?>
