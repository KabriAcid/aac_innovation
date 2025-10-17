import React, { useState, useEffect } from 'react';
import { Service } from '@/types';
import { Link, useParams } from 'react-router-dom';
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
  Package
} from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { SERVICE_CATEGORIES, PRICING_MODELS } from '@/utils/constants';
import API_BASE_URL from '@/utils/apiConfig';
// import { services, getServicesByCategory } from '@/data/services';

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
  const { serviceId } = useParams();
  const [selectedCategory, setSelectedCategory] = useState<string | null>(null);
  const [services, setServices] = useState<Service[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  // Dynamic categories from services
  const categories = Array.from(new Set(services.map(s => s.category)));

  useEffect(() => {
    fetch(`${API_BASE_URL}/services`)
      .then(res => res.json())
      .then(data => {
        if (data.success && Array.isArray(data.data)) {
          // Parse features column from JSON string to array
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
  }, []);

  const filteredServices = selectedCategory
    ? services.filter(s => s.category === selectedCategory)
    : services;

  const selectedService = serviceId ? services.find(s => s.id === serviceId) : null;

  if (loading) {
    return (
      <div className="flex justify-center items-center min-h-[40vh]">
        <Loader className="animate-spin h-8 w-8 text-primary-600" />
      </div>
    );
  }

  if (error) {
    return (
      <div className="text-center text-red-600 py-12">{error}</div>
    );
  }

  if (selectedService) {
    return <ServiceDetailView service={selectedService} />;
  }

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative py-24 text-white">
        {/* Background Image */}
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
            <h1 className="text-4xl md:text-5xl font-bold mb-6">
              Our Services
            </h1>
            <p className="text-xl text-primary-100 max-w-3xl mx-auto">
              Comprehensive technology solutions designed to drive your business forward 
              in the digital age
            </p>
          </motion.div>
        </div>
      </section>

      {/* Service Categories Filter */}
      <section className="section-padding bg-white border-b border-secondary-200 shadow-md">
        <div className="container-max">
          <div className="flex flex-wrap gap-4 justify-center">
            <Button
              variant={selectedCategory === null ? 'primary' : 'ghost'}
              onClick={() => setSelectedCategory(null)}
            >
              All Services
            </Button>
            {categories.map(category => (
              <Button
                key={category}
                variant={selectedCategory === category ? 'primary' : 'ghost'}
                onClick={() => setSelectedCategory(category)}
              >
                {category.charAt(0).toUpperCase() + category.slice(1)}
              </Button>
            ))}
          </div>
        </div>
      </section>

      {/* Services Grid */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          {selectedCategory ? (
            <div className="mb-12">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6 }}
                className="text-center"
              >
                <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
                  {SERVICE_CATEGORIES[selectedCategory].title}
                </h2>
                <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
                  {SERVICE_CATEGORIES[selectedCategory].description}
                </p>
              </motion.div>
            </div>
          ) : (
            <div className="mb-12">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6 }}
                className="text-center"
              >
                <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
                  All Services
                </h2>
                <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
                  Explore our complete range of technology solutions
                </p>
              </motion.div>
            </div>
          )}

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {filteredServices.map((service, index) => {
              const categoryInfo = SERVICE_CATEGORIES[service.category] || { title: service.category, icon: null };
              let Icon = DefaultIcon;
              if (service.icon && iconMap[service.icon]) {
                Icon = iconMap[service.icon];
              } else if (categoryInfo.icon && iconMap[categoryInfo.icon]) {
                Icon = iconMap[categoryInfo.icon];
              } else {
                Icon = DefaultIcon;
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
                        {service.pricing?.startingPrice && (
                          <div className="p-3 bg-primary-50 rounded-lg">
                            <div className="flex items-center justify-between">
                              <span className="text-sm text-primary-700">Starting at</span>
                              <span className="font-semibold text-primary-900">
                                {service.pricing?.startingPrice}
                              </span>
                            </div>
                            <p className="text-xs text-primary-600 mt-1">
                              {service.pricing?.description}
                            </p>
                          </div>
                        )}
                        <div className="flex gap-2">
                          <Link to={`/services/${service.id}`} className="flex-1">
                            <Button variant="ghost" size="sm" fullWidth>
                              Learn More
                            </Button>
                          </Link>
                          <Link to={`/booking?service=${service.id}`}> 
                            <Button variant="primary" size="sm">
                              Book Now
                            </Button>
                          </Link>
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

      {/* CTA Section */}
      <section className="section-padding bg-primary-900">
        <div className="container-max">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center text-white"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">
              Need a Custom Solution?
            </h2>
            <p className="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
              Don't see exactly what you're looking for? We specialize in creating 
              tailored technology solutions for unique business requirements.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/contact">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg" icon={<ArrowRight className="h-5 w-5" />}>
                  Discuss Your Needs
                </Button>
              </Link>
              <Link to="/booking">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg" icon={<Calendar className="h-5 w-5" />}>
                  Schedule Consultation
                </Button>
              </Link>
            </div>
          </motion.div>
        </div>
      </section>
    </div>
  );
};

// Service Detail Component
const ServiceDetailView: React.FC<{ service: any }> = ({ service }) => {
  const categoryInfo = SERVICE_CATEGORIES[service.category];
  const Icon = iconMap[categoryInfo.icon as keyof typeof iconMap];

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative py-24 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
        <div className="container-max section-padding">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
          >
            <div className="flex items-center mb-4">
              <Link to="/services" className="text-primary-200 hover:text-white mr-2">
                Services
              </Link>
              <span className="text-primary-200 mr-2">/</span>
              <span className="text-primary-200">{categoryInfo.title}</span>
            </div>
            <div className="flex items-center mb-6">
              <div className="w-16 h-16 bg-primary-500 rounded-lg flex items-center justify-center mr-4">
                <Icon className="h-8 w-8 text-white" />
              </div>
              <div>
                <h1 className="text-4xl md:text-5xl font-bold">{service.title}</h1>
                <p className="text-primary-200 mt-2">{categoryInfo.title}</p>
              </div>
            </div>
            <p className="text-xl text-primary-100 max-w-3xl">
              {service.description}
            </p>
          </motion.div>
        </div>
      </section>

      {/* Service Details */}
      <section className="section-padding bg-white">
        <div className="container-max">
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div className="lg:col-span-2">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: 0.2 }}
              >
                <h2 className="text-2xl font-bold text-secondary-900 mb-6">
                  What's Included
                </h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {service.features.map((feature: string, index: number) => (
                    <div key={index} className="flex items-center space-x-3">
                      <CheckCircle className="h-5 w-5 text-primary-600 flex-shrink-0" />
                      <span className="text-secondary-700">{feature}</span>
                    </div>
                  ))}
                </div>
              </motion.div>
            </div>

            <div>
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: 0.4 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Get Started</CardTitle>
                    <CardDescription>
                      Ready to implement this solution for your business?
                    </CardDescription>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
                      {service.pricing && (
                        <div className="p-4 bg-primary-50 rounded-lg">
                          <div className="flex items-center justify-between mb-2">
                            <span className="text-sm text-primary-700">Starting at</span>
                            <span className="text-xl font-bold text-primary-900">
                              {service.pricing.startingPrice}
                            </span>
                          </div>
                          <p className="text-sm text-primary-600">
                            {PRICING_MODELS[service.pricing.model]}
                          </p>
                          <p className="text-xs text-primary-600 mt-1">
                            {service.pricing.description}
                          </p>
                        </div>
                      )}
                      
                      <div className="space-y-3">
                        <Link to={`/booking?service=${service.id}`}>
                          <Button variant="primary" size="lg" fullWidth icon={<Calendar className="h-4 w-4" />}>
                            Book Consultation
                          </Button>
                        </Link>
                        <Link to="/contact">
                          <Button variant="secondary" size="lg" fullWidth>
                            Request Quote
                          </Button>
                        </Link>
                      </div>
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};