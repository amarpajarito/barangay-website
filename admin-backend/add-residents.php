<?php
session_start();
require('../backend/db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $address = trim($_POST['address']);
    $contact_number = trim($_POST['contact_number']);
    $civil_status = trim($_POST['civil_status']);
    $purpose = trim($_POST['purpose']);
    
    if (empty($first_name) || empty($last_name) || empty($address) || empty($contact_number) || empty($civil_status) || empty($purpose)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../admin-website/admin-resident-enlist.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO enlistments (first_name, last_name, address, contact_number, civil_status, purpose, created_at, status) VALUES (?, ?, ?, ?, ?, ?, NOW(), 'Pending')");
    $stmt->bind_param("ssssss", $first_name, $last_name, $address, $contact_number, $civil_status, $purpose);

    if ($stmt->execute()) {
        $_SESSION['message'] = "New resident added successfully!";
    } else {
        $_SESSION['error'] = "Failed to add resident.";
    }

    $stmt->close();
    $conn->close();

    header("Location: ../admin-website/admin-resident-enlist.php");
    exit();
}
?>