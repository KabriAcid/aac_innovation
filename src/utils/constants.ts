export const COMPANY_INFO = {
  name: 'AAC Innovation',
  tagline: 'Driving Africa\'s Tech Future',
  description: 'Innovative, scalable, and accessible digital services in cybersecurity, fintech, cloud computing, AI, IoT, and strategic consulting.',
  email: 'info@aacinnovation.com',
  phone: '+234 123 456 7890',
  address: 'Lagos, Nigeria',
  socialLinks: {
    linkedin: 'https://linkedin.com/company/aac-innovation',
    twitter: 'https://twitter.com/aacinnovation',
    facebook: 'https://facebook.com/aacinnovation',
  },
};

export const NAVIGATION_ITEMS = [
  { name: 'Home', href: '/' },
  { name: 'Services', href: '/services' },
  { name: 'About', href: '/about' },
  { name: 'Contact', href: '/contact' },
];

export const SERVICE_CATEGORIES = {
  cybersecurity: {
    title: 'Cybersecurity',
    description: 'Comprehensive security solutions to protect your digital assets',
    icon: 'Shield',
  },
  fintech: {
    title: 'Fintech & Digital Payments',
    description: 'Revolutionary financial technology solutions',
    icon: 'CreditCard',
  },
  cloud: {
    title: 'Cloud & Enterprise Solutions',
    description: 'Scalable cloud infrastructure and enterprise systems',
    icon: 'Cloud',
  },
  ai: {
    title: 'AI & Automation',
    description: 'Intelligent automation and machine learning solutions',
    icon: 'Brain',
  },
  iot: {
    title: 'Smart Tech & IoT',
    description: 'Connected devices and smart technology integration',
    icon: 'Wifi',
  },
  strategic: {
    title: 'Strategic Services',
    description: 'Strategic consulting and digital transformation',
    icon: 'Target',
  },
};

export const PRICING_MODELS = {
  subscription: 'Monthly/Annual Subscription',
  'one-time': 'One-time Project Fee',
  transaction: 'Transaction-based Pricing',
  licensing: 'Software Licensing',
  consulting: 'Hourly Consulting Rate',
};

export const TIME_SLOTS = [
  '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
  '12:00', '12:30', '13:00', '13:30', '14:00', '14:30',
  '15:00', '15:30', '16:00', '16:30', '17:00'
];

export const API_ENDPOINTS = {
  contact: '/api/contact.php',
  booking: '/api/bookings.php',
  services: '/api/services.php',
};