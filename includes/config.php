<?php
// Database configuration - FOR DEMO PURPOSES ONLY

$db_host = 'localhost';
$db_name = 'sap_consulting_platform';
$db_user = 'root';
$db_pass = '';

// Database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Database tables structure
/*
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('FREE', 'PRO', 'PREMIUM') DEFAULT 'FREE',
    role ENUM('USER', 'CONSULTANT', 'ADMIN') DEFAULT 'USER',
    account_status ENUM('ACTIVE', 'LOCKED', 'SUSPENDED') DEFAULT 'ACTIVE',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE consultants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    years_of_experience INT DEFAULT 0,
    expertise_modules TEXT,
    total_problems_solved INT DEFAULT 0,
    difficult_problems_solved INT DEFAULT 0,
    medium_problems_solved INT DEFAULT 0,
    easy_problems_solved INT DEFAULT 0,
    expertise_level ENUM('NEWBIE', 'MEDIUM', 'EXPERT') DEFAULT 'NEWBIE',
    payment_percentage DECIMAL(5,2) DEFAULT 20.00,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE issues (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(500) NOT NULL,
    description TEXT NOT NULL,
    sap_module VARCHAR(100) NOT NULL,
    tags TEXT,
    required_expertise ENUM('NEWBIE', 'MEDIUM', 'EXPERT') DEFAULT 'MEDIUM',
    priority ENUM('LOW', 'MEDIUM', 'HIGH', 'CRITICAL') DEFAULT 'MEDIUM',
    status ENUM('OPEN', 'ASSIGNED', 'IN_PROGRESS', 'SOLUTION_PROPOSED', 'RESOLVED', 'CLOSED') DEFAULT 'OPEN',
    assigned_consultant_id INT NULL,
    base_cost DECIMAL(10,2) NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    upfront_payment DECIMAL(10,2) NOT NULL,
    final_payment DECIMAL(10,2) NOT NULL,
    upfront_paid BOOLEAN DEFAULT FALSE,
    final_paid BOOLEAN DEFAULT FALSE,
    deadline DATE NULL,
    is_urgent BOOLEAN DEFAULT FALSE,
    solution_design TEXT NULL,
    meeting_details TEXT NULL,
    solution_submitted_at TIMESTAMP NULL,
    resolution_deadline TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (assigned_consultant_id) REFERENCES consultants(id)
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    issue_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('CARD', 'BKASH') NOT NULL,
    payment_type ENUM('UPFRONT', 'FINAL') NOT NULL,
    transaction_id VARCHAR(255) NULL,
    status ENUM('PENDING', 'COMPLETED', 'FAILED', 'REFUNDED') DEFAULT 'PENDING',
    payment_details TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (issue_id) REFERENCES issues(id)
);

CREATE TABLE user_payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    payment_method ENUM('CARD', 'BKASH') NOT NULL,
    method_details TEXT NOT NULL,
    is_default BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE communications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    issue_id INT NOT NULL,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    message_type ENUM('TEXT', 'FILE', 'SOLUTION') DEFAULT 'TEXT',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (issue_id) REFERENCES issues(id),
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);
*/

// Demo mode - simulate database operations
function simulate_db_query($query) {
    // This function simulates database queries for demo purposes
    // In production, this would be replaced with actual database operations
    return [];
}

function simulate_db_insert($table, $data) {
    // This function simulates database inserts for demo purposes
    // In production, this would be replaced with actual database operations
    return true;
}

function simulate_db_update($table, $id, $data) {
    // This function simulates database updates for demo purposes
    // In production, this would be replaced with actual database operations
    return true;
}

// Session configuration
session_start();

// Error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Demo user data for simulation
$demo_users = [
    1 => ['id' => 1, 'name' => 'Demo User', 'email' => 'demo@example.com', 'user_type' => 'FREE', 'role' => 'USER'],
    2 => ['id' => 2, 'name' => 'Pro User', 'email' => 'pro@example.com', 'user_type' => 'PRO', 'role' => 'USER'],
    3 => ['id' => 3, 'name' => 'Premium User', 'email' => 'premium@example.com', 'user_type' => 'PREMIUM', 'role' => 'USER'],
    4 => ['id' => 4, 'name' => 'Expert Consultant', 'email' => 'expert@example.com', 'user_type' => 'FREE', 'role' => 'CONSULTANT'],
    5 => ['id' => 5, 'name' => 'Admin', 'email' => 'admin@example.com', 'user_type' => 'PREMIUM', 'role' => 'ADMIN']
];

$demo_consultants = [
    1 => ['id' => 1, 'user_id' => 4, 'years_of_experience' => 8, 'expertise_modules' => 'MM,SD,FI', 'total_problems_solved' => 156, 'difficult_problems_solved' => 45, 'medium_problems_solved' => 78, 'easy_problems_solved' => 33, 'expertise_level' => 'EXPERT', 'payment_percentage' => 80.00],
    2 => ['id' => 2, 'user_id' => 6, 'years_of_experience' => 3, 'expertise_modules' => 'MM,PP', 'total_problems_solved' => 45, 'difficult_problems_solved' => 8, 'medium_problems_solved' => 22, 'easy_problems_solved' => 15, 'expertise_level' => 'MEDIUM', 'payment_percentage' => 60.00],
    3 => ['id' => 3, 'user_id' => 7, 'years_of_experience' => 1, 'expertise_modules' => 'MM', 'total_problems_solved' => 12, 'difficult_problems_solved' => 0, 'medium_problems_solved' => 3, 'easy_problems_solved' => 9, 'expertise_level' => 'NEWBIE', 'payment_percentage' => 20.00]
];

// Cost calculation function
function calculate_issue_cost($user_type, $expertise_level, $is_urgent = false) {
    $base_rates = [
        'FREE' => ['NEWBIE' => 50, 'MEDIUM' => 100, 'EXPERT' => 200],
        'PRO' => ['NEWBIE' => 75, 'MEDIUM' => 150, 'EXPERT' => 300],
        'PREMIUM' => ['NEWBIE' => 100, 'MEDIUM' => 200, 'EXPERT' => 400]
    ];
    
    $base_cost = $base_rates[$user_type][$expertise_level] ?? 100;
    
    // Add 5% for urgent deadline (premium users only)
    if ($is_urgent && $user_type === 'PREMIUM') {
        $base_cost *= 1.05;
    }
    
    return $base_cost;
}

// Payment calculation function
function calculate_consultant_payment($total_cost, $payment_percentage) {
    return ($total_cost * $payment_percentage) / 100;
}

// Date functions for demo
function add_days_to_date($date, $days) {
    return date('Y-m-d H:i:s', strtotime($date . ' + ' . $days . ' days'));
}

function is_date_passed($date) {
    return strtotime($date) < time();
}
?>