/**
 * API Configuration
 * Supports different environments
 */

// Use environment variable if available, otherwise fallback to localhost
// Direct backend path (bypasses .htaccess rewrites)
const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost/aac_innovation/backend/api';

// API timeout in milliseconds
export const API_TIMEOUT = 30000;

// Helper function to build full URL
export const buildApiUrl = (endpoint: string): string => {
  // Remove leading slash if present
  const cleanEndpoint = endpoint.startsWith('/') ? endpoint.slice(1) : endpoint;
  return `${API_BASE_URL}/${cleanEndpoint}`;
};

// Common headers for all requests
export const getCommonHeaders = (): HeadersInit => {
  const headers: HeadersInit = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  };

  // Add auth token if available
  const token = localStorage.getItem('authToken');
  if (token) {
    headers['Authorization'] = `Bearer ${token}`;
  }

  return headers;
};

// Request configuration helper
export const createRequestConfig = (
  method: string = 'GET',
  body?: any
): RequestInit => {
  const config: RequestInit = {
    method,
    headers: getCommonHeaders(),
    // Remove credentials if not using cookies/sessions
    // credentials: 'include',
  };

  if (body && (method === 'POST' || method === 'PUT' || method === 'PATCH')) {
    config.body = JSON.stringify(body);
  }

  return config;
};

// Log API configuration on startup (development only)
if (import.meta.env.DEV) {
  console.log('🔧 API Configuration:', {
    baseUrl: API_BASE_URL,
    timeout: API_TIMEOUT,
    mode: import.meta.env.MODE,
  });
}

export default API_BASE_URL;