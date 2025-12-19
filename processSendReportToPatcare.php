<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['submit']) && isset($_POST['pat_id'])) {
    $patient_id = $_POST['pat_id']; // Get the selected patient's ID from the form

    // Fetch the patient's report from the database
    $sql_report = "SELECT * FROM patient_report WHERE pat_id = '$patient_id'"; // Query to get the report
    $result_report = $conn->query($sql_report); // Execute the query

    if ($result_report->num_rows > 0) {
        // If the report exists, fetch the data
        $report = $result_report->fetch_assoc();

        // Redirect to the view page with the patient's report details
        header("Location: viewPatientReport.php?rep_id=" . $report['rep_id']);
        exit(); // Stop the script to avoid further processing
    } else {
        // If no report is found, display an error message
        echo "<h3 style='color:red; text-align:center;'>❌ No report found for this patient!</h3>";
    }
} else {
    // If the form is not submitted properly
    echo "<h3 style='color:red; text-align:center;'>⚠️ Form not submitted properly.</h3>";
}
?>
