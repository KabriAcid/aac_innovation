import React, { useRef, useEffect } from 'react';
import { MessageCircle, X, RefreshCw, ArrowLeft, Send } from 'lucide-react';
import { useSupportChat } from './useSupportChat';
import { ChatNode, defaultChatTree, welcomeMessage as defaultWelcomeMessage } from './data';

export interface SupportChatWidgetProps {
  /** Custom chat tree data to override defaults */
  chatTree?: ChatNode[];
  /** Alternative prop name for chat tree data */
  qa?: ChatNode[];
  /** Custom welcome message */
  welcomeMessage?: string;
  /** Position of the floating button */
  position?: 'bottom-right' | 'bottom-left';
  /** Custom theme colors */
  theme?: {
    primary?: string;
    secondary?: string;
  };
  /** Whether to show the widget */
  enabled?: boolean;
  /** Custom CSS classes for the container */
  className?: string;
}

const SupportChatWidget: React.FC<SupportChatWidgetProps> = ({
  chatTree = defaultChatTree,
  qa,
  welcomeMessage = defaultWelcomeMessage,
  position = 'bottom-right',
  theme,
  enabled = true,
  className = ''
}) => {
  // Use qa prop if provided, otherwise use chatTree
  const tree = qa || chatTree;
  
  const {
    isOpen,
    messages,
    isTyping,
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
  } = useSupportChat(tree, welcomeMessage);

  const chatPanelRef = useRef<HTMLDivElement>(null);
  const messagesEndRef = useRef<HTMLDivElement>(null);
  const buttonRef = useRef<HTMLButtonElement>(null);

  // Auto-scroll to bottom when new messages arrive
  useEffect(() => {
    if (messagesEndRef.current && isOpen) {
      messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  }, [messages, isOpen]);

  // Focus management
  useEffect(() => {
    if (isOpen && chatPanelRef.current) {
      const focusableElements = chatPanelRef.current.querySelectorAll(
        'button, input, textarea, select, a[href], [tabindex]:not([tabindex="-1"])'
      );
      const firstElement = focusableElements[0] as HTMLElement;
      firstElement?.focus();
    }
  }, [isOpen]);

  // Handle escape key
  useEffect(() => {
    const handleEscape = (e: KeyboardEvent) => {
      if (e.key === 'Escape' && isOpen) {
        closeChat();
        buttonRef.current?.focus();
      }
    };

    if (isOpen) {
      document.addEventListener('keydown', handleEscape);
      return () => document.removeEventListener('keydown', handleEscape);
    }
  }, [isOpen, closeChat]);

  if (!enabled) return null;

  const positionClasses = {
    'bottom-right': 'bottom-4 right-4',
    'bottom-left': 'bottom-4 left-4'
  };

  const primaryColor = theme?.primary || 'bg-blue-600 hover:bg-blue-700';
  const secondaryColor = theme?.secondary || 'bg-gray-100 hover:bg-gray-200';

  return (
    <div className={`fixed ${positionClasses[position]} z-50 ${className}`}>
      {/* Chat Panel */}
      {isOpen && (
        <div
          ref={chatPanelRef}
          className="mb-4 w-80 max-w-[calc(100vw-2rem)] bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden"
          role="dialog"
          aria-modal="true"
          aria-labelledby="chat-title"
        >
          {/* Header */}
          <div className={`${primaryColor} text-white p-4 flex items-center justify-between`}>
            <div className="flex items-center space-x-2">
              {canGoBack && (
                <button
                  onClick={goBack}
                  className="p-1 hover:bg-white/20 rounded transition-colors"
                  title="Go back"
                  aria-label="Go back to previous options"
                >
                  <ArrowLeft size={18} />
                </button>
              )}
              <h2 id="chat-title" className="font-semibold text-lg">
                Support Chat
              </h2>
            </div>
            <div className="flex items-center space-x-2">
              <button
                onClick={clearChat}
                className="p-1 hover:bg-white/20 rounded transition-colors"
                title="Clear chat"
                aria-label="Clear chat history"
              >
                <RefreshCw size={18} />
              </button>
              <button
                onClick={closeChat}
                className="p-1 hover:bg-white/20 rounded transition-colors"
                title="Close chat"
                aria-label="Close chat"
              >
                <X size={18} />
              </button>
            </div>
          </div>

          {/* Messages */}
          <div className="h-80 overflow-y-auto p-4 space-y-4">
            <div
              role="log"
              aria-live="polite"
              aria-label="Chat messages"
              className="space-y-4"
            >
              {messages.map((message) => (
                <div
                  key={message.id}
                  className={`flex ${
                    message.type === 'user' ? 'justify-end' : 'justify-start'
                  }`}
                >
                  <div
                    className={`max-w-[85%] px-3 py-2 rounded-lg ${
                      message.type === 'user'
                        ? 'bg-blue-600 text-white'
                        : message.type === 'welcome'
                        ? 'bg-gray-50 text-gray-800 border border-gray-200'
                        : 'bg-gray-100 text-gray-800'
                    }`}
                    role={message.type === 'bot' ? 'status' : undefined}
                    aria-label={
                      message.type === 'bot'
                        ? 'Support response'
                        : message.type === 'welcome'
                        ? 'Welcome message'
                        : 'Your message'
                    }
                  >
                    <div className="text-sm leading-relaxed">
                      {message.content}
                    </div>
                    <div className="text-xs mt-1 opacity-75">
                      {message.timestamp.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                      })}
                    </div>
                  </div>
                </div>
              ))}
              
              {/* Typing Indicator */}
              {isTyping && (
                <div className="flex justify-start">
                  <div className="max-w-[85%] px-3 py-2 rounded-lg bg-gray-100 text-gray-800">
                    <div className="flex items-center">
                      <div className="flex space-x-1">
                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style={{ animationDelay: '0ms' }}></div>
                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style={{ animationDelay: '150ms' }}></div>
                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style={{ animationDelay: '300ms' }}></div>
                      </div>
                    </div>
                  </div>
                </div>
              )}
            </div>
            <div ref={messagesEndRef} />
          </div>

          {/* Current Options */}
          {currentOptions.length > 0 && !isTyping && (
            <div className="border-t border-gray-200 p-4">
              <h3 className="text-sm font-medium text-gray-700 mb-3">
                {canGoBack ? 'Choose an option:' : 'How can I help you?'}
              </h3>
              <div className="space-y-2 max-h-40 overflow-y-auto">
                {currentOptions.map((option) => (
                  <button
                    key={option.id}
                    onClick={() => selectOption(option)}
                    className="w-full text-left text-sm p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    aria-describedby={option.category ? `option-${option.id}-category` : undefined}
                    disabled={isTyping}
                  >
                    <div className="flex items-start justify-between">
                      <span className="flex-1 font-medium">{option.question}</span>
                      <Send size={14} className="ml-2 mt-0.5 text-gray-400 flex-shrink-0" />
                    </div>
                    {option.category && (
                      <div
                        id={`option-${option.id}-category`}
                        className="text-xs text-gray-500 mt-1"
                      >
                        {option.category}
                      </div>
                    )}
                  </button>
                ))}
              </div>
            </div>
          )}

          {/* End of conversation message */}
          {currentOptions.length === 0 && messages.length > 1 && !isTyping && (
            <div className="border-t border-gray-200 p-4 text-center">
              <p className="text-sm text-gray-600 mb-3">
                Is there anything else I can help you with?
              </p>
              <button
                onClick={clearChat}
                className="text-sm text-blue-600 hover:text-blue-700 font-medium"
              >
                Start over
              </button>
            </div>
          )}
        </div>
      )}

      {/* Floating Action Button */}
      <button
        ref={buttonRef}
        onClick={toggleChat}
        className={`${secondaryColor} text-white p-4 rounded-full shadow-lg transition-all duration-200 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-300 relative cursor-pointer`}
        aria-label={isOpen ? 'Close support chat' : 'Open support chat'}
        aria-expanded={isOpen}
        aria-haspopup="dialog"
      >
        <MessageCircle size={24} className={`text-blue-500`} />
        
        {/* New Message Indicator */}
        {hasNewMessage && !isOpen && (
          <div
            className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center animate-pulse"
            aria-label="New message available"
          >
            !
          </div>
        )}
      </button>
    </div>
  );
};

export default SupportChatWidget;
export type { ChatNode };