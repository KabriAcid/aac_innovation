import React from 'react';
import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { 
  ArrowRight, 
  Shield, 
  CreditCard, 
  Cloud, 
  Brain, 
  Wifi, 
  Target,
  Smartphone,
  Globe,
  ShoppingCart,
  Wrench,
  CheckCircle,
  Star,
  Calendar
} from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { COMPANY_INFO, SERVICE_CATEGORIES } from '@/utils/constants';
import { services } from '@/data/services';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay } from 'swiper/modules';
import 'swiper/css';

const iconMap = {
  Shield,
  CreditCard,
  Cloud,
  Brain,
  Wifi,
  Target,
  Smartphone,
  Globe,
  ShoppingCart,
  Wrench,
};

export const HomePage: React.FC = () => {
  const featuredServices = services.slice(0, 6);

  // Carousel images
  const heroImages = [
    '/img/hero.jpg',
    '/img/staff-1-and-2.jpg',
    '/img/3-staff.jpg',
  ];

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative min-h-screen flex items-center justify-center overflow-hidden">
        {/* Swiper Carousel Background */}
        <div className="absolute inset-0 z-0">
          <Swiper
            modules={[Autoplay]}
            spaceBetween={0}
            slidesPerView={1}
            loop={true}
            autoplay={{ delay: 2000, disableOnInteraction: false }}
            speed={1200}
            allowTouchMove={false}
            style={{ height: '100vh' }}
          >
            {heroImages.map((img, idx) => (
              <SwiperSlide key={img}>
                <div className="w-full h-full relative overflow-hidden">
                  <img
                    src={img}
                    alt={`AAC Innovation Hero Slide ${idx + 1}`}
                    className="w-full h-screen object-cover object-center hero-zoom"
                    style={{ objectPosition: 'center 30%' }}
                  />
                  <div className="absolute inset-0 bg-gradient-to-r from-primary-900/90 to-primary-800/80" />
                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </div>

        {/* Content */}
        <div className="relative z-10 container-max section-padding text-center text-white">
          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8 }}
          >
            <h1 className="text-4xl md:text-6xl lg:text-7xl font-bold mb-6">
              <span className="block">{COMPANY_INFO.name}</span>
              <span className="block text-2xl md:text-3xl lg:text-4xl font-normal text-primary-200 mt-2">
                {COMPANY_INFO.tagline}
              </span>
            </h1>
            <p className="text-xl md:text-2xl text-primary-100 mb-8 max-w-3xl mx-auto">
              {COMPANY_INFO.description}
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/services">
                <Button variant="primary" size="lg" icon={<ArrowRight className="h-5 w-5" />}>
                  Explore Services
                </Button>
              </Link>
            </div>
            {/* Carousel indicators are now handled by react-responsive-carousel */}
          </motion.div>
        </div>

        {/* Scroll Indicator */}
        <motion.div
          className="absolute bottom-8 left-1/2 transform -translate-x-1/2"
          animate={{ y: [0, 10, 0] }}
          transition={{ duration: 2, repeat: Infinity }}
        >
          <div className="w-6 h-10 border-2 border-white/50 rounded-full flex justify-center">
            <div className="w-1 h-3 bg-white/50 rounded-full mt-2" />
          </div>
        </motion.div>
      </section>

      {/* About Section */}
      <section className="section-padding bg-white">
        <div className="container-max">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-6">
                Empowering Africa's Digital Transformation
              </h2>
              <p className="text-lg text-secondary-600 mb-6">
                At AAC Innovation, we're committed to driving technological advancement across Africa. 
                Our team of experts delivers cutting-edge solutions that help businesses and individuals 
                embrace the digital future with confidence.
              </p>
              <div className="space-y-4">
                {[
                  'Innovative technology solutions tailored for African markets',
                  'Expert team with deep industry knowledge',
                  'Proven track record of successful implementations',
                  '24/7 support and ongoing partnership'
                ].map((item, index) => (
                  <div key={index} className="flex items-center space-x-3">
                    <CheckCircle className="h-5 w-5 text-primary-600 flex-shrink-0" />
                    <span className="text-secondary-700">{item}</span>
                  </div>
                ))}
              </div>
              <div className="mt-8">
                <Link to="/about">
                  <Button variant="primary" icon={<ArrowRight className="h-4 w-4" />}>
                    Learn More About Us
                  </Button>
                </Link>
              </div>
            </motion.div>
            <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <img
                src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop&crop=center"
                alt="Team collaboration"
                className="rounded-lg shadow-lg"
              />
            </motion.div>
          </div>
        </div>
      </section>

      {/* Services Overview */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <div className="text-center mb-12">
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
                Our Service Categories
              </h2>
              <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
                Comprehensive technology solutions designed to meet your business needs
              </p>
            </motion.div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {Object.entries(SERVICE_CATEGORIES).map(([key, category], index) => {
              const Icon = iconMap[category.icon as keyof typeof iconMap];
              return (
                <motion.div
                  key={key}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  viewport={{ once: true }}
                >
                  <Card hover className="h-full">
                    <CardHeader>
                      <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                        <Icon className="h-6 w-6 text-primary-600" />
                      </div>
                      <CardTitle>{category.title}</CardTitle>
                      <CardDescription>{category.description}</CardDescription>
                    </CardHeader>
                    <CardContent>
                      <Link to={`/services#${key}`}>
                        <Button variant="ghost" size="sm" icon={<ArrowRight className="h-4 w-4" />}>
                          Learn More
                        </Button>
                      </Link>
                    </CardContent>
                  </Card>
                </motion.div>
              );
            })}
          </div>

          <div className="text-center mt-12">
            <Link to="/services">
              <Button variant="primary" size="lg" icon={<ArrowRight className="h-5 w-5" />}>
                View All Services
              </Button>
            </Link>
          </div>
        </div>
      </section>

      {/* Featured Services */}
      <section className="section-padding bg-white">
        <div className="container-max">
          <div className="text-center mb-12">
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
                Featured Services
              </h2>
              <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
                Popular solutions that are transforming businesses across Africa
              </p>
            </motion.div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {featuredServices.map((service, index) => {
              const Icon = iconMap[SERVICE_CATEGORIES[service.category].icon as keyof typeof iconMap];
              return (
                <motion.div
                  key={service.id}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  viewport={{ once: true }}
                >
                  <Card hover className="h-full">
                    <CardHeader>
                      <div className="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mb-3">
                        <Icon className="h-5 w-5 text-primary-600" />
                      </div>
                      <CardTitle as="h3">{service.title}</CardTitle>
                      <CardDescription>{service.description}</CardDescription>
                    </CardHeader>
                    <CardContent>
                      <div className="space-y-3">
                        <div className="flex items-center justify-between">
                          <span className="text-sm text-secondary-500">Starting at</span>
                          <span className="font-semibold text-primary-600">
                            {service.pricing?.startingPrice || 'Contact us'}
                          </span>
                        </div>
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

      {/* Quick Booking Widget */}
      <section className="section-padding bg-primary-600">
        <div className="container-max">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center text-white"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">
              Ready to Transform Your Business?
            </h2>
            <p className="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
              Schedule a free consultation with our experts and discover how we can help 
              you achieve your technology goals.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/booking">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg" icon={<Calendar className="h-5 w-5" />}>
                  Book Free Consultation
                </Button>
              </Link>
              <Link to="/contact">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg">
                  Contact Our Team
                </Button>
              </Link>
            </div>
          </motion.div>
        </div>
      </section>

      {/* Testimonials */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <div className="text-center mb-12">
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
                What Our Clients Say
              </h2>
              <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
                Trusted by businesses across Africa for innovative technology solutions
              </p>
            </motion.div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {[
              {
                name: 'Sarah Johnson',
                company: 'FinTech Solutions Ltd',
                content: 'AAC Innovation transformed our payment processing system. The implementation was seamless and the results exceeded our expectations.',
                rating: 5,
              },
              {
                name: 'Michael Okafor',
                company: 'Abuja Manufacturing Co',
                content: 'Their IoT solutions helped us optimize our production line and reduce costs by 30%. Excellent technical expertise and support.',
                rating: 5,
              },
              {
                name: 'Amina Hassan',
                company: 'Digital Bank Africa',
                content: 'The cybersecurity audit and implementation by AAC Innovation gave us confidence in our security posture. Highly recommended.',
                rating: 5,
              },
            ].map((testimonial, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <Card className="h-full">
                  <CardContent className="pt-6">
                    <div className="flex mb-4">
                      {[...Array(testimonial.rating)].map((_, i) => (
                        <Star key={i} className="h-4 w-4 text-yellow-400 fill-current" />
                      ))}
                    </div>
                    <p className="text-secondary-600 mb-4">"{testimonial.content}"</p>
                    <div>
                      <p className="font-semibold text-secondary-900">{testimonial.name}</p>
                      <p className="text-sm text-secondary-500">{testimonial.company}</p>
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
};