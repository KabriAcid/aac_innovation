import React, { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import { Menu, X, Phone, Mail } from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { COMPANY_INFO, NAVIGATION_ITEMS } from '@/utils/constants';
import { cn } from '@/utils/helpers';

export const Header: React.FC = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 10);
    };

    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => {
    setIsMenuOpen(false);
  }, [location]);

  const isActive = (path: string) => {
    return location.pathname === path;
  };

  return (
    <header
      className={cn(
        'fixed top-0 left-0 right-0 z-40 transition-all duration-300',
        isScrolled
          ? 'bg-white/95 backdrop-blur-sm shadow-sm'
          : 'bg-transparent'
      )}
    >
      <div className="container-max section-padding py-4">
        <nav className="flex items-center justify-between">
          {/* Logo */}
          <Link to="/" className="flex items-center space-x-3">
            <img
              src="/favicon.png"
              alt={COMPANY_INFO.name}
              className="h-10 w-10"
            />
            <div>
              <h1 className="text-xl font-bold text-secondary-900">
                {COMPANY_INFO.name}
              </h1>
              <p className="text-xs text-secondary-600 hidden sm:block">
                {COMPANY_INFO.tagline}
              </p>
            </div>
          </Link>

          {/* Desktop Navigation */}
          <div className="hidden lg:flex items-center space-x-8">
            {NAVIGATION_ITEMS.map((item) => (
              <Link
                key={item.name}
                to={item.href}
                className={cn(
                  'text-sm font-medium transition-colors duration-200 hover:text-primary-600',
                  isActive(item.href)
                    ? 'text-primary-600'
                    : isScrolled
                    ? 'text-secondary-700'
                    : 'text-gray-500'
                )}
              >
                {item.name}
              </Link>
            ))}
          </div>

          {/* Desktop CTA */}
          <div className="hidden lg:flex items-center space-x-4">
            <a
              href={`tel:${COMPANY_INFO.phone}`}
              className={cn(
                'flex items-center space-x-2 text-sm transition-colors duration-200 hover:text-primary-600',
                isScrolled ? 'text-secondary-600' : 'text-gray-400'
              )}
            >
              <Phone className="h-4 w-4" />
              <span>{COMPANY_INFO.phone}</span>
            </a>
            <Link to="/booking">
              <Button variant="primary" size="sm">
                Book Consultation
              </Button>
            </Link>
            <Link to="/admin/login">
              <Button variant="secondary" size="sm">
                Admin
              </Button>
            </Link>
          </div>

          {/* Mobile Menu Button */}
          <button
            onClick={() => setIsMenuOpen(!isMenuOpen)}
            className={cn(
              'lg:hidden p-2 rounded-md transition-colors duration-200',
              isScrolled
                ? 'text-secondary-700 hover:bg-secondary-100'
                : 'text-gray-600 hover:bg-gray-100/20'
            )}
          >
            {isMenuOpen ? (
              <X className="h-6 w-6" />
            ) : (
              <Menu className="h-6 w-6" />
            )}
          </button>
        </nav>

        {/* Mobile Menu */}
        <AnimatePresence>
          {isMenuOpen && (
            <motion.div
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              className="lg:hidden mt-4 py-4 px-4 bg-white border-t border-secondary-200 rounded-lg shadow-lg"
            >
              <div className="flex flex-col space-y-4">
                {NAVIGATION_ITEMS.map((item) => (
                  <Link
                    key={item.name}
                    to={item.href}
                    className={cn(
                      'text-base font-medium transition-colors duration-200 hover:text-primary-600 py-2',
                      isActive(item.href)
                        ? 'text-primary-600'
                        : 'text-secondary-700'
                    )}
                  >
                    {item.name}
                  </Link>
                ))}
                <div className="pt-4 border-t border-secondary-200 space-y-3">
                  <a
                    href={`tel:${COMPANY_INFO.phone}`}
                    className="flex items-center space-x-2 text-secondary-600 hover:text-primary-600 transition-colors duration-200 py-2"
                  >
                    <Phone className="h-4 w-4" />
                    <span>{COMPANY_INFO.phone}</span>
                  </a>
                  <a
                    href={`mailto:${COMPANY_INFO.email}`}
                    className="flex items-center space-x-2 text-secondary-600 hover:text-primary-600 transition-colors duration-200 py-2"
                  >
                    <Mail className="h-4 w-4" />
                    <span>{COMPANY_INFO.email}</span>
                  </a>
                  <Link to="/booking" className="block pt-2">
                    <Button variant="primary" size="sm" fullWidth>
                      Book Consultation
                    </Button>
                  </Link>
                  <Link to="/admin/login" className="block pt-2 w-full">
                    <Button variant="secondary" size="sm" className="w-full">
                      Admin
                    </Button>
                  </Link>
                </div>
              </div>
            </motion.div>
          )}
        </AnimatePresence>
      </div>
    </header>
  );
};