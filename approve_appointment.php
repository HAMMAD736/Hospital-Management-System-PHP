<?php
session_start();
include 'db.php';

// Check: Sirf Doctor hi approve kar sakta hai
if (!isset($_SESSION['doctor_logged_in'])) {
    header("Location: doctor_login.php");
    exit();
}

// URL se Appointment ki ID pakdo (e.g. approve_appointment.php?id=5)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Database Update Karo
    $sql = "UPDATE appointments SET status='Approved ✅' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        // Kaam ho gaya, wapis dashboard jao
        header("Location: doctor_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>