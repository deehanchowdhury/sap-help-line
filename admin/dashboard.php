<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'ADMIN') {
    header('Location: ../pages/login.php');
}
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    <div class="admin-stats">
        <div class="stat-card">
            <h3>Total Users</h3>
            <div>156</div>
        </div>
        <div class="stat-card">
            <h3>Total Issues</h3>
            <div>89</div>
        </div>
        <div class="stat-card">
            <h3>Total Revenue</h3>
            <div>$15,420</div>
        </div>
        <div class="stat-card">
            <h3>Pending Payments</h3>
            <div>5</div>
        </div>
    </div>
    <div class="admin-sections">
        <div class="section">
            <h3>User Management</h3>
            <button class="btn">View All Users</button>
        </div>
        <div class="section">
            <h3>Consultant Management</h3>
            <button class="btn">View Consultants</button>
        </div>
        <div class="section">
            <h3>Payment Processing</h3>
            <button class="btn">Process Payments</button>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>