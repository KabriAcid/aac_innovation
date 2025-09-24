export interface ChatNode {
  id: string;
  question: string;
  answer: string;
  followUps?: ChatNode[];
  category?: string;
}

export const defaultChatTree: ChatNode[] = [
  {
    id: 'getting-started',
    question: 'How do I get started with AAC Innovation?',
    answer: 'Getting started is easy! You can begin by creating an account and exploring our communication tools. What would you like to know more about?',
    followUps: [
      {
        id: 'create-account',
        question: 'How do I create an account?',
        answer: 'Simply click the "Sign Up" button on our homepage, enter your email and create a password. You\'ll receive a confirmation email to activate your account.',
        followUps: [
          {
            id: 'account-verification',
            question: 'I didn\'t receive the confirmation email',
            answer: 'Check your spam folder first. If it\'s not there, you can request a new confirmation email from the login page, or contact our support team for assistance.'
          },
          {
            id: 'account-types',
            question: 'What types of accounts are available?',
            answer: 'We offer Personal accounts for individuals, Family accounts for multiple users, and Professional accounts for therapists and educators with advanced features.'
          }
        ]
      },
      {
        id: 'first-steps',
        question: 'What should I do after creating an account?',
        answer: 'After creating your account, complete your profile setup and take our guided tour to learn about the key features. Would you like help with any specific area?',
        followUps: [
          {
            id: 'profile-setup',
            question: 'How do I set up my profile?',
            answer: 'Go to Settings > Profile to add your personal information, communication preferences, and accessibility settings. This helps us customize your experience.'
          },
          {
            id: 'guided-tour',
            question: 'Where do I find the guided tour?',
            answer: 'The guided tour automatically appears for new users, but you can also access it anytime from the Help menu or by clicking the "?" icon in the top navigation.'
          }
        ]
      }
    ]
  },
  {
    id: 'technical-support',
    question: 'I\'m having technical issues',
    answer: 'I\'m sorry to hear you\'re experiencing technical difficulties. Let me help you troubleshoot. What type of issue are you encountering?',
    followUps: [
      {
        id: 'device-compatibility',
        question: 'My device isn\'t working properly',
        answer: 'Device compatibility issues can usually be resolved quickly. What type of device are you using?',
        followUps: [
          {
            id: 'tablet-issues',
            question: 'Tablet (iPad/Android)',
            answer: 'For tablet issues, try restarting the app first. Make sure you\'re running the latest version from the App Store or Google Play. Most tablets from the last 5 years are fully supported.',
            followUps: [
              {
                id: 'tablet-performance',
                question: 'The app is running slowly',
                answer: 'Close other apps running in the background, restart your tablet, and ensure you have at least 1GB of free storage space. If issues persist, try reinstalling the app.'
              }
            ]
          },
          {
            id: 'computer-issues',
            question: 'Computer (Windows/Mac)',
            answer: 'For computer issues, ensure you\'re using a supported browser (Chrome, Firefox, Safari, or Edge). Clear your browser cache and disable browser extensions that might interfere.',
            followUps: [
              {
                id: 'browser-compatibility',
                question: 'Which browsers work best?',
                answer: 'Chrome and Firefox offer the best experience. Safari works well on Mac. Make sure your browser is updated to the latest version for optimal performance.'
              }
            ]
          }
        ]
      },
      {
        id: 'login-problems',
        question: 'I can\'t log in to my account',
        answer: 'Login issues are frustrating! Let\'s get you back in. What specific problem are you experiencing?',
        followUps: [
          {
            id: 'forgot-password',
            question: 'I forgot my password',
            answer: 'Click "Forgot Password" on the login page, enter your email address, and we\'ll send you a reset link. Check your spam folder if you don\'t see it within a few minutes.'
          },
          {
            id: 'account-locked',
            question: 'My account seems to be locked',
            answer: 'Accounts are temporarily locked after multiple failed login attempts for security. Wait 15 minutes and try again, or contact support if you need immediate access.'
          },
          {
            id: 'email-not-recognized',
            question: 'It says my email isn\'t recognized',
            answer: 'Double-check the email address for typos. If you have multiple email addresses, try the others. You can also contact support to help locate your account.'
          }
        ]
      }
    ]
  },
  {
    id: 'features-pricing',
    question: 'What features and pricing do you offer?',
    answer: 'We offer flexible plans to meet different needs and budgets. Our platform includes communication tools, customization options, and support resources. What would you like to know more about?',
    followUps: [
      {
        id: 'pricing-plans',
        question: 'What are your pricing plans?',
        answer: 'We have three main plans: Free (basic features), Premium ($9.99/month with advanced features), and Professional ($19.99/month for therapists and educators). Educational discounts are available.',
        followUps: [
          {
            id: 'free-plan-features',
            question: 'What\'s included in the free plan?',
            answer: 'The free plan includes basic communication boards, 50 custom phrases, cloud sync across 2 devices, and community support. Perfect for trying out our platform!'
          },
          {
            id: 'premium-features',
            question: 'What extra features does Premium include?',
            answer: 'Premium adds unlimited custom phrases, advanced voice options, offline mode, priority support, family sharing, and access to our premium symbol library.'
          },
          {
            id: 'educational-discounts',
            question: 'How do educational discounts work?',
            answer: 'Schools and educational institutions get 50% off Professional plans. Contact our education team with your institution details to set up discounted accounts.'
          }
        ]
      },
      {
        id: 'customization-options',
        question: 'How customizable is the platform?',
        answer: 'Our platform is highly customizable to meet individual needs and preferences. You can personalize almost every aspect of your communication experience. What would you like to customize?',
        followUps: [
          {
            id: 'interface-customization',
            question: 'Can I change the interface appearance?',
            answer: 'Yes! You can adjust themes, colors, button sizes, layouts, and fonts. We also offer high contrast modes and other accessibility options to ensure comfortable use.'
          },
          {
            id: 'vocabulary-customization',
            question: 'Can I add my own words and phrases?',
            answer: 'Absolutely! Add unlimited custom vocabulary, create personal phrase categories, import your own images, and even record custom audio. Make it truly yours!'
          }
        ]
      }
    ]
  },
  {
    id: 'support-contact',
    question: 'How can I get additional help?',
    answer: 'We\'re here to support you every step of the way! We offer multiple ways to get help based on your needs and preferences. How would you prefer to get assistance?',
    followUps: [
      {
        id: 'contact-methods',
        question: 'What support options are available?',
        answer: 'We offer email support (24-48 hour response), live chat during business hours (9 AM - 5 PM EST), phone support for Premium users, and extensive online documentation.',
        followUps: [
          {
            id: 'live-chat-hours',
            question: 'When is live chat available?',
            answer: 'Live chat is available Monday through Friday, 9 AM to 5 PM Eastern Time. Outside these hours, you can leave a message and we\'ll respond first thing the next business day.'
          },
          {
            id: 'phone-support',
            question: 'How do I access phone support?',
            answer: 'Phone support is available for Premium and Professional subscribers. You\'ll find the support phone number in your account dashboard under the "Contact Support" section.'
          }
        ]
      },
      {
        id: 'training-resources',
        question: 'Do you offer training or tutorials?',
        answer: 'Yes! We provide comprehensive training resources including video tutorials, webinars, one-on-one training sessions, and certification programs for professionals.',
        followUps: [
          {
            id: 'video-tutorials',
            question: 'Where can I find video tutorials?',
            answer: 'Video tutorials are available in the Help section of your account, on our YouTube channel, and in our online knowledge base. They cover everything from basic setup to advanced features.'
          },
          {
            id: 'professional-training',
            question: 'What training is available for professionals?',
            answer: 'We offer specialized training for speech therapists, educators, and care providers, including certification programs, continuing education credits, and group training sessions.'
          }
        ]
      }
    ]
  }
];

export const welcomeMessage = "Hi! I'm here to help you with AAC Innovation. I can answer questions about getting started, technical issues, features, pricing, and support options. What would you like to know about?";