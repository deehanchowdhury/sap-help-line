<?php
session_start();
include '../includes/config.php';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Database operation - FOR DEMO PURPOSES ONLY
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $user_type = $_POST['user_type'];
    $role = $_POST['role'] ?? 'USER';
    
    // Validate passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        // Check if email already exists
        $check_query = "SELECT * FROM users WHERE email = '$email'";
        $check_result = $conn->query($check_query);
        
        if ($check_result->num_rows > 0) {
            $error = "Email address already exists";
        } else {
            // Insert new user
            $query = "INSERT INTO users (name, email, password, user_type, role) 
                      VALUES ('$name', '$email', '$password', '$user_type', '$role')";
            
            if ($conn->query($query) === TRUE) {
                
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_type'] = $user_type;
                $_SESSION['user_role'] = $role;
                $_SESSION['account_status'] = 'ACTIVE';
                
                // If registering as consultant, create consultant profile
                if ($role === 'CONSULTANT') {
                    $consultant_query = "INSERT INTO consultants (user_id, expertise_level, payment_percentage) 
                                       VALUES ('{$conn->insert_id}', 'NEWBIE', 20.00)";
                    $conn->query($consultant_query);
                }
                
                header('Location: user_dashboard.php');
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
    
    
    // Demo mode - simulate registration
    if ($_POST['name'] && $_POST['email'] && $_POST['password']) {
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $error = "Passwords do not match";
        } else {
            $_SESSION['user_id'] = rand(1, 1000);
            $_SESSION['user_name'] = $_POST['name'];
            $_SESSION['user_email'] = $_POST['email'];
            $_SESSION['user_type'] = $_POST['user_type'];
            $_SESSION['user_role'] = $_POST['role'] ?? 'USER';
            $_SESSION['account_status'] = 'ACTIVE';
            
            header('Location: user_dashboard.php');
            exit();
        }
    }
}

$plan = $_GET['plan'] ?? 'free';
$role = $_GET['role'] ?? 'USER';

include '../includes/header.php';
include '../includes/header.php';

?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Register for SAP Consulting Platform</h2>
            <p>Join our platform and get professional SAP issue resolution</p>
        </div>
        
        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="register.php" class="auth-form">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required 
                       placeholder="Enter your full name">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Enter your email address">
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Create a strong password">
                <small class="form-text">Minimum 8 characters with letters, numbers, and symbols</small>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required 
                       placeholder="Confirm your password">
            </div>
            
            <div class="form-group">
                <label for="user_type">Account Type:</label>
                <select id="user_type" name="user_type" required onchange="updatePricingInfo()">
                    <option value="FREE" <?php echo $plan == 'free' ? 'selected' : ''; ?>>Free User - $0/month</option>
                    <option value="PRO" <?php echo $plan == 'pro' ? 'selected' : ''; ?>>Pro User - $29/month</option>
                    <option value="PREMIUM" <?php echo $plan == 'premium' ? 'selected' : ''; ?>>Premium User - $99/month</option>
                </select>
                <div id="pricing-info" class="pricing-info">
                    <!-- Pricing information will be updated by JavaScript -->
                </div>
            </div>
            
            <div class="form-group">
                <label for="role">Register as:</label>
                <select id="role" name="role" required>
                    <option value="USER" <?php echo $role == 'USER' ? 'selected' : ''; ?>>Customer (SAP User)</option>
                    <option value="CONSULTANT" <?php echo $role == 'CONSULTANT' ? 'selected' : ''; ?>>Consultant</option>
                </select>
            </div>
            
            <?php if (isset($_GET['role']) && $_GET['role'] == 'CONSULTANT'): ?>
            <div class="consultant-info">
                <h4>Consultant Information</h4>
                <div class="form-group">
                    <label for="experience">Years of Experience:</label>
                    <input type="number" id="experience" name="experience" min="0" max="50" 
                           placeholder="Years of SAP experience">
                </div>
                
                <div class="form-group">
                    <label for="modules">SAP Modules (comma separated):</label>
                    <input type="text" id="modules" name="modules" 
                           placeholder="e.g., MM, SD, FI, CO">
                </div>
                
                <div class="form-group">
                    <label for="description">Professional Description:</label>
                    <textarea id="description" name="description" rows="3" 
                              placeholder="Brief description of your expertise"></textarea>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I agree to the <a href="../pages/terms.php" target="_blank">Terms of Service</a> and <a href="../pages/privacy.php" target="_blank">Privacy Policy</a></label>
                </div>
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <label for="newsletter">Subscribe to newsletter for updates and tips</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg w-100">Create Account</button>
        </form>
        
        <div class="auth-links">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
        
        <div class="plan-comparison">
            <h4>Account Type Comparison</h4>
            <div class="comparison-table">
                <div class="comparison-header">
                    <div>Feature</div>
                    <div>Free</div>
                    <div>Pro</div>
                    <div>Premium</div>
                </div>
                <div class="comparison-row">
                    <div>Priority Level</div>
                    <div>Low</div>
                    <div>Medium</div>
                    <div>High</div>
                </div>
                <div class="comparison-row">
                    <div>Consultant Assignment</div>
                    <div>Standard</div>
                    <div>Best Available</div>
                    <div>Admin Support</div>
                </div>
                <div class="comparison-row">
                    <div>Response Time</div>
                    <div>24-48 hours</div>
                    <div>12-24 hours</div>
                    <div>1-4 hours</div>
                </div>
                <div class="comparison-row">
                    <div>Deadline Setting</div>
                    <div>❌</div>
                    <div>❌</div>
                    <div>✅ (+5% cost)</div>
                </div>
                <div class="comparison-row">
                    <div>Monthly Cost</div>
                    <div>$0</div>
                    <div>$29</div>
                    <div>$99</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updatePricingInfo() {
    const userType = document.getElementById('user_type').value;
    const pricingInfo = document.getElementById('pricing-info');
    
    const pricing = {
        'FREE': {
            cost: '$0/month',
            features: ['Basic issue posting', 'Standard response time', 'Community support'],
            description: 'Perfect for trying out the platform'
        },
        'PRO': {
            cost: '$29/month',
            features: ['Priority issue posting', 'Best consultant assignment', 'Faster response times', 'Basic analytics'],
            description: 'Great for regular SAP users'
        },
        'PREMIUM': {
            cost: '$99/month',
            features: ['24/7 priority support', 'Admin panel direct support', 'Instant response times', 'Advanced analytics', 'Deadline setting'],
            description: 'Best for businesses with critical SAP needs'
        }
    };
    
    const selected = pricing[userType];
    pricingInfo.innerHTML = `
        <div class="pricing-details">
            <div class="pricing-cost">${selected.cost}</div>
            <div class="pricing-description">${selected.description}</div>
            <ul class="pricing-features">
                ${selected.features.map(feature => `<li>✓ ${feature}</li>`).join('')}
            </ul>
        </div>
    `;
}

// Initialize pricing info on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePricingInfo();
});
</script>

<?php include '../includes/footer.php'; ?>