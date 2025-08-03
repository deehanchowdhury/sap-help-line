<?php
session_start();
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="browse-container">
    <h1>Browse Open Issues</h1>
    <div class="filters">
        <select><option>All Modules</option></select>
        <select><option>All Priorities</option></select>
    </div>
    <div class="issues-grid">
        <div class="issue-card">
            <h3>SAP Material Master Issue</h3>
            <p>Having trouble with material master configuration</p>
            <div class="issue-meta">
                <span class="badge">MM</span>
                <span class="badge">HIGH</span>
            </div>
            <button class="btn">Take Issue</button>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>