<?php
session_start();
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAP Consulting Platform - Professional SAP Issue Resolution</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="nav-brand">
                <h1>SAP Consulting Platform</h1>
                <span class="tagline">Professional Issue Resolution</span>
            </div>
            <div class="nav-links">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="../pages/user_dashboard.php">Dashboard</a>
                    <a href="../pages/browse_issues.php">Browse Issues</a>
                    <?php if($_SESSION['user_role'] == 'CONSULTANT'): ?>
                        <a href="pages/consultant_dashboard.php">Consultant Dashboard</a>
                    <?php endif; ?>
                    <?php if($_SESSION['user_role'] == 'ADMIN'): ?>
                        <a href="../admin/dashboard.php">Admin Panel</a>
                    <?php endif; ?>
                    <div class="user-dropdown">
                        <span class="user-name"><?php echo $_SESSION['user_name'] ?? 'User'; ?></span>
                        <div class="dropdown-content">
                            <a href="pages/profile.php">Profile</a>
                            <a href="payment_methods.php">Payment Methods</a>
                            <a href="pages/logout.php">Logout</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="pages/login.php">Login</a>
                    <a href="pages/register.php">Register</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="main-content">