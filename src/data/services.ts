import { Service } from '@/types';

export const services: Service[] = [
  // Cybersecurity
  {
    id: 'penetration-testing',
    title: 'Penetration Testing',
    description: 'Comprehensive security assessments to identify vulnerabilities in your systems and applications.',
    icon: 'Shield',
    category: 'cybersecurity',
    features: [
      'Network penetration testing',
      'Web application security testing',
      'Mobile app security assessment',
      'Social engineering testing',
      'Detailed vulnerability reports',
      'Remediation recommendations'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦2,125,000',
      description: 'Starting price for basic penetration testing'
    }
  },
  {
    id: 'security-consulting',
    title: 'Security Consulting',
    description: 'Expert cybersecurity guidance to strengthen your organization\'s security posture.',
    icon: 'ShieldCheck',
    category: 'cybersecurity',
    features: [
      'Security policy development',
      'Compliance assessment (ISO 27001, SOC 2)',
      'Risk assessment and management',
      'Security awareness training',
      'Incident response planning',
      'Security architecture review'
    ],
    pricing: {
      model: 'consulting',
      startingPrice: '₦127,500/hour',
      description: 'Hourly consulting rate for security experts'
    }
  },

  // Fintech
  {
    id: 'payment-gateway',
    title: 'Payment Gateway Integration',
    description: 'Seamless integration of secure payment processing solutions for your business.',
    icon: 'CreditCard',
    category: 'fintech',
    features: [
      'Multi-currency support',
      'Mobile money integration',
      'Card payment processing',
      'Real-time transaction monitoring',
      'Fraud detection and prevention',
      'PCI DSS compliance'
    ],
    pricing: {
      model: 'transaction',
      startingPrice: '2.5% + ₦255',
      description: 'Per transaction fee'
    }
  },
  {
    id: 'digital-wallet',
    title: 'Digital Wallet Solutions',
    description: 'Custom digital wallet development for secure financial transactions.',
    icon: 'Wallet',
    category: 'fintech',
    features: [
      'Multi-platform wallet apps',
      'Biometric authentication',
      'QR code payments',
      'P2P transfers',
      'Transaction history',
      'Integration with banking APIs'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦12,750,000',
      description: 'Complete digital wallet solution'
    }
  },

  // Cloud & Enterprise
  {
    id: 'cloud-migration',
    title: 'Cloud Migration Services',
    description: 'Seamless migration of your infrastructure and applications to the cloud.',
    icon: 'Cloud',
    category: 'cloud',
    features: [
      'AWS, Azure, GCP migration',
      'Application modernization',
      'Data migration and backup',
      'Performance optimization',
      'Cost optimization strategies',
      '24/7 migration support'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦4,250,000',
      description: 'Starting price for basic cloud migration'
    }
  },
  {
    id: 'enterprise-software',
    title: 'Enterprise Software Development',
    description: 'Custom enterprise applications tailored to your business needs.',
    icon: 'Building2',
    category: 'cloud',
    features: [
      'Custom ERP systems',
      'CRM development',
      'Workflow automation',
      'API development and integration',
      'Scalable architecture',
      'Ongoing maintenance and support'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦21,250,000',
      description: 'Starting price for enterprise software projects'
    }
  },

  // AI & Automation
  {
    id: 'ai-chatbots',
    title: 'AI Chatbots & Virtual Assistants',
    description: 'Intelligent conversational AI to enhance customer service and engagement.',
    icon: 'Bot',
    category: 'ai',
    features: [
      'Natural language processing',
      'Multi-language support',
      'Integration with existing systems',
      'Machine learning capabilities',
      'Analytics and reporting',
      'Continuous learning and improvement'
    ],
    pricing: {
      model: 'subscription',
      startingPrice: '₦254,150/month',
      description: 'Monthly subscription for AI chatbot service'
    }
  },
  {
    id: 'process-automation',
    title: 'Business Process Automation',
    description: 'Streamline operations with intelligent automation solutions.',
    icon: 'Zap',
    category: 'ai',
    features: [
      'Workflow automation',
      'Document processing',
      'Data entry automation',
      'Email automation',
      'Report generation',
      'Integration with existing tools'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦2,550,000',
      description: 'Starting price for automation implementation'
    }
  },

  // IoT & Smart Tech
  {
    id: 'iot-solutions',
    title: 'IoT Device Management',
    description: 'Comprehensive IoT solutions for smart device connectivity and management.',
    icon: 'Wifi',
    category: 'iot',
    features: [
      'Device connectivity and monitoring',
      'Real-time data collection',
      'Remote device management',
      'Predictive maintenance',
      'Custom dashboard development',
      'Edge computing solutions'
    ],
    pricing: {
      model: 'subscription',
      startingPrice: '₦169,150/month',
      description: 'Monthly subscription per 100 devices'
    }
  },
  {
    id: 'smart-building',
    title: 'Smart Building Solutions',
    description: 'Intelligent building management systems for energy efficiency and security.',
    icon: 'Home',
    category: 'iot',
    features: [
      'Energy management systems',
      'Access control integration',
      'Environmental monitoring',
      'Automated lighting and HVAC',
      'Security system integration',
      'Mobile app control'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦8,500,000',
      description: 'Starting price for smart building implementation'
    }
  },

  // Strategic Services
  {
    id: 'digital-transformation',
    title: 'Digital Transformation Consulting',
    description: 'Strategic guidance to modernize your business processes and technology stack.',
    icon: 'Target',
    category: 'strategic',
    features: [
      'Digital strategy development',
      'Technology roadmap planning',
      'Change management support',
      'Process optimization',
      'Technology vendor selection',
      'Implementation oversight'
    ],
    pricing: {
      model: 'consulting',
      startingPrice: '₦170,000/hour',
      description: 'Hourly rate for senior consultants'
    }
  },
  {
    id: 'tech-audit',
    title: 'Technology Audit & Assessment',
    description: 'Comprehensive evaluation of your current technology infrastructure and processes.',
    icon: 'Search',
    category: 'strategic',
    features: [
      'Infrastructure assessment',
      'Security posture evaluation',
      'Performance analysis',
      'Cost optimization opportunities',
      'Compliance review',
      'Detailed recommendations report'
    ],
    pricing: {
      model: 'one-time',
      startingPrice: '₦1,275,000',
      description: 'Starting price for technology audit'
    }
  }
];

export const getServicesByCategory = (category: string) => {
  return services.filter(service => service.category === category);
};

export const getServiceById = (id: string) => {
  return services.find(service => service.id === id);
};