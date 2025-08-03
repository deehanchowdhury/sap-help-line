<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="dashboard-container">
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
    <div class="dashboard-stats">
        <div class="stat-card"><h3>Total Issues</h3><div>3</div></div>
        <div class="stat-card"><h3>Open Issues</h3><div>1</div></div>
        <div class="stat-card"><h3>Resolved</h3><div>1</div></div>
    </div>
    <div class="issues-section">
        <h2>Your Issues</h2>
        <div class="issues-list">
            <div class="issue-card">
                <h3>SAP Material Master Issue</h3>
                <span class="status-badge">OPEN</span>
                <a href="issue_details.php?id=1" class="btn">View Details</a>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>