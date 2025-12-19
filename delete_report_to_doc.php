<?php
// Include the database connection
require 'connection.php';

// Check if rep_id is passed in the URL
if (isset($_GET['rep_id'])) {
    $rep_id = $_GET['rep_id'];  // Get the rep_id from the URL

    // Prepare the SQL statement to delete the report
    $sql = "DELETE FROM patient_report WHERE rep_id = $rep_id";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to the page to view the updated list of reports after deletion
        header("Location: view_report_to_doc.php");
        exit();
    } else {
        // If there's an error, display a message
        echo "<h3>Error deleting the report: " . $conn->error . "</h3>";
    }
} else {
    // If rep_id is not provided, display an error message
    echo "<h3>No report ID specified.</h3>";
}
?>
