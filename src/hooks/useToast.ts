
// WARNING: Do NOT use this hook for global toast notifications.
// Use useToast from src/context/ToastContext.tsx instead for app-wide toasts.
// This hook is only for local, component-level toasts and should be removed/refactored.
import { useState, useCallback } from 'react';
import { ToastNotification } from '@/types';
import { generateId } from '@/utils/helpers';

export const useToast = () => {
  const [toasts, setToasts] = useState<ToastNotification[]>([]);

  const addToast = useCallback((
    type: ToastNotification['type'],
    title: string,
    message?: string,
    duration: number = 5000
  ) => {
    const id = generateId();
    const toast: ToastNotification = {
      id,
      type,
      title,
      message,
      duration,
    };

    setToasts(prev => [...prev, toast]);

    if (duration > 0) {
      setTimeout(() => {
        removeToast(id);
      }, duration);
    }

    return id;
  }, []);

  const removeToast = useCallback((id: string) => {
    setToasts(prev => prev.filter(toast => toast.id !== id));
  }, []);

  const clearAllToasts = useCallback(() => {
    setToasts([]);
  }, []);

  const success = useCallback((title: string, message?: string, duration?: number) => {
    return addToast('success', title, message, duration);
  }, [addToast]);

  const error = useCallback((title: string, message?: string, duration?: number) => {
    return addToast('error', title, message, duration);
  }, [addToast]);

  const warning = useCallback((title: string, message?: string, duration?: number) => {
    return addToast('warning', title, message, duration);
  }, [addToast]);

  const info = useCallback((title: string, message?: string, duration?: number) => {
    return addToast('info', title, message, duration);
  }, [addToast]);

  return {
    toasts,
    addToast,
    removeToast,
    clearAllToasts,
    success,
    error,
    warning,
    info,
  };
};