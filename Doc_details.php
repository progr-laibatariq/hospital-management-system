<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    $name           = $_POST['name'];
    $userName       = $_POST['username'];
    $Password       = $_POST['password']; // 🔹 You should hash this later
    $Gender         = $_POST['gender'];
    $specialization = $_POST['specialization'];
    $Email          = $_POST['email'];
    $ph_Nmbr        = $_POST['ph'];

    // Check if doctor already exists
    $checkSql = "SELECT * FROM doctor WHERE email = '$Email' OR username = '$userName'";
    $result   = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('❌ Doctor with this email or username already exists');</script>";
    } else {
        // Insert into doctor
        $sql = "INSERT INTO doctor(name, username, password, gender, specialization, email)
                VALUES('$name', '$userName', '$Password', '$Gender', '$specialization', '$Email')";

        if (mysqli_query($conn, $sql)) { 
            $id = $conn->insert_id;

            // Insert phone number
            $sql1 = "INSERT INTO doctor_ph_nmbr (doc_id, ph_Nmbr)
                     VALUES ($id, '$ph_Nmbr')";

            if (mysqli_query($conn, $sql1)) {
                // ✅ Set session for the new doctor
                $_SESSION['role'] = 'doctor';
                $_SESSION['doc_id'] = $id;
                $_SESSION['doctor_name'] = $name;
                $_SESSION['doctor_email'] = $Email;

                // Redirect to their dashboard
                header("Location: doc_dashboard.php");
                exit;
            } else {
                echo "Error inserting phone number: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting doctor: " . mysqli_error($conn);
        }
    }
}
?>
