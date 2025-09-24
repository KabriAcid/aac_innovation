<?php
// Prevent direct access
if (!defined('AAC_BACKEND')) {
    define('AAC_BACKEND', true);
}

// Database Configuration
$host = $_ENV['DB_HOST'] ?? 'localhost';
$db_name = $_ENV['DB_NAME'] ?? 'aac_innovation';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASS'] ?? '';
$port = $_ENV['DB_PORT'] ?? 3306;
$charset = 'utf8mb4';

// PDO Options
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE utf8mb4_unicode_ci"
];

// Global connection variable
$conn = null;

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=$charset";
    $conn = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());

    // Development vs Production error handling
    if (isset($_ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] === 'production') {
        die("Service temporarily unavailable. Please try again later.");
    } else {
        die("Database connection failed: " . $e->getMessage());
    }
}
