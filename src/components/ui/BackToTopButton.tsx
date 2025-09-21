import { useState, useEffect } from 'react';
import { ChevronUp } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';
import { scrollToTop } from '@/components/ScrollToTop';

interface BackToTopButtonProps {
  showAfter?: number; // Show button after scrolling this many pixels
  className?: string;
}

export default function BackToTopButton({ 
  showAfter = 300, 
  className = '' 
}: BackToTopButtonProps) {
  const [isVisible, setIsVisible] = useState(false);

  useEffect(() => {
    const toggleVisibility = () => {
      if (window.pageYOffset > showAfter) {
        setIsVisible(true);
      } else {
        setIsVisible(false);
      }
    };

    window.addEventListener('scroll', toggleVisibility);

    return () => {
      window.removeEventListener('scroll', toggleVisibility);
    };
  }, [showAfter]);

  return (
    <AnimatePresence>
      {isVisible && (
        <motion.button
          initial={{ opacity: 0, scale: 0.8 }}
          animate={{ opacity: 1, scale: 1 }}
          exit={{ opacity: 0, scale: 0.8 }}
          whileHover={{ scale: 1.1 }}
          whileTap={{ scale: 0.9 }}
          onClick={() => scrollToTop('smooth')}
          className={`
            fixed bottom-8 right-8 z-50 
            inline-flex items-center justify-center 
            w-12 h-12 
            bg-primary-600 hover:bg-primary-700 
            text-white 
            rounded-full 
            shadow-lg hover:shadow-xl 
            transition-all duration-200 
            focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2
            ${className}
          `}
          aria-label="Back to top"
          title="Back to top"
        >
          <ChevronUp className="w-6 h-6" />
        </motion.button>
      )}
    </AnimatePresence>
  );
}
