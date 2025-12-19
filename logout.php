<?php
// Start the session
session_start();

// Check if the user is logged in and destroy the session accordingly
if (isset($_SESSION['role'])) {
    // Destroy session variables
    $_SESSION = array();

    // If you want to destroy the session completely, uncomment the line below
    session_destroy();
    
    // Redirect to the login page after logout
    header("Location: landingPage.html"); // Replace with your actual login page
    exit;
} else {
    // If no session is found, redirect to login page
    header("Location: landingPage.html"); // Replace with your actual login page
    exit;
}
?>
