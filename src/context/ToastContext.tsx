import React, { createContext, useContext, useState, useCallback } from 'react';
import { ToastNotification } from '@/types';
import { generateId } from '@/utils/helpers';

interface ToastContextProps {
  toasts: ToastNotification[];
  addToast: (
    type: ToastNotification['type'],
    title: string,
    message?: string,
    duration?: number
  ) => string;
  removeToast: (id: string) => void;
  clearAllToasts: () => void;
  success: (title: string, message?: string, duration?: number) => string;
  error: (title: string, message?: string, duration?: number) => string;
  warning: (title: string, message?: string, duration?: number) => string;
  info: (title: string, message?: string, duration?: number) => string;
}

const ToastContext = createContext<ToastContextProps | undefined>(undefined);

export const ToastProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const [toasts, setToasts] = useState<ToastNotification[]>([]);

  const addToast = useCallback((type, title, message, duration = 5000) => {
    const id = generateId();
    const toast: ToastNotification = { id, type, title, message, duration };
    setToasts(prev => [...prev, toast]);
    if (duration > 0) {
      setTimeout(() => removeToast(id), duration);
    }
    return id;
  }, []);

  const removeToast = useCallback((id: string) => {
    setToasts(prev => prev.filter(toast => toast.id !== id));
  }, []);

  const clearAllToasts = useCallback(() => {
    setToasts([]);
  }, []);

  const success = useCallback((title, message, duration) => addToast('success', title, message, duration), [addToast]);
  const error = useCallback((title, message, duration) => addToast('error', title, message, duration), [addToast]);
  const warning = useCallback((title, message, duration) => addToast('warning', title, message, duration), [addToast]);
  const info = useCallback((title, message, duration) => addToast('info', title, message, duration), [addToast]);

  return (
    <ToastContext.Provider value={{ toasts, addToast, removeToast, clearAllToasts, success, error, warning, info }}>
      {children}
    </ToastContext.Provider>
  );
};

export const useToast = () => {
  const context = useContext(ToastContext);
  if (!context) {
    throw new Error('useToast must be used within a ToastProvider');
  }
  return context;
};
