import React from 'react';
import { ToastProvider, useToast } from '../../src/context/ToastContext';
import { ToastContainer } from '../../src/components/ui/Toast';

const AdminToastProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  const { toasts, removeToast } = useToast();
  return (
    <>
      {children}
      <ToastContainer toasts={toasts} onRemove={removeToast} />
    </>
  );
};

export default AdminToastProvider;
