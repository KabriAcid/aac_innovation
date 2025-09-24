import { useState, useCallback } from 'react';
import { ChatNode } from './data';

export interface ChatMessage {
  id: string;
  type: 'user' | 'bot' | 'welcome';
  content: string;
  timestamp: Date;
}

export interface TypingIndicator {
  id: string;
  type: 'typing';
  timestamp: Date;
}
export interface ChatState {
  currentOptions: ChatNode[];
  conversationPath: string[];
}

export interface UseSupportChatReturn {
  isOpen: boolean;
  messages: ChatMessage[];
  isTyping: boolean;
  currentOptions: ChatNode[];
  hasNewMessage: boolean;
  openChat: () => void;
  closeChat: () => void;
  toggleChat: () => void;
  selectOption: (node: ChatNode) => void;
  clearChat: () => void;
  markAsRead: () => void;
  goBack: () => void;
  canGoBack: boolean;
}

export function useSupportChat(
  chatTree: ChatNode[],
  welcomeMessage?: string
): UseSupportChatReturn {
  const [isOpen, setIsOpen] = useState(false);
  const [messages, setMessages] = useState<ChatMessage[]>([]);
  const [isTyping, setIsTyping] = useState(false);
  const [chatState, setChatState] = useState<ChatState>({
    currentOptions: chatTree,
    conversationPath: []
  });
  const [hasNewMessage, setHasNewMessage] = useState(false);

  const openChat = useCallback(() => {
    setIsOpen(true);
    setHasNewMessage(false);
    
    // Add welcome message if no messages exist
    if (messages.length === 0 && welcomeMessage) {
      const welcomeMsg: ChatMessage = {
        id: 'welcome-' + Date.now(),
        type: 'welcome',
        content: welcomeMessage,
        timestamp: new Date()
      };
      setMessages([welcomeMsg]);
    }
  }, [messages.length, welcomeMessage]);

  const closeChat = useCallback(() => {
    setIsOpen(false);
  }, []);

  const toggleChat = useCallback(() => {
    if (isOpen) {
      closeChat();
    } else {
      openChat();
    }
  }, [isOpen, openChat, closeChat]);

  const selectOption = useCallback((node: ChatNode) => {
    const userMessage: ChatMessage = {
      id: 'user-' + Date.now(),
      type: 'user',
      content: node.question,
      timestamp: new Date()
    };

    // Add user message immediately
    setMessages(prev => [...prev, userMessage]);
    
    // Show typing indicator and delay bot response
    setIsTyping(true);
    
    // Calculate delay based on answer length (more realistic)
    const baseDelay = 1000; // 1 second minimum
    const wordsPerMinute = 200; // Average reading speed
    const words = node.answer.split(' ').length;
    const readingTime = (words / wordsPerMinute) * 60 * 1000; // Convert to milliseconds
    const delay = Math.min(baseDelay + readingTime * 0.3, 3000); // Cap at 3 seconds
    
    setTimeout(() => {
      const botMessage: ChatMessage = {
        id: 'bot-' + Date.now(),
        type: 'bot',
        content: node.answer,
        timestamp: new Date()
      };
      
      setMessages(prev => [...prev, botMessage]);
      setIsTyping(false);
      
      // Update chat state with follow-ups or reset to root
      setChatState(prev => ({
        currentOptions: node.followUps || chatTree,
        conversationPath: node.followUps ? [...prev.conversationPath, node.id] : []
      }));
      
      if (!isOpen) {
        setHasNewMessage(true);
      }
    }, delay);
  }, [isOpen, chatTree]);

  const goBack = useCallback(() => {
    setChatState(prev => {
      if (prev.conversationPath.length === 0) {
        return prev; // Already at root
      }

      const newPath = prev.conversationPath.slice(0, -1);
      
      if (newPath.length === 0) {
        // Go back to root
        return {
          currentOptions: chatTree,
          conversationPath: []
        };
      }

      // Find the parent node and its follow-ups
      let currentLevel = chatTree;
      for (const pathId of newPath) {
        const foundNode = findNodeInTree(currentLevel, pathId);
        if (foundNode?.followUps) {
          currentLevel = foundNode.followUps;
        }
      }

      return {
        currentOptions: currentLevel,
        conversationPath: newPath
      };
    });
  }, [chatTree]);

  const clearChat = useCallback(() => {
    setMessages([]);
    setChatState({
      currentOptions: chatTree,
      conversationPath: []
    });
    
    if (welcomeMessage) {
      const welcomeMsg: ChatMessage = {
        id: 'welcome-' + Date.now(),
        type: 'welcome',
        content: welcomeMessage,
        timestamp: new Date()
      };
      setMessages([welcomeMsg]);
    }
  }, [welcomeMessage, chatTree]);

  const markAsRead = useCallback(() => {
    setHasNewMessage(false);
  }, []);

  return {
    isOpen,
    messages,
    isTyping,
    currentOptions: chatState.currentOptions,
    hasNewMessage,
    openChat,
    closeChat,
    toggleChat,
    selectOption,
    clearChat,
    markAsRead,
    goBack,
    canGoBack: chatState.conversationPath.length > 0
  };
}

// Helper function to find a node in the tree by ID
function findNodeInTree(nodes: ChatNode[], targetId: string): ChatNode | null {
  for (const node of nodes) {
    if (node.id === targetId) {
      return node;
    }
    if (node.followUps) {
      const found = findNodeInTree(node.followUps, targetId);
      if (found) return found;
    }
  }
  return null;
}