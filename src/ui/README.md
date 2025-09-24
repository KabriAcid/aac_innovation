# Decision Tree Support Chat Widget

A comprehensive, accessible decision-tree chatbot widget for React applications. Features a floating chat button with an expandable panel that guides users through nested question-and-answer flows, creating natural conversation branches based on user choices.

## Features

- 🌳 **Decision Tree Structure** - Nested Q&A flows that branch based on user selections
- 🎯 **Floating Chat Interface** - Clean, modern floating action button with expandable chat panel
- 💬 **Interactive Conversations** - Questions appear as user messages, answers as bot responses
- ↩️ **Navigation Controls** - Back button to navigate up the decision tree
- ♿ **Fully Accessible** - ARIA labels, keyboard navigation, focus management, and screen reader support
- 📱 **Responsive Design** - Works seamlessly on mobile, tablet, and desktop
- 🎨 **Customizable Styling** - Tailwind-based with theme customization options
- 🔧 **Easy Integration** - Drop-in component with sensible defaults
- 📊 **State Management** - Built-in state handling with custom React hook

## Quick Start

```tsx
import SupportChatWidget from './components/ui/SupportChatWidget';

function App() {
  return (
    <div>
      {/* Your app content */}
      <SupportChatWidget />
    </div>
  );
}
```

## Decision Tree Structure

The widget uses a nested tree structure where each node can have follow-up questions:

```tsx
interface ChatNode {
  id: string;           // Unique identifier
  question: string;     // Question text displayed to user
  answer: string;       // Response text from bot
  followUps?: ChatNode[]; // Optional nested follow-up questions
  category?: string;    // Optional category for organization
}
```

## API Reference

### SupportChatWidget Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `chatTree` | `ChatNode[]` | `defaultChatTree` | Array of root-level chat nodes |
| `qa` | `ChatNode[]` | `undefined` | Alternative prop name for chat tree (takes precedence) |
| `welcomeMessage` | `string` | Default welcome text | Custom welcome message shown when chat opens |
| `position` | `'bottom-right' \| 'bottom-left'` | `'bottom-right'` | Position of floating button |
| `theme` | `{ primary?: string; secondary?: string }` | Default blue theme | Custom theme colors |
| `enabled` | `boolean` | `true` | Whether to show the widget |
| `className` | `string` | `''` | Additional CSS classes for container |

## Usage Examples

### Basic Usage

```tsx
<SupportChatWidget />
```

### Custom Decision Tree

```tsx
const customChatTree = [
  {
    id: 'billing',
    question: 'I have a billing question',
    answer: 'I can help with billing issues. What specifically would you like to know?',
    followUps: [
      {
        id: 'payment-methods',
        question: 'What payment methods do you accept?',
        answer: 'We accept all major credit cards, PayPal, and bank transfers.',
        followUps: [
          {
            id: 'update-payment',
            question: 'How do I update my payment method?',
            answer: 'Go to Account Settings > Billing > Payment Methods to update your information.'
          }
        ]
      },
      {
        id: 'refund-policy',
        question: 'What is your refund policy?',
        answer: 'We offer full refunds within 30 days of purchase, no questions asked.'
      }
    ]
  }
];

<SupportChatWidget chatTree={customChatTree} />
```

### Custom Positioning and Theme

```tsx
<SupportChatWidget
  position="bottom-left"
  welcomeMessage="Hello! How can I assist you today?"
  theme={{
    primary: 'bg-green-600 hover:bg-green-700',
    secondary: 'bg-gray-50 hover:bg-gray-100'
  }}
/>
```

## Conversation Flow

1. **Welcome**: User opens chat and sees welcome message
2. **Root Options**: User sees top-level questions as clickable buttons
3. **Selection**: User clicks a question, it appears as their message
4. **Response**: Bot responds with the answer
5. **Follow-ups**: If the answer has `followUps`, new options appear
6. **Navigation**: User can go back up the tree or start over
7. **End**: When no more follow-ups exist, conversation ends with restart option

## State Management Hook

The `useSupportChat` hook provides programmatic control:

```tsx
import { useSupportChat } from './components/ui/SupportChatWidget/useSupportChat';

function CustomChatImplementation() {
  const {
    isOpen,
    messages,
    currentOptions,
    hasNewMessage,
    openChat,
    closeChat,
    toggleChat,
    selectOption,
    clearChat,
    markAsRead,
    goBack,
    canGoBack
  } = useSupportChat(chatTree, 'Welcome message');

  // Use the hook's methods for custom interactions
}
```

## Backend Integration

While the widget ships with client-side decision trees by default, you can easily integrate with backend services:

```tsx
function AppWithBackendChatTree() {
  const [chatTree, setChatTree] = useState([]);
  
  useEffect(() => {
    fetch('/api/support/chat-tree')
      .then(res => res.json())
      .then(setChatTree);
  }, []);

  return <SupportChatWidget chatTree={chatTree} />;
}
```

### Dynamic Tree Loading

For large decision trees, you can load branches dynamically:

```tsx
const dynamicChatTree = [
  {
    id: 'technical-support',
    question: 'Technical Support',
    answer: 'Loading technical support options...',
    followUps: [] // Will be populated dynamically
  }
];

// In your component, update followUps based on user selections
```

## Accessibility Features

- **Keyboard Navigation**: Full keyboard support with logical tab order
- **Screen Readers**: Comprehensive ARIA labels and live regions for new messages
- **Focus Management**: Proper focus handling when opening/closing and navigating
- **High Contrast**: Accessible color combinations with proper contrast ratios
- **Navigation Aids**: Clear back button and conversation state indicators

### Keyboard Shortcuts

- `Tab/Shift+Tab`: Navigate between interactive elements
- `Enter/Space`: Select options and activate buttons
- `Escape`: Close chat panel and return focus to button
- `Arrow Keys`: Navigate through option lists

## Styling and Customization

The widget uses Tailwind CSS classes and follows your project's existing design system. All styling is contained within the component with no external dependencies.

### Custom Styling

```tsx
<SupportChatWidget
  className="custom-chat-widget"
  theme={{
    primary: 'bg-purple-600 hover:bg-purple-700',
    secondary: 'bg-yellow-50 hover:bg-yellow-100'
  }}
/>
```

## Performance Considerations

- Lightweight implementation with no external dependencies
- Efficient re-rendering with React hooks and memoization
- Lazy rendering - panel content only renders when opened
- Optimized scroll behavior and message handling
- Tree navigation without full re-renders

## Best Practices

### Decision Tree Design

1. **Keep branches focused** - Each path should address a specific user need
2. **Limit depth** - Avoid trees deeper than 4-5 levels
3. **Provide escape routes** - Always offer ways to start over or go back
4. **Clear language** - Use simple, direct questions and answers
5. **Logical grouping** - Group related topics under common parent nodes

### Content Guidelines

- Write questions from the user's perspective
- Keep answers concise but complete
- Use consistent tone and terminology
- Include next steps or actions when appropriate
- Test conversation flows with real users

## Browser Support

Compatible with all modern browsers that support:
- ES6+ JavaScript features
- CSS Flexbox and Grid
- React 18+
- Tailwind CSS 3+

## Contributing

When extending the widget:

1. Maintain accessibility standards
2. Follow existing TypeScript patterns
3. Add appropriate ARIA labels for new features
4. Test keyboard navigation thoroughly
5. Ensure responsive design principles
6. Test decision tree navigation flows

## Troubleshooting

### Common Issues

**Widget not appearing**: Check that `enabled={true}` and the component is rendered within your layout.

**Navigation not working**: Ensure your chat tree has proper `id` fields and valid `followUps` structure.

**Styling conflicts**: Ensure Tailwind CSS is properly configured and no conflicting styles override the widget.

**Accessibility warnings**: Verify all interactive elements have appropriate ARIA labels and the chat panel has proper dialog semantics.

**Deep tree performance**: For very large trees, consider lazy loading branches or limiting tree depth.

### Decision Tree Validation

```tsx
// Helper function to validate tree structure
function validateChatTree(nodes: ChatNode[]): boolean {
  const ids = new Set();
  
  function validateNode(node: ChatNode): boolean {
    if (ids.has(node.id)) return false; // Duplicate ID
    ids.add(node.id);
    
    if (node.followUps) {
      return node.followUps.every(validateNode);
    }
    return true;
  }
  
  return nodes.every(validateNode);
}
```