<?php
/**
 * Services API Endpoint
 * 
 * Provides service data for the frontend application
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only allow GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

try {
    // Service data (in a real application, this would come from a database)
    $services = [
        [
            'id' => 'penetration-testing',
            'title' => 'Penetration Testing',
            'description' => 'Comprehensive security assessments to identify vulnerabilities in your systems and applications.',
            'category' => 'cybersecurity',
            'features' => [
                'Network penetration testing',
                'Web application security testing',
                'Mobile app security assessment',
                'Social engineering testing',
                'Detailed vulnerability reports',
                'Remediation recommendations'
            ],
            'pricing' => [
                'model' => 'one-time',
                'startingPrice' => '$2,500',
                'description' => 'Starting price for basic penetration testing'
            ]
        ],
        [
            'id' => 'security-consulting',
            'title' => 'Security Consulting',
            'description' => 'Expert cybersecurity guidance to strengthen your organization\'s security posture.',
            'category' => 'cybersecurity',
            'features' => [
                'Security policy development',
                'Compliance assessment (ISO 27001, SOC 2)',
                'Risk assessment and management',
                'Security awareness training',
                'Incident response planning',
                'Security architecture review'
            ],
            'pricing' => [
                'model' => 'consulting',
                'startingPrice' => '$150/hour',
                'description' => 'Hourly consulting rate for security experts'
            ]
        ],
        [
            'id' => 'payment-gateway',
            'title' => 'Payment Gateway Integration',
            'description' => 'Seamless integration of secure payment processing solutions for your business.',
            'category' => 'fintech',
            'features' => [
                'Multi-currency support',
                'Mobile money integration',
                'Card payment processing',
                'Real-time transaction monitoring',
                'Fraud detection and prevention',
                'PCI DSS compliance'
            ],
            'pricing' => [
                'model' => 'transaction',
                'startingPrice' => '2.5% + $0.30',
                'description' => 'Per transaction fee'
            ]
        ],
        [
            'id' => 'digital-wallet',
            'title' => 'Digital Wallet Solutions',
            'description' => 'Custom digital wallet development for secure financial transactions.',
            'category' => 'fintech',
            'features' => [
                'Multi-platform wallet apps',
                'Biometric authentication',
                'QR code payments',
                'P2P transfers',
                'Transaction history',
                'Integration with banking APIs'
            ],
            'pricing' => [
                'model' => 'one-time',
                'startingPrice' => '$15,000',
                'description' => 'Complete digital wallet solution'
            ]
        ],
        [
            'id' => 'cloud-migration',
            'title' => 'Cloud Migration Services',
            'description' => 'Seamless migration of your infrastructure and applications to the cloud.',
            'category' => 'cloud',
            'features' => [
                'AWS, Azure, GCP migration',
                'Application modernization',
                'Data migration and backup',
                'Performance optimization',
                'Cost optimization strategies',
                '24/7 migration support'
            ],
            'pricing' => [
                'model' => 'one-time',
                'startingPrice' => '$5,000',
                'description' => 'Starting price for basic cloud migration'
            ]
        ],
        [
            'id' => 'ai-chatbots',
            'title' => 'AI Chatbots & Virtual Assistants',
            'description' => 'Intelligent conversational AI to enhance customer service and engagement.',
            'category' => 'ai',
            'features' => [
                'Natural language processing',
                'Multi-language support',
                'Integration with existing systems',
                'Machine learning capabilities',
                'Analytics and reporting',
                'Continuous learning and improvement'
            ],
            'pricing' => [
                'model' => 'subscription',
                'startingPrice' => '$299/month',
                'description' => 'Monthly subscription for AI chatbot service'
            ]
        ]
    ];
    
    // Handle query parameters
    $category = $_GET['category'] ?? null;
    $serviceId = $_GET['id'] ?? null;
    
    // Filter by specific service ID
    if ($serviceId) {
        $service = array_filter($services, function($s) use ($serviceId) {
            return $s['id'] === $serviceId;
        });
        
        if (empty($service)) {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Service not found'
            ]);
            exit();
        }
        
        echo json_encode([
            'success' => true,
            'data' => array_values($service)[0]
        ]);
        exit();
    }
    
    // Filter by category
    if ($category) {
        $services = array_filter($services, function($s) use ($category) {
            return $s['category'] === $category;
        });
    }
    
    // Return all services or filtered services
    echo json_encode([
        'success' => true,
        'data' => array_values($services),
        'total' => count($services)
    ]);
    
} catch (Exception $e) {
    error_log("Services API error: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while fetching services'
    ]);
}
?>