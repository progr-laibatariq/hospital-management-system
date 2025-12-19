<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['appointment_id'])) {
    // Retrieve the form data
    $appointment_id = $_POST['appointment_id'];
    $pat_id = $_POST['pat_id'];
    $doc_id = $_POST['doc_id'];
    $description = $_POST['description'];

    // Validate the required fields
    if (empty($pat_id) || empty($doc_id) || empty($description)) {
        echo "<h2 style='color:red; text-align:center;'>❌ All fields are required.</h2>";
    } else {
        // Prepare the SQL query to update the appointment
        $sql = "UPDATE appointments 
                SET pat_id = '$pat_id', doc_id = '$doc_id', description = '$description' 
                WHERE appointment_id = '$appointment_id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Success message
            echo "<h2 style='color:green; text-align:center;'>✔️ Appointment updated successfully!</h2>";
            header("Location: viewAppointments.php"); // Redirect to view appointments page
        } else {
            // Error message
            echo "<h2 style='color:red; text-align:center;'>❌ Failed to update appointment: " . $conn->error . "</h2>";
        }
    }
} else {
    // If the form wasn't submitted correctly
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid form submission.</h2>";
}
?>
