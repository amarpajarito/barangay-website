<?php
include 'user-backend-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $civil_status = $_POST['civil_status'];
    $purpose = $_POST['purpose'];

    $stmt = $conn->prepare("INSERT INTO enlistments (first_name, last_name, address, contact_number, civil_status, purpose) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $address, $contact_number, $civil_status, $purpose);

    if ($stmt->execute()) {
        echo "<script>alert('Enlistment Successful!'); window.location.href='../enlistment-page.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }
    

    $stmt->close();
}

$conn->close();
?>