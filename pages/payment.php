<?php
session_start();
if (!isset($_SESSION['user_id'])) header('Location: login.php');
include '../includes/config.php';
$issue_id = $_GET['issue_id'] ?? 1;
include '../includes/header.php';
?>
<div class="payment-container">
    <h1>Process Payment</h1>
    <div class="payment-summary">
        <h3>Issue: SAP Material Master Issue</h3>
        <p>Amount Due: $100</p>
    </div>
    <form method="POST">
        <div class="payment-methods">
            <label>
                <input type="radio" name="method" value="card" required>
                Credit/Debit Card
            </label>
            <label>
                <input type="radio" name="method" value="bkash" required>
                bKash
            </label>
        </div>
        <div class="card-details" id="card-details" style="display:none;">
            <input type="text" placeholder="Card Number">
            <input type="text" placeholder="Expiry Date">
            <input type="text" placeholder="CVV">
        </div>
        <div class="bkash-details" id="bkash-details" style="display:none;">
            <input type="text" placeholder="bKash Number">
            <input type="password" placeholder="PIN">
        </div>
        <button type="submit" class="btn btn-primary">Process Payment</button>
    </form>
</div>
<script>
document.querySelectorAll('input[name="method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('card-details').style.display = 
            this.value === 'card' ? 'block' : 'none';
        document.getElementById('bkash-details').style.display = 
            this.value === 'bkash' ? 'block' : 'none';
    });
});
</script>
<?php include '../includes/footer.php'; ?>