<?php 
include 'connection.php';

if (isset($_POST['submit'])) {
    // Get the form values
    $RevisitDate = $_POST['revisit_date'];
    $PatientId = $_POST['pat_id'];

    // Fetch the corresponding bill_id from the bill table
    $sql = "SELECT bill_id FROM bill WHERE pat_id = '$PatientId' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Fetch the bill_id from the result
        $row = $result->fetch_assoc();
        $BillId = $row['bill_id'];

        // Insert into the discharge_sheet table
        $sql_insert = "INSERT INTO discharge_sheet (revisit_date, pat_id, bill_id) 
                       VALUES ('$RevisitDate', '$PatientId', '$BillId')";
        
        if (mysqli_query($conn, $sql_insert)) {
            // Redirect to the view page after successful insert
            header('Location: View.php');
        } else {
            echo "<p style='color:red'>❌ Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red'>❌ No bill found for the selected patient.</p>";
    }
} else {
    echo "<p style='color:orange'>⚠️ Form not submitted properly.</p>";
}
?>



 