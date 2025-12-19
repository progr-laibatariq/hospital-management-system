<?php
include 'connection.php';

if (isset($_POST['doctor'])) {
    // Insert doctor details into the database and then redirect to doctor dashboard
    header('location: doc.php');
} else {
    // Insert patient caretaker details into the database and then redirect to patient caretaker dashboard
    header('location: pat_caretaker.php');
}
?>