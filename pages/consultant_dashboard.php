<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'CONSULTANT') {
    header('Location: login.php');
}
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="dashboard-container">
    <h1>Consultant Dashboard</h1>
    <div class="consultant-info">
        <h2>Expert Level: EXPERT</h2>
        <p>Payment Share: 80%</p>
    </div>
    <div class="assigned-issues">
        <h3>Assigned Issues</h3>
        <div class="issue-card">
            <h3>SAP Material Master Issue</h3>
            <button class="btn">Work on Issue</button>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>