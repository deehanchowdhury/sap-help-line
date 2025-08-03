<?php
session_start();
include '../includes/config.php';
$issue_id = $_GET['id'] ?? 1;
include '../includes/header.php';
?>
<div class="issue-details-container">
    <div class="issue-header">
        <h1>SAP Material Master Issue</h1>
        <div class="issue-meta">
            <span class="status-badge">IN_PROGRESS</span>
            <span class="priority-badge">HIGH</span>
        </div>
    </div>
    <div class="issue-content">
        <h2>Description</h2>
        <p>Having trouble configuring material master for new product line...</p>
    </div>
    <div class="issue-actions">
        <?php if ($_SESSION['user_role'] == 'CONSULTANT'): ?>
            <button class="btn">Mark Resolved</button>
        <?php endif; ?>
    </div>
    <div class="communications">
        <h3>Communications</h3>
        <div class="message">
            <strong>Consultant:</strong> Can you provide more details?
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>