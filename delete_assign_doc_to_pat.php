<?php
// Include the database connection
require 'connection.php';

// Check if the pat_id and doc_id are passed in the URL
if (isset($_GET['pat_id']) && isset($_GET['doc_id'])) {
    $pat_id = $_GET['pat_id'];
    $doc_id = $_GET['doc_id'];

    // Step 1: Delete the assignment from the 'assigned_to' table
    $sql = "DELETE FROM assigned_to WHERE pat_id = '$pat_id' AND doc_id = '$doc_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "<h2 style='color:green; text-align:center;'>✔️ Assignment deleted successfully!</h2>";
        // Redirect to the view assignments page
        header("Location: view_assign_doc_to_pat.php");
    } else {
        // Error message
        echo "<h2 style='color:red; text-align:center;'>❌ Failed to delete assignment: " . $conn->error . "</h2>";
    }
} else {
    // If pat_id or doc_id is missing in the URL
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid request. Missing parameters.</h2>";
}
?>
