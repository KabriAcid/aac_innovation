import { HTMLMotionProps, motion } from 'framer-motion';
import { Loader2 } from 'lucide-react';
import React from 'react';

type ButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & HTMLMotionProps<'button'> & {
  variant?: 'primary' | 'secondary' | 'ghost' | 'outline';
  size?: 'sm' | 'md' | 'lg';
  loading?: boolean;
};

const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
  ({
    variant = 'primary',
    size = 'md',
    loading = false,
    children,
    className = '',
    disabled,
    whileTap = { scale: 0.95 },
    ...props
  }, ref) => {
    const baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    const variantClasses = {
      primary: 'bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium hover:shadow-strong focus:ring-primary-500/50 hover:scale-105 active:scale-95',
      secondary: 'bg-white text-spiritual-700 shadow-soft hover:shadow-medium border border-spiritual-200 hover:border-spiritual-300 focus:ring-spiritual-500/50',
      ghost: 'text-spiritual-600 hover:bg-white/50 focus:ring-spiritual-500/50',
      outline: 'border-2 border-primary-500 text-primary-500 hover:bg-primary-500 hover:text-white focus:ring-primary-500/50',
    };
    const sizeClasses = {
      sm: 'px-4 py-2 text-sm',
      md: 'px-6 py-3 text-base',
      lg: 'px-8 py-4 text-lg',
    };
    return (
      <motion.button
        ref={ref}
        whileTap={whileTap}
        className={`${baseClasses} ${variantClasses[variant]} ${sizeClasses[size]} ${className}`}
        disabled={disabled || loading}
        {...props}
      >
        {loading && (
          <Loader2 className="w-4 h-4 mr-2 animate-spin" />
        )}
        {children}
      </motion.button>
    );
  }
);

Button.displayName = 'Button';

export default Button;