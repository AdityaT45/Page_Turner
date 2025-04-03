<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get current status
    $sql = "SELECT status FROM delivery_staff WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($currentStatus);
    $stmt->fetch();
    $stmt->close();

    // Toggle status
    $newStatus = ($currentStatus == 'Active') ? 'Inactive' : 'Active';

    // Update status in the database
    $updateQuery = "UPDATE delivery_staff SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Status updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update status.";
    }

    $stmt->close();
    $conn->close();
    header("Location: admin_manage_delivery_staff.php");
    exit();
}
?>
