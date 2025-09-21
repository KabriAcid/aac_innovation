import { useEffect } from 'react';
import { useLocation } from 'react-router-dom';

/**
 * ScrollToTop component that automatically scrolls to the top of the page
 * whenever the route changes. This fixes the common React Router issue
 * where the scroll position is maintained when navigating between pages.
 */
export default function ScrollToTop() {
  const { pathname } = useLocation();

  useEffect(() => {
    // Scroll to top when pathname changes
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth' // Optional: adds smooth scrolling animation
    });
  }, [pathname]);

  return null;
}

/**
 * Alternative hook-based approach for components that need scroll control
 */
export function useScrollToTop() {
  const { pathname } = useLocation();

  useEffect(() => {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
  }, [pathname]);
}

/**
 * Utility function to manually scroll to top (can be used in buttons, etc.)
 */
export function scrollToTop(behavior: 'smooth' | 'instant' = 'smooth') {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior
  });
}
