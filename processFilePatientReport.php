<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doc_id = $_POST['doc_id'];
    $pat_id = $_POST['pat_id'];
    $cBefore = $_POST['cBefore'];
    $cAfter = $_POST['cAfter'];
    $tGiven = $_POST['tGiven'];
    $lab_test = isset($_POST['lab_test']) ? 1 : 0;
    $medicine = $_POST['medicine'];
    $follow_up = $_POST['action'];
    $check_query = "
        SELECT * FROM patient_report 
        WHERE doc_id = $doc_id 
        AND pat_id = $pat_id 
        AND DATE(report_date) = CURDATE()
    ";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo "<script>alert('A report for this patient has already been submitted today.'); window.history.back();</script>";
        exit;
    }

    // Insert the report
    $insert_query = "
        INSERT INTO patient_report (doc_id, pat_id, cnd_before, cnd_after, treatment_given, lab_test, medicine_given, instructions)
        VALUES ($doc_id, $pat_id, '$cBefore', '$cAfter', '$tGiven', $lab_test, '$medicine', '$follow_up')
    ";

    if ($conn->query($insert_query)) {
        // Update appointment status to 'Done'
        $update_query = "
            UPDATE appointments 
            SET status = 'Done' 
            WHERE doc_id = $doc_id 
            AND pat_id = $pat_id 
            AND DATE(appointment_date) = CURDATE()
        ";
        $conn->query($update_query);

        echo "<script>alert('Report submitted successfully.'); window.location.href = 'view_reports.php';</script>";
    } else {
        echo "<script>alert('Error submitting report.'); window.history.back();</script>";
    }
}
?>
