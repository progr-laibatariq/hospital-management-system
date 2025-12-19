<?php
include 'Connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM discharge_sheet WHERE dis_id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: View.php?msg=deleted");
        exit;
    } else {
        echo "❌ Error deleting bill: " . mysqli_error($conn);
    }
} else {
    echo "❌ No bill ID provided.";
}
?>
