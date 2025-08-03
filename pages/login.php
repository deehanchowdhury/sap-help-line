<?php
session_start();
include '../includes/config.php';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Database operation - FOR DEMO PURPOSES ONLY
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['account_status'] = $user['account_status'];
        
        // Check if account is locked
        if ($user['account_status'] === 'LOCKED') {
            session_destroy();
            header('Location: login.php?error=account_locked');
            exit();
        }
        
        // Redirect based on user role
        if ($user['role'] === 'ADMIN') {
            header('Location: ../admin/dashboard.php');
        } elseif ($user['role'] === 'CONSULTANT') {
            header('Location: consultant_dashboard.php');
        } else {
            header('Location: user_dashboard.php');
        }
        exit();
    } else {
        $error = "Invalid email or password";
    }
    
    
    // Demo mode - simulate login
    if ($_POST['email'] && $_POST['password']) {
        // Demo users simulation
        $demo_users = [
            'demo@example.com' => [
                'id' => 1,
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'user_type' => 'FREE',
                'role' => 'USER',
                'account_status' => 'ACTIVE'
            ],
            'pro@example.com' => [
                'id' => 2,
                'name' => 'Pro User',
                'email' => 'pro@example.com',
                'user_type' => 'PRO',
                'role' => 'USER',
                'account_status' => 'ACTIVE'
            ],
            'premium@example.com' => [
                'id' => 3,
                'name' => 'Premium User',
                'email' => 'premium@example.com',
                'user_type' => 'PREMIUM',
                'role' => 'USER',
                'account_status' => 'ACTIVE'
            ],
            'expert@example.com' => [
                'id' => 4,
                'name' => 'Expert Consultant',
                'email' => 'expert@example.com',
                'user_type' => 'FREE',
                'role' => 'CONSULTANT',
                'account_status' => 'ACTIVE'
            ],
            'admin@example.com' => [
                'id' => 5,
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'user_type' => 'PREMIUM',
                'role' => 'ADMIN',
                'account_status' => 'ACTIVE'
            ]
        ];
        
        if (isset($demo_users[$_POST['email']])) {
            $user = $demo_users[$_POST['email']];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['account_status'] = $user['account_status'];
            
            // Redirect based on user role
            if ($user['role'] === 'ADMIN') {
                header('Location: ../admin/dashboard.php');
            } elseif ($user['role'] === 'CONSULTANT') {
                header('Location: consultant_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            $error = "Invalid email or password";
        }
    }
}

// Handle error messages
$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'account_locked':
            $error = "Your account has been locked. Please contact support.";
            break;
        case 'session_expired':
            $error = "Your session has expired. Please login again.";
            break;
        default:
            $error = "An error occurred. Please try again.";
    }
}

include '../includes/header.php';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Login to SAP Consulting Platform</h2>
            <p>Access your account and manage your SAP issues</p>
        </div>
        
        <?php if($error): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="login.php" class="auth-form">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required 
                       placeholder="Enter your email address">
                <small class="form-text">Demo emails: demo@example.com, pro@example.com, premium@example.com, expert@example.com, admin@example.com</small>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required 
                       placeholder="Enter your password">
                <small class="form-text">Demo password: any password works</small>
            </div>
            
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
        </form>
        
        <div class="auth-links">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
            <p><a href="forgot-password.php">Forgot your password?</a></p>
        </div>
        
        <div class="demo-info">
            <h4>Demo Accounts:</h4>
            <div class="demo-accounts">
                <div class="demo-account">
                    <strong>Free User:</strong> demo@example.com
                </div>
                <div class="demo-account">
                    <strong>Pro User:</strong> pro@example.com
                </div>
                <div class="demo-account">
                    <strong>Premium User:</strong> premium@example.com
                </div>
                <div class="demo-account">
                    <strong>Consultant:</strong> expert@example.com
                </div>
                <div class="demo-account">
                    <strong>Admin:</strong> admin@example.com
                </div>
            </div>
            <p class="demo-note">Use any password for demo accounts</p>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>