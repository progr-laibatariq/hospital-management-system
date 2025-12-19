<?php  
include 'Connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $pat_id = $_POST['pat_id'];
    $room_charges = $_POST['room_charges'];
    $stayed_days = $_POST['stayed_days'];
    $ward_charges = $_POST['ward_charges'];
    $doc_fee = $_POST['doc_fee'];
    $surgeon_fee = $_POST['surgeon_fee'];
    $icu_fee = $_POST['icu_fee'];
    $medicine_fee = $_POST['medicine_fee'];
    $lab_fee = $_POST['lab_fee'];
    $food_charges = $_POST['food_charges'];
    $theatre_fee = $_POST['theatre_fee'];

    $total_bill = ($room_charges * $stayed_days) + $ward_charges + $doc_fee + $surgeon_fee + $icu_fee + $medicine_fee + $lab_fee + $food_charges + $theatre_fee;

    $query = "UPDATE patient_bills SET 
                pat_id = '$pat_id',
                room_charges = '$room_charges',
                stayed_days = '$stayed_days',
                ward_charges = '$ward_charges',
                doc_fee = '$doc_fee',
                surgeon_fee = '$surgeon_fee',
                icu_fee = '$icu_fee',
                medicine_fee = '$medicine_fee',
                lab_fee = '$lab_fee',
                food_charges = '$food_charges',
                theatre_fee = '$theatre_fee',
                total_bill = '$total_bill'
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        ?>
        <script>
            alert("✅ Bill updated successfully.");
            window.location.href = "view_bills.php";
        </script>
        <?php
    } else {
        echo "❌ Error updating bill: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Bill</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f7fc;
            padding: 30px;
        }

        form {
            background-color: white;
            padding: 40px;
            width: 500px;
            margin: auto;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 16px;
            border: 1px solid lightgray;
        }

        input[type="submit"] {
            background-color: #003366;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: #4B0082;
            padding: 15px 0;
            border-radius: 10px;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin: 0 25px;
            font-size: 18px;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
        }
    </style>
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="view_bills.php">View Bills</a>
</nav>

<h2>Update Bill</h2>
<form method="POST" action="">
    <label>Bill ID:</label>
    <input type="text" name="id" required>

    <label>Patient ID:</label>
    <input type="text" name="pat_id" required>

    <label>Room Charges:</label>
    <input type="number" name="room_charges" required>

    <label>Stayed Days:</label>
    <input type="number" name="stayed_days" required>

    <label>Ward Charges:</label>
    <input type="number" name="ward_charges" required>

    <label>Doctor Fee:</label>
    <input type="number" name="doc_fee" required>

    <label>Surgeon Fee:</label>
    <input type="number" name="surgeon_fee" required>

    <label>ICU Fee:</label>
    <input type="number" name="icu_fee" required>

    <label>Medicine Fee:</label>
    <input type="number" name="medicine_fee" required>

    <label>Lab Fee:</label>
    <input type="number" name="lab_fee" required>

    <label>Food Charges:</label>
    <input type="number" name="food_charges" required>

    <label>Theatre Fee:</label>
    <input type="number" name="theatre_fee" required>

    <input type="submit" name="submit" value="Update Bill">
</form>

</body>
</html>
