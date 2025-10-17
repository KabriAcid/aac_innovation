import React from 'react';
import { Link } from 'react-router-dom';
import { Mail, Phone, MapPin, Linkedin, Twitter, Facebook } from 'lucide-react';
import { COMPANY_INFO, NAVIGATION_ITEMS } from '@/utils/constants';
import { useCompanySettings } from '@/hooks/useCompanySettings';
import { Spinner } from '../ui/Spinner';

export const Footer: React.FC = () => {
  const currentYear = new Date().getFullYear();
  const { settings: COMPANY_INFO, loading } = useCompanySettings();

  if (loading) {
    return (
      <footer className="bg-secondary-900 text-white">
        <div className="container-max section-padding text-center py-12">
          <Spinner />
        </div>
      </footer>
    );
  }

  return (
    <footer className="bg-secondary-900 text-white">
      <div className="container-max section-padding">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          {/* Company Info */}
          <div className="lg:col-span-2">
            <div className="flex items-center space-x-3 mb-4">
              <img
                src="/favicon-black-outline.png"
                alt={COMPANY_INFO.name}
                className="h-10 w-10"
              />
              <div>
                <h3 className="text-xl font-bold">{COMPANY_INFO.name ?? 'AAC Innovation'}</h3>
                <p className="text-sm text-secondary-300">
                  {COMPANY_INFO.tagline ?? 'Empowering Africa\'s Digital Transformation'}
                </p>
              </div>
            </div>
            <p className="text-secondary-300 mb-6 max-w-md">
              {COMPANY_INFO.description ?? 'Driving technological advancement across Africa with expert solutions.'}
            </p>
            <div className="flex space-x-4">
              <a
                href={COMPANY_INFO.socialLinks?.linkedin ?? '#'}
                target="_blank"
                rel="noopener noreferrer"
                className="text-secondary-400 hover:text-white transition-colors duration-200"
              >
                <Linkedin className="h-5 w-5" />
              </a>
              <a
                href={COMPANY_INFO.socialLinks?.twitter ?? '#'}
                target="_blank"
                rel="noopener noreferrer"
                className="text-secondary-400 hover:text-white transition-colors duration-200"
              >
                <Twitter className="h-5 w-5" />
              </a>
              <a
                href={COMPANY_INFO.socialLinks?.facebook ?? '#'}
                target="_blank"
                rel="noopener noreferrer"
                className="text-secondary-400 hover:text-white transition-colors duration-200"
              >
                <Facebook className="h-5 w-5" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h4 className="text-lg font-semibold mb-4">Quick Links</h4>
            <ul className="space-y-2">
              {NAVIGATION_ITEMS.map((item) => (
                <li key={item.name}>
                  <Link
                    to={item.href}
                    className="text-secondary-300 hover:text-white transition-colors duration-200"
                  >
                    {item.name}
                  </Link>
                </li>
              ))}
              <li>
                <Link
                  to="/booking"
                  className="text-secondary-300 hover:text-white transition-colors duration-200"
                >
                  Book Consultation
                </Link>
              </li>
              <li>
                <Link
                  to="/privacy"
                  className="text-secondary-300 hover:text-white transition-colors duration-200"
                >
                  Privacy Policy
                </Link>
              </li>
              <li>
                <Link
                  to="/terms"
                  className="text-secondary-300 hover:text-white transition-colors duration-200"
                >
                  Terms of Service
                </Link>
              </li>
            </ul>
          </div>

          {/* Contact Info */}
          <div>
            <h4 className="text-lg font-semibold mb-4">Contact Us</h4>
            <div className="space-y-3">
              <a
                href={`mailto:${COMPANY_INFO.email ?? 'aacinovations43@gmail.com'}`}
                className="flex items-center space-x-3 text-secondary-300 hover:text-white transition-colors duration-200"
              >
                <Mail className="h-4 w-4 flex-shrink-0" />
                <span>{COMPANY_INFO.email ?? 'aacinovations43@gmail.com'}</span>
              </a>
              <a
                href={`tel:${COMPANY_INFO.phone ?? '0707 653 6019'}`}
                className="flex items-center space-x-3 text-secondary-300 hover:text-white transition-colors duration-200"
              >
                <Phone className="h-4 w-4 flex-shrink-0" />
                <span>{COMPANY_INFO.phone ?? '0707 653 6019'}</span>
              </a>
              <div className="flex items-center space-x-3 text-secondary-300">
                <MapPin className="h-4 w-4 flex-shrink-0" />
                <span>{COMPANY_INFO.address ?? 'Abuja, Nigeria'}</span>
              </div>
            </div>
          </div>
        </div>

        <div className="border-t border-secondary-800 mt-12 pt-8">
          <div className="flex flex-col md:flex-row justify-between items-center">
            <p className="text-secondary-400 text-sm">
              © {currentYear} {COMPANY_INFO.name ?? 'AAC Innovation'}. All rights reserved.
            </p>
            <p className="text-secondary-400 text-sm mt-2 md:mt-0">
              {COMPANY_INFO.tagline ?? "Empowering Africa's Digital Transformation"}
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
};