<?php
session_start(); // 🔹 Start the session
include 'connection.php';

if (isset($_POST['submit'])) {
    $name      = $_POST['Name'];
    $email     = $_POST['Email'];
    $Password  = $_POST['Password']; // 🔹 You should hash this later
    $Username  = $_POST['username'];
    $ph_Nmbr   = $_POST['ph']; 

    // 1️⃣ Check if caretaker already exists by email or username
    $checkSql = "SELECT * FROM pat_caretaker 
                 WHERE Email = '$email' OR username = '$Username'";
    $result = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($result) > 0) {
        // Caretaker already exists
        echo "<script>alert('❌ Caretaker with this email or username already exists');</script>";
    } else {
        // 2️⃣ Insert into pat_caretaker
        $sql = "INSERT INTO pat_caretaker (Name, Email, Password, username)
                VALUES ('$name', '$email', '$Password', '$Username')";

        if (mysqli_query($conn, $sql)) {
            $id = $conn->insert_id;

            // 3️⃣ Insert into pat_caretaker_ph_nmbr
            $sql1 = "INSERT INTO pat_caretaker_ph_nmbr (id, ph_Nmbr)
                     VALUES ($id, '$ph_Nmbr')";

            if (mysqli_query($conn, $sql1)) {
                // ✅ Set session for the new caretaker
                $_SESSION['role'] = 'pat_caretaker';
                $_SESSION['id'] = $id; // caretaker ID
                $_SESSION['caretaker_name'] = $name;
                $_SESSION['caretaker_email'] = $email;

                // Redirect to caretaker dashboard
                header("Location: nurse.php");
                exit;
            } else {
                echo "Error inserting phone number: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting caretaker: " . mysqli_error($conn);
        }
    }
}
?>
