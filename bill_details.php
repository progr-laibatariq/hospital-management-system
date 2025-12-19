<?php
include 'Connection.php';

if (isset($_POST['submit'])) {

    // Collect form data
    $pat_id = intval($_POST['pat_id']); // Patient number / foreign key
    $room_charges = floatval($_POST['room_charges']);
    $stayed_days = intval($_POST['stayed_days']);
    $ward_charges = floatval($_POST['ward_charges']);
    $doc_fee = floatval($_POST['doc_fee']);
    $surgeon_fee = floatval($_POST['surgeon_fee']);
    $icu_fee = floatval($_POST['icu_fee']);
    $medicine_fee = floatval($_POST['medicine_fee']);
    $lab_fee = floatval($_POST['lab_fee']);
    $food_charges = floatval($_POST['food_charges']);
    $theatre_fee = floatval($_POST['theatre_fee']);

    // Calculate total charges
    $total_charges = ($room_charges * $stayed_days) + $ward_charges + $doc_fee + $surgeon_fee + $icu_fee + $medicine_fee + $lab_fee + $food_charges + $theatre_fee;

    // Insert into the `bill` table
    $sql = "INSERT INTO bill (
        food_charges, doc_fee, lab_fee, icu_fee, medicine_fee,
        surgeon_fee, ward_charges, theatre_fee, stayed_days,
        room_charges, total_charges, pat_id
    ) VALUES (
        '$food_charges', '$doc_fee', '$lab_fee', '$icu_fee', '$medicine_fee',
        '$surgeon_fee', '$ward_charges', '$theatre_fee', '$stayed_days',
        '$room_charges', '$total_charges', '$pat_id'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Bill saved successfully'); window.location.href='view_bills.php';</script>";
    } else {
        echo "<p style='color:red'>❌ Error: " . mysqli_error($conn) . "</p>";
    }

} else {
    echo "<p style='color:orange'>⚠️ Form not submitted properly.</p>";
}
?>
