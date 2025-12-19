<?php
// Include the database connection
require 'connection.php';

if (isset($_POST['send'])) {

    // Retrieve form data
    $doc = $_POST['doc_id'];
    $pat = $_POST['pat_id'];
    $message = $_POST['message'];

    // Ensure that all required fields are filled
    if (empty($doc) || empty($pat) || empty($message)) {
        echo "<h2><center>❌ Please fill in all fields </h2>";
    } else {
        // Fetch the gender of the patient from the Patient table
        $sql = "SELECT Gender FROM Patient WHERE pat_id = '$pat'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $gender = $row['Gender'];  // Store the patient's gender
        } else {
            echo "<h2><center>❌ Patient not found </h2>";
            exit();
        }

        // Step 1: Insert the message data into the message table
        $sql = "INSERT INTO message(doc_id, pat_id, description)  
        VALUES ('$doc', '$pat', '$message')";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            // Step 2: Redirect to the page to view the message details
            $msg_id = $conn->insert_id;
            header("Location: view_message.php?msg_id=" . $msg_id);
            exit();
        } else {
            echo "<br><br><br><br><br><br><br>";
            echo "<h3><center>❌ Message sending failed </h3>";
        }
    }
}
?>
