<?php
session_start();
include 'db-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['email-username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $username;
            header("Location: /user-website/home.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
    $stmt->close();
    $conn->close();
}
?>
