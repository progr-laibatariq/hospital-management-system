<?php
// Include the database connection
require 'connection.php';

// Check if the form is submitted
if (isset($_POST['update'])) {
    $pat_id = $_POST['pat_id'];
    $doc_id = $_POST['doc_id'];
    $assigned_at = $_POST['assigned_at']; // You can update this if needed; currently it is readonly
    $field_to_update = $_POST['field_to_update']; // Either "doctor" or "patient"

    // Step 2: Update the assignment record based on the field selected
    if ($field_to_update == 'doctor') {
        $new_doc_id = $_POST['new_doc_id'];
        $sql = "UPDATE assigned_to 
                SET doc_id = '$new_doc_id' 
                WHERE pat_id = '$pat_id' AND doc_id = '$doc_id'";
    } elseif ($field_to_update == 'patient') {
        $new_pat_id = $_POST['new_pat_id'];
        $sql = "UPDATE assigned_to 
                SET pat_id = '$new_pat_id' 
                WHERE pat_id = '$pat_id' AND doc_id = '$doc_id'";
    }

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "<h2 style='color:green; text-align:center;'>✔️ Assignment updated successfully!</h2>";
        // Optionally, redirect to another page
        header("Location: view_assign_doc_to_pat.php");
    } else {
        // Error message
        echo "<h2 style='color:red; text-align:center;'>❌ Failed to update assignment: " . $conn->error . "</h2>";
    }
} else {
    // If the form wasn't submitted correctly
    echo "<h2 style='color:red; text-align:center;'>❌ Invalid form submission.</h2>";
}
?>
