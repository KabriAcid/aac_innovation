<?php

require_once 'database.php';

/**
 * Global PDO connection provided by database.php
 * @var PDO|null $conn
 */
/** @noinspection PhpUnusedLocalVariableInspection */
// $conn may be defined in database.php


/**
 * AAC Innovation Helper Functions
 * 
 * Robust database helper functions with comprehensive error handling
 * and validation for the AAC Innovation backend system.
 */

/**
 * Execute prepared statement with parameters
 *
 * @param string $sql SQL query string
 * @param array $params Parameters for prepared statement
 * @return PDOStatement|false PDO statement on success, false on failure
 * @throws Exception If database connection fails or query is invalid
 */
/**
 * Execute a prepared statement using the global PDO connection.
 * Ensures the global $conn is a PDO instance and wraps errors.
 */
function executeQuery($sql, $params = [])
{
    try {
        // Validate input parameters
        if (empty($sql) || !is_string($sql)) {
            throw new InvalidArgumentException('SQL query must be a non-empty string');
        }

        if (!is_array($params)) {
            throw new InvalidArgumentException('Parameters must be an array');
        }

        global $conn;

        // Check if connection exists and is a PDO instance
        if (!isset($conn) || !($conn instanceof PDO)) {
            throw new Exception('Database connection not initialized or invalid PDO instance');
        }

        // Prepare and execute statement
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception('Failed to prepare SQL statement: ' . implode(', ', $conn->errorInfo()));
        }

        $result = $stmt->execute($params);

        if (!$result) {
            throw new Exception('Query execution failed: ' . implode(', ', $stmt->errorInfo()));
        }

        return $stmt;
    } catch (PDOException $e) {
        error_log('Database Query Error: ' . $e->getMessage() . ' | SQL: ' . $sql);
        throw new Exception('Database query failed: ' . $e->getMessage());
    } catch (Exception $e) {
        error_log('Execute Query Error: ' . $e->getMessage() . ' | SQL: ' . $sql);
        throw $e;
    }
}

/**
 * Fetch single row from database
 *
 * @param string $sql SQL query string
 * @param array $params Parameters for prepared statement
 * @return array|false Associative array of row data or false if no results
 * @throws Exception If query execution fails
 */
function fetchOne($sql, $params = [])
{
    try {
        $stmt = executeQuery($sql, $params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return false if no results found (consistent with PDO behavior)
        return $result !== false ? $result : false;
    } catch (Exception $e) {
        error_log('Fetch One Error: ' . $e->getMessage() . ' | SQL: ' . $sql);
        throw new Exception('Failed to fetch single row: ' . $e->getMessage());
    }
}

/**
 * Fetch all rows from database
 *
 * @param string $sql SQL query string
 * @param array $params Parameters for prepared statement
 * @return array Array of associative arrays, empty array if no results
 * @throws Exception If query execution fails
 */
function fetchAll($sql, $params = [])
{
    try {
        $stmt = executeQuery($sql, $params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Always return array (empty if no results)
        return is_array($results) ? $results : [];
    } catch (Exception $e) {
        error_log('Fetch All Error: ' . $e->getMessage() . ' | SQL: ' . $sql);
        throw new Exception('Failed to fetch rows: ' . $e->getMessage());
    }
}

/**
 * Get last insert ID from database
 *
 * @return string|false Last insert ID or false on failure
 * @throws Exception If database connection is not available
 */
function getLastInsertId()
{
    try {
        $conn = ensureDbConnection();

        $lastId = $conn->lastInsertId();

        // Validate that we got a valid ID
        if ($lastId === false || $lastId === '0') {
            error_log('Warning: Last insert ID returned invalid value: ' . var_export($lastId, true));
            return false;
        }

        return $lastId;
    } catch (PDOException $e) {
        error_log('Last Insert ID Error: ' . $e->getMessage());
        throw new Exception('Failed to get last insert ID: ' . $e->getMessage());
    } catch (Exception $e) {
        error_log('Last Insert ID Error: ' . $e->getMessage());
        throw $e;
    }
}

/**
 * Sanitize input for database and output
 *
 * @param mixed $input Input data to sanitize
 * @param bool $strictMode Whether to use strict sanitization
 * @return mixed Sanitized input
 */
function sanitizeInput($input, $strictMode = false)
{
    try {
        // Handle null values
        if ($input === null) {
            return null;
        }

        // Handle arrays recursively
        if (is_array($input)) {
            return array_map(function ($item) use ($strictMode) {
                return sanitizeInput($item, $strictMode);
            }, $input);
        }

        // Handle strings
        if (is_string($input)) {
            $sanitized = trim($input);

            if ($strictMode) {
                // Strict mode: remove all HTML tags and special characters
                $sanitized = strip_tags($sanitized);
                $sanitized = preg_replace('/[^\w\s\-\.\@\+\(\)]/u', '', $sanitized);
            } else {
                // Normal mode: escape HTML entities
                $sanitized = htmlspecialchars($sanitized, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }

            return $sanitized;
        }

        // Handle numbers
        if (is_numeric($input)) {
            return $input;
        }

        // Handle booleans
        if (is_bool($input)) {
            return $input;
        }

        // For other types, convert to string and sanitize
        return sanitizeInput((string)$input, $strictMode);
    } catch (Exception $e) {
        error_log('Input Sanitization Error: ' . $e->getMessage());
        return ''; // Return empty string as fallback
    }
}

/**
 * Validate email format with comprehensive checks
 *
 * @param string $email Email address to validate
 * @param bool $checkDns Whether to perform DNS validation
 * @return bool True if email is valid, false otherwise
 */
function isValidEmail($email, $checkDns = false)
{
    try {
        // Basic validation
        if (empty($email) || !is_string($email)) {
            return false;
        }

        // Remove whitespace
        $email = trim($email);

        // Check length limits (RFC 5321)
        if (strlen($email) > 254) {
            return false;
        }

        // Basic format validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Additional checks
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return false;
        }

        list($local, $domain) = $parts;

        // Local part validation
        if (strlen($local) > 64 || strlen($local) < 1) {
            return false;
        }

        // Domain part validation
        if (strlen($domain) > 253 || strlen($domain) < 1) {
            return false;
        }

        // DNS validation (optional)
        if ($checkDns) {
            if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
                return false;
            }
        }

        return true;
    } catch (Exception $e) {
        error_log('Email Validation Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Validate phone number (Nigerian format with international support)
 *
 * @param string $phone Phone number to validate
 * @param bool $strictNigerian Whether to enforce Nigerian format only
 * @return bool True if phone number is valid, false otherwise
 */
function isValidPhone($phone, $strictNigerian = true)
{
    try {
        // Basic validation
        if (empty($phone) || !is_string($phone)) {
            return false;
        }

        // Remove all non-numeric characters except +
        $cleanPhone = preg_replace('/[^0-9+]/', '', trim($phone));

        // Check minimum length
        if (strlen($cleanPhone) < 10) {
            return false;
        }

        // Nigerian phone number patterns
        $nigerianPatterns = [
            '/^\+234[0-9]{10}$/',    // +234xxxxxxxxxx (international format)
            '/^234[0-9]{10}$/',      // 234xxxxxxxxxx (country code without +)
            '/^0[0-9]{10}$/',        // 0xxxxxxxxxx (local format)
            '/^[7-9][0-9]{9}$/'      // xxxxxxxxxx (mobile without leading 0)
        ];

        if ($strictNigerian) {
            foreach ($nigerianPatterns as $pattern) {
                if (preg_match($pattern, $cleanPhone)) {
                    return true;
                }
            }
            return false;
        } else {
            // International format validation (less strict)
            $internationalPatterns = [
                '/^\+[1-9]\d{1,14}$/',   // International format with country code
                '/^[0-9]{10,15}$/'       // Local format (10-15 digits)
            ];

            // First check Nigerian patterns
            foreach ($nigerianPatterns as $pattern) {
                if (preg_match($pattern, $cleanPhone)) {
                    return true;
                }
            }

            // Then check international patterns
            foreach ($internationalPatterns as $pattern) {
                if (preg_match($pattern, $cleanPhone)) {
                    return true;
                }
            }

            return false;
        }
    } catch (Exception $e) {
        error_log('Phone Validation Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Format phone number to standardized format
 *
 * @param string $phone Phone number to format
 * @param string $format Format type: 'international', 'local', 'display'
 * @return string Formatted phone number or original if formatting fails
 */
function formatPhone($phone, $format = 'international')
{
    try {
        if (empty($phone) || !is_string($phone)) {
            return $phone;
        }

        // Clean the phone number
        $cleanPhone = preg_replace('/[^0-9+]/', '', trim($phone));

        // Nigerian phone number formatting
        if (preg_match('/^0([7-9][0-9]{8})$/', $cleanPhone, $matches)) {
            // Local format: 0xxxxxxxxx -> +234xxxxxxxxx
            $number = $matches[1];
            switch ($format) {
                case 'international':
                    return '+234' . $number;
                case 'local':
                    return '0' . $number;
                case 'display':
                    return '+234 ' . substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6);
                default:
                    return '+234' . $number;
            }
        } elseif (preg_match('/^234([7-9][0-9]{8})$/', $cleanPhone, $matches)) {
            // Country code without +: 234xxxxxxxxx -> +234xxxxxxxxx
            $number = $matches[1];
            switch ($format) {
                case 'international':
                    return '+234' . $number;
                case 'local':
                    return '0' . $number;
                case 'display':
                    return '+234 ' . substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6);
                default:
                    return '+234' . $number;
            }
        } elseif (preg_match('/^\+234([7-9][0-9]{8})$/', $cleanPhone, $matches)) {
            // Already in international format
            $number = $matches[1];
            switch ($format) {
                case 'international':
                    return $cleanPhone;
                case 'local':
                    return '0' . $number;
                case 'display':
                    return '+234 ' . substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6);
                default:
                    return $cleanPhone;
            }
        } elseif (preg_match('/^([7-9][0-9]{8})$/', $cleanPhone, $matches)) {
            // Mobile number without prefix: xxxxxxxxx -> +234xxxxxxxxx
            $number = $matches[1];
            switch ($format) {
                case 'international':
                    return '+234' . $number;
                case 'local':
                    return '0' . $number;
                case 'display':
                    return '+234 ' . substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6);
                default:
                    return '+234' . $number;
            }
        }

        // If no Nigerian pattern matches, return original
        return $phone;
    } catch (Exception $e) {
        error_log('Phone Formatting Error: ' . $e->getMessage());
        return $phone; // Return original on error
    }
}

/**
 * Log database activity
 *
 * @param string $action
 * @param string $resourceType
 * @param mixed $resourceId
 * @param string $description
 * @param string $ipAddress
 * @param int $userId
 */
function logActivity($action, $resourceType, $resourceId, $description, $ipAddress = null, $userId = null)
{
    try {
        if ($ipAddress === null) {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        }

        $sql = "INSERT INTO activity_logs (user_id, action, resource_type, resource_id, description, ip_address)
VALUES (?, ?, ?, ?, ?, ?)";

        executeQuery($sql, [$userId, $action, $resourceType, $resourceId, $description, $ipAddress]);
    } catch (Exception $e) {
        error_log('Activity Log Error: ' . $e->getMessage());
    }
}

/**
 * Get database connection (for API compatibility)
 *
 * @return PDO
 */
function getDbConnection()
{
    return ensureDbConnection();
}


/**
 * Ensure the global database connection exists and is a PDO instance
 *
 * @return PDO
 * @throws Exception
 */
function ensureDbConnection()
{
    global $conn;

    if (!isset($conn) || !($conn instanceof PDO)) {
        throw new Exception('Database connection not initialized or invalid PDO instance');
    }

    return $conn;
}
