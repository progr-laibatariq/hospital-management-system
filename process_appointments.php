<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $pat_id = $_POST['pat_id'];
    $doc_id = $_POST['doc_id'];
    $description = $_POST['description'];

    // Validate if any of the required fields are empty
    if (empty($pat_id) || empty($doc_id) || empty($description)) {
        echo "<h2 style='color:red; text-align:center;'>❌ All fields are required.</h2>";
    } else {
        // Prepare the SQL query to insert the new appointment
        $sql = "INSERT INTO appointments (pat_id, doc_id,description) 
                VALUES ('$pat_id', '$doc_id', '$description')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Success message
            echo "<h2 style='color:green; text-align:center;'>✔️ Appointment created successfully!</h2>";
            // Optionally, redirect to another page, like the view appointments page
            header("Location: viewAppointments.php ");
        } else {
            // Error message
            echo "<h2 style='color:red; text-align:center;'>❌ Failed to create appointment: " . $conn->error . "</h2>";
        }
    }
} else {
    // If the form wasn't submitted correctly
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid form submission.</h2>";
}
?>
