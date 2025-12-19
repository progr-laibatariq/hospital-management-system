
<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caretaker_id = $_POST['caretaker_id'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $shift_time = $_POST['shift_time'];

    $update_query = "UPDATE pat_caretaker SET pat_id = $patient_id, shift_time = '$shift_time'   WHERE id = $caretaker_id";
    $update_result = $conn->query($update_query);

    $insert_query = "INSERT INTO collab_with (id, doc_id) VALUES ($caretaker_id, $doctor_id)";
    $insert_result = $conn->query($insert_query);

    if ($update_result && $insert_result) {
        echo "<script>alert('Caretaker assigned successfully.'); window.location.href='showCaretakerReport.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
