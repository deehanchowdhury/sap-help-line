<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
include '../includes/config.php';
include '../includes/header.php';
?>
<div class="post-issue-container">
    <h1>Post New Issue</h1>
    <form method="POST">
        <div class="form-group">
            <label>Issue Title</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>SAP Module</label>
                <select name="module" required>
                    <option value="MM">Materials Management</option>
                    <option value="SD">Sales & Distribution</option>
                </select>
            </div>
            <div class="form-group">
                <label>Required Expertise</label>
                <select name="expertise" required>
                    <option value="NEWBIE">Newbie</option>
                    <option value="MEDIUM">Medium</option>
                    <option value="EXPERT">Expert</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="6" required></textarea>
        </div>
        <div class="cost-calculation">
            <h3>Cost: $<span id="total-cost">200</span></h3>
            <p>Upfront Payment: $<span id="upfront-cost">100</span></p>
        </div>
        <button type="submit" class="btn btn-primary">Post Issue</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>