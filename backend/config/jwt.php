<?php

// Define the JWT_SECRET constant
const JWT_SECRET = 'your_secret_key';

/**
 * Encode a JWT token.
 *
 * @param array $payload The payload data.
 * @param string $secret The secret key.
 * @return string The encoded JWT token.
 */
function jwt_encode(array $payload, string $secret): string
{
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($payload);

    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
}

/**
 * Decode a JWT token.
 *
 * @param string $jwt The JWT token.
 * @param string $secret The secret key.
 * @return array|null The decoded payload, or null if invalid.
 */
function jwt_decode(string $jwt, string $secret): ?array
{
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) {
        return null;
    }

    [$base64UrlHeader, $base64UrlPayload, $base64UrlSignature] = $parts;

    $header = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlHeader)), true);
    $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlPayload)), true);
    $signature = base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlSignature));

    $expectedSignature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

    if (!hash_equals($expectedSignature, $signature)) {
        return null;
    }

    return $payload;
}
