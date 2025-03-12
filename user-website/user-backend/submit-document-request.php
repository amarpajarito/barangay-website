<?php
include 'user-backend-connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $documentType = $_POST['document-type'];
    $address = $_POST['address'];
    $reason = $_POST['reason'];

    // Prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO document_requests (name, document_type, address, reason) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $documentType, $address, $reason);

    if ($stmt->execute()) {
        echo "<script>alert('Request submitted successfully!'); window.location.href='../docu-req.php';</script>";
    } else {
        echo "<script>alert('Error submitting request. Please try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: document-request.php");
    exit();
}
?>