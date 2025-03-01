<?php
session_start();
require('../backend/db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['request_id']) && isset($_POST['status'])) {
        $request_id = intval($_POST['request_id']);
        $status = in_array($_POST['status'], ['Approved', 'Rejected']) ? $_POST['status'] : 'Pending';

        $sql = "UPDATE enlistments SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $request_id);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>