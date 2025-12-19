<?php
// Include the database connection
require 'connection.php';

if (isset($_POST['send'])) {

    // Retrieve form data
    $doc = $_POST['doc_id'];
    $pat = $_POST['pat_id'];

    // Check if both fields are filled
    if(empty($doc) || empty($pat)){
        echo "<h2><center>❌ Please fill in all fields </h2>";
    }
    else {
        // Step 1: Insert only doc_id and pat_id into the 'patient_report' table
        $sql = "INSERT INTO patient_report(doc_id, pat_id) 
                SELECT '$doc', '$pat'";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            // Step 2: Redirect to the page to view patient details (if successful)
            $msg_id = $conn->insert_id;
            header("Location: view_report_to_doc.php?msg_id=" . $msg_id);
            exit();
        } else {
            echo "<br><br><br><br><br><br><br>";
            echo "<h3><center>❌ Report Submission failed </h3>";
        }
    }
}
?>
