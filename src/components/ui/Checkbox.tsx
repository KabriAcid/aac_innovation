import React, { forwardRef } from 'react';
import { Check } from 'lucide-react';
import { cn } from '@/utils/helpers';

interface CheckboxProps extends React.InputHTMLAttributes<HTMLInputElement> {
  // allow rich content (JSX) for labels
  label?: React.ReactNode;
  error?: string;
  helperText?: string;
}

export const Checkbox = forwardRef<HTMLInputElement, CheckboxProps>(
  ({ label, error, helperText, className, id, ...props }, ref) => {
    const checkboxId = id || `checkbox-${Math.random().toString(36).substr(2, 9)}`;
    
    return (
      <div className="w-full">
        <div className="flex items-start">
          <div className="relative flex items-center">
            <input
              ref={ref}
              type="checkbox"
              id={checkboxId}
              className={cn(
                'h-4 w-4 rounded border-secondary-300 text-primary-600 shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-primary-500 focus:ring-offset-0',
                error && 'border-red-500 focus:border-red-500 focus:ring-red-500',
                className
              )}
              {...props}
            />
          </div>
          {label && (
            <label 
              htmlFor={checkboxId}
              className="ml-3 block text-sm text-secondary-700 cursor-pointer"
            >
              {label}
            </label>
          )}
        </div>
        {error && (
          <p className="mt-1 text-sm text-red-600">
            {error}
          </p>
        )}
        {helperText && !error && (
          <p className="mt-1 text-sm text-secondary-500">
            {helperText}
          </p>
        )}
      </div>
    );
  }
);

Checkbox.displayName = 'Checkbox';