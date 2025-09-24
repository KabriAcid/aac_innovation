<?php

namespace AAC\Config;

// Composer autoload and always load Dotenv
require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// Prevent direct access
if (!defined('AAC_BACKEND')) {
    define('AAC_BACKEND', true);
}

// Database Configuration
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbName = $_ENV['DB_NAME'] ?? 'aac_innovation';
$username = $_ENV['DB_USER'] ?? 'root';
$password = $_ENV['DB_PASS'] ?? '';
$port = $_ENV['DB_PORT'] ?? 3306;
$charset = 'utf8mb4';

$options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE utf8mb4_unicode_ci"
];

// PDO connection
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset";
    $pdo = new \PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    if (isset($_ENV['ENVIRONMENT']) && $_ENV['ENVIRONMENT'] === 'production') {
        die("Service temporarily unavailable. Please try again later.");
    } else {
        die("Database connection failed: " . $e->getMessage());
    }
}
