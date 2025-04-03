<?php
include 'config.php';
session_start();

// Check if admin is logged in
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

// Check if staff ID is provided
if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    // Delete staff query
    $delete_query = "DELETE FROM staff WHERE id = '$staff_id'";
    
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Staff member deleted successfully!'); window.location.href='admin_manage_staff.php';</script>";
    } else {
        echo "<script>alert('Failed to delete staff member.'); window.location.href='admin_manage_staff.php';</script>";
    }
} else {
    header('location:admin_manage_staff.php');
    exit;
}
?>
