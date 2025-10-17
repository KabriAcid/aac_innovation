import React, { useState } from 'react';
import { Service } from '@/types';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import {
  Shield,
  ShieldCheck,
  CreditCard,
  Wallet,
  Cloud,
  Building2,
  Brain,
  Bot,
  Zap,
  Wifi,
  Home,
  Target,
  Search,
  Smartphone,
  Palette,
  Settings,
  TestTube,
  Globe,
  ShoppingCart,
  Wrench,
  ArrowRight,
  CheckCircle,
  Calendar,
  Loader,
  Package,
} from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { SERVICE_CATEGORIES } from '@/utils/constants';

const iconMap = {
  Shield,
  ShieldCheck,
  CreditCard,
  Wallet,
  Cloud,
  Building2,
  Brain,
  Bot,
  Zap,
  Wifi,
  Home,
  Target,
  Search,
  Smartphone,
  Palette,
  Settings,
  TestTube,
  Globe,
  ShoppingCart,
  Wrench,
};
const DefaultIcon = Package;

export const ServicesPage: React.FC = () => {
  const [selectedCategory, setSelectedCategory] = useState<string | null>(null);
  const [services, setServices] = useState<Service[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const fetchServices = () => {
    setLoading(true);
    fetch('http://localhost/aac_innovation/backend/api/services.php')
      .then((res) => res.json())
      .then((data) => {
        if (data.success && Array.isArray(data.data)) {
          const parsed = data.data.map((service: any) => ({
            ...service,
            features: typeof service.features === 'string' ? JSON.parse(service.features) : service.features,
          }));
          setServices(parsed as Service[]);
        } else {
          setError('Failed to load services.');
        }
        setLoading(false);
      })
      .catch(() => {
        setError('Failed to load services.');
        setLoading(false);
      });
  };

  const filteredServices = selectedCategory
    ? services.filter((s) => s.category === selectedCategory)
    : services;

  return (
    <div className="min-h-screen">
      <section className="relative py-24 text-white">
        <div className="absolute inset-0 z-0">
          <img
            src="/img/staff-1-and-2.jpg"
            alt="AAC Innovation Services Background"
            className="w-full h-full object-cover object-center"
            style={{ objectPosition: 'center 20%' }}
          />
          <div className="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80" />
        </div>

        <div className="relative z-10 container-max section-padding">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            className="text-center"
          >
            <h1 className="text-4xl md:text-5xl font-bold mb-6">Our Services</h1>
            <p className="text-xl text-primary-100 max-w-3xl mx-auto">
              Comprehensive technology solutions designed to drive your business forward in the digital age
            </p>
            {/* <Button variant="primary" onClick={fetchServices} className="mt-4">
              Load Services
            </Button> */}
          </motion.div>
        </div>
      </section>

      {loading && (
        <div className="flex justify-center items-center min-h-[40vh]">
          <Loader className="animate-spin h-8 w-8 text-primary-600" />
        </div>
      )}

      {error && (
        <div className="text-center text-red-600 py-12">{error}</div>
      )}

      {!loading && !error && (
        <section className="section-padding bg-secondary-50">
          <div className="container-max">
            <div className="flex flex-wrap gap-4 justify-center">
              <Button
                variant={selectedCategory === null ? 'primary' : 'ghost'}
                onClick={() => setSelectedCategory(null)}
              >
                All Services
              </Button>
              {Array.from(new Set(services.map((s) => s.category))).map((category) => (
                <Button
                  key={category}
                  variant={selectedCategory === category ? 'primary' : 'ghost'}
                  onClick={() => setSelectedCategory(category)}
                >
                  {category.charAt(0).toUpperCase() + category.slice(1)}
                </Button>
              ))}
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
              {filteredServices.map((service, index) => {
                const categoryInfo = SERVICE_CATEGORIES[service.category] || { title: service.category, icon: null };
                let Icon = DefaultIcon;
                if (service.icon && iconMap[service.icon]) {
                  Icon = iconMap[service.icon];
                } else if (categoryInfo.icon && iconMap[categoryInfo.icon]) {
                  Icon = iconMap[categoryInfo.icon];
                }
                return (
                  <motion.div
                    key={service.id}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.6, delay: index * 0.1 }}
                  >
                    <Card hover className="h-full box-shadow">
                      <CardHeader>
                        <div className="flex items-center justify-between mb-3">
                          <div className="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                            <Icon className="h-5 w-5 text-primary-600" />
                          </div>
                          <span className="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-1 rounded-full">
                            {categoryInfo.title}
                          </span>
                        </div>
                        <CardTitle as="h3">{service.title}</CardTitle>
                        <CardDescription>{service.description}</CardDescription>
                      </CardHeader>
                      <CardContent>
                        <div className="space-y-4">
                          <div className="space-y-2">
                            <h4 className="font-medium text-secondary-900">Key Features:</h4>
                            <ul className="space-y-1">
                              {Array.isArray(service.features)
                                ? service.features.slice(0, 3).map((feature, idx) => (
                                    <li key={idx} className="flex items-center text-sm text-secondary-600">
                                      <CheckCircle className="h-3 w-3 text-primary-600 mr-2 flex-shrink-0" />
                                      {feature}
                                    </li>
                                  ))
                                : null}
                            </ul>
                          </div>
                        </div>
                      </CardContent>
                    </Card>
                  </motion.div>
                );
              })}
            </div>
          </div>
        </section>
      )}
    </div>
  );
};