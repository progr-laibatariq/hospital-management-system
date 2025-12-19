<?php
// header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Medcare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styleA.css">
    <style>
        .navbar {
            background-color: #003366;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 100;
        }
        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-logo i {
            color: #00b4d8;
            font-size: 1.6rem;
        }
        .logout-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
    </style>
    <script>
        function handleLogout() {
            if(confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar" style="background:  #003366">
        <div class="navbar-logo">
            <i class="fas fa-hospital"></i>
            <span>MEDCARE HOSPITAL</span>
        </div>
        <button class="logout-btn" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </div>