<?php
session_start();
include('connection.php');

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role']; 


$sql = "SELECT * FROM $role WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['role'] = $role;

    if ($role == 'doctor') {
        $_SESSION['doc_id'] = $row['doc_id']; 
        echo "<script>
            localStorage.setItem('doc_id', '{$row['doc_id']}'); 
            window.location.href = 'doc_dashboard.php';
        </script>";
        exit;
    }

    if ($role == 'pat_caretaker') {
        $_SESSION['caretaker_id'] = $row['id']; 
        echo "<script>
            localStorage.setItem('caretaker_id', '{$row['id']}'); 
            window.location.href = 'nurse.php';
        </script>";
        exit;
    }

    // Admin role
    if ($role == 'admin') {
        header('Location: admin.php');
        exit;
    }

} else {
    echo "<script>alert('Invalid credentials!'); window.history.back();</script>";
}
?>
