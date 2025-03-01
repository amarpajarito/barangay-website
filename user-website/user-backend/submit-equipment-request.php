<?php
include 'user-backend-connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $item_type = trim($_POST["item-type"]);
    $address = trim($_POST["address"]);
    $reason = trim($_POST["reason"]);

    // Validate input
    if (empty($name) || empty($item_type) || empty($address) || empty($reason)) {
        die("All fields are required.");
    }

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO equipment_requests (name, item_type, address, reason) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $item_type, $address, $reason);

    if ($stmt->execute()) {
        echo "<script>alert('Request submitted successfully!'); window.location.href='../equp-req.html';</script>";
    } else {
        echo "<script>alert('Error submitting request. Please try again.'); window.history.back();</script>";
    }


    $stmt->close();
}

$conn->close();
?>