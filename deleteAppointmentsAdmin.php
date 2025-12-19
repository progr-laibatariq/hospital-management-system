<?php
// Include the database connection
require 'connection.php';

// Check if appointment_id is passed in the URL
if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = '$appointment_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<h2 style='color:green; text-align:center;'>✔️ Appointment deleted successfully!</h2>";
        header("Location: viewAppointments.php"); // Redirect to view appointments page
    } else {
        echo "<h2 style='color:red; text-align:center;'>❌ Failed to delete appointment: " . $conn->error . "</h2>";
    }
} else {
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid appointment ID.</h2>";
}
?>
