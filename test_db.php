<?php
// test_db.php - Smart DB connection/env debug
require_once __DIR__ . '/backend/vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env or .env.production
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Show loaded env values
$host = getenv('DB_HOST') ?: (isset($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : '');
$user = getenv('DB_USER') ?: (isset($_ENV['DB_USER']) ? $_ENV['DB_USER'] : '');
$pass = getenv('DB_PASS') ?: (isset($_ENV['DB_PASS']) ? $_ENV['DB_PASS'] : '');
$name = getenv('DB_NAME') ?: (isset($_ENV['DB_NAME']) ? $_ENV['DB_NAME'] : '');
echo 'DB_HOST: ' . $host . '<br>';
echo 'DB_USER: ' . $user . '<br>';
echo 'DB_PASS: ' . $pass . '<br>';
echo 'DB_NAME: ' . $name . '<br>';

// Try DB connection using env values

echo '<h2>DB Connection Test</h2>';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass);
    echo '<p style="color:green;">Connected successfully!</p>';
} catch (PDOException $e) {
    echo '<p style="color:red;">DB connection failed: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
