<?php
include 'Connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM bill WHERE bill_id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_bills.php?msg=deleted");
        exit;
    } else {
        echo "❌ Error deleting bill: " . mysqli_error($conn);
    }
} else {
    echo "❌ No bill ID provided.";
}
?>
