import { useEffect, useRef, useState } from 'react';
import { useLocation } from 'react-router-dom';

interface ScrollOptions {
  behavior?: 'smooth' | 'instant';
  delay?: number;
  enabled?: boolean;
}

/**
 * Hook that provides scroll-to-top functionality with more control
 */
export function useScrollToTop(options: ScrollOptions = {}) {
  const { 
    behavior = 'smooth', 
    delay = 0, 
    enabled = true 
  } = options;
  
  const { pathname } = useLocation();
  const timeoutRef = useRef<NodeJS.Timeout | null>(null);

  useEffect(() => {
    if (!enabled) return;

    // Clear any existing timeout
    if (timeoutRef.current) {
      clearTimeout(timeoutRef.current);
    }

    // Scroll to top with optional delay
    timeoutRef.current = setTimeout(() => {
      window.scrollTo({
        top: 0,
        left: 0,
        behavior
      });
    }, delay);

    return () => {
      if (timeoutRef.current) {
        clearTimeout(timeoutRef.current);
      }
    };
  }, [pathname, behavior, delay, enabled]);
}

/**
 * Hook that tracks scroll position and provides scroll utilities
 */
export function useScrollPosition() {
  const [scrollY, setScrollY] = useState(0);

  useEffect(() => {
    const handleScroll = () => {
      setScrollY(window.pageYOffset);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const scrollToTop = (behavior: 'smooth' | 'instant' = 'smooth') => {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior
    });
  };

  const scrollToElement = (
    elementId: string, 
    behavior: 'smooth' | 'instant' = 'smooth',
    offset: number = 0
  ) => {
    const element = document.getElementById(elementId);
    if (element) {
      const elementPosition = element.offsetTop - offset;
      window.scrollTo({
        top: elementPosition,
        left: 0,
        behavior
      });
    }
  };

  return {
    scrollY,
    scrollToTop,
    scrollToElement,
    isAtTop: scrollY === 0
  };
}
