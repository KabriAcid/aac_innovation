import React from 'react';
import { Outlet } from 'react-router-dom';
import { Header } from './Header';
import { Footer } from './Footer';
import { ToastContainer } from '@/components/ui/Toast';
import { useToast } from '@/hooks/useToast';
import SupportChatWidget from '@/ui/SupportChatWidget';

export const Layout: React.FC = () => {
  const { toasts, removeToast } = useToast();

  return (
    <div className="min-h-screen flex flex-col">
      <Header />
      <main className="flex-1 pt-20">
        <Outlet />
      </main>
      <Footer />
      <ToastContainer toasts={toasts} onRemove={removeToast} />
      <div className="fixed bottom-8 right-8 z-50 flex flex-col items-end space-y-4">
        <SupportChatWidget position="bottom-right" />
      </div>
      {/* BackToTopButton Removed*/}
    </div>
  );
};