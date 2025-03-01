<?php
session_start();
require ('../backend/db-connect.php'); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['user_id']) || !is_numeric($_POST['user_id'])) {
        $_SESSION['error_message'] = "Invalid request.";
        header("Location: ../admin-website/admin-manage-users.php");
        exit;
    }

    $user_id = intval($_POST['user_id']);

    if ($_SESSION['user_id'] == $user_id) {
        $_SESSION['error_message'] = "You cannot delete your own account.";
        header("Location: ../admin-website/admin-manage-users.php");
        exit;
    }

    $checkQuery = "SELECT is_admin FROM users WHERE id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['error_message'] = "User not found.";
        header("Location: ../admin-website/admin-manage-users.php");
        exit;
    }

    $stmt->bind_result($is_admin);
    $stmt->fetch();
    $stmt->close();

    if ($is_admin == 1) {
        $_SESSION['error_message'] = "Error: You cannot delete an admin.";
        header("Location: ../admin-website/admin-manage-users.php");
        exit;
    }

    $deleteQuery = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Error deleting user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin-website/admin-manage-users.php");
    exit;
} else {
    $_SESSION['error_message'] = "Unauthorized access.";
    header("Location: ../admin-website/admin-manage-users.php");
    exit;
}
?>