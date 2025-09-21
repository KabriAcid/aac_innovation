import React, { useEffect, useState } from 'react';
import { useSearchParams } from 'react-router-dom';
import { motion } from 'framer-motion';
import { Calendar, Clock, CheckCircle } from 'lucide-react';
import { BookingForm } from '@/components/forms/BookingForm';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { services, getServiceById } from '@/data/services';
import { BookingFormData } from '@/types';

export const BookingPage: React.FC = () => {
  const [searchParams] = useSearchParams();
  const preselectedService = searchParams.get('service');
  const [selectedService, setSelectedService] = useState<any>(null);

  useEffect(() => {
    if (preselectedService) {
      const service = getServiceById(preselectedService);
      setSelectedService(service);
    }
  }, [preselectedService]);

  const handleBookingSubmit = (data: BookingFormData) => {
    console.log('Booking submitted:', data);
    // Here you would typically send the data to your backend
  };

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative py-24 bg-gradient-to-r from-primary-600 to-primary-800 text-white">
        <div className="container-max section-padding">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            className="text-center"
          >
            <h1 className="text-4xl md:text-5xl font-bold mb-6">
              Book a Consultation
            </h1>
            <p className="text-xl text-primary-100 max-w-3xl mx-auto">
              Schedule a free consultation with our experts to discuss your technology needs 
              and discover how we can help transform your business.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Booking Process */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            {[
              {
                icon: Calendar,
                title: 'Choose Service & Date',
                description: 'Select the service you\'re interested in and pick a convenient date and time.',
              },
              {
                icon: Clock,
                title: 'Confirmation',
                description: 'We\'ll confirm your appointment within 2 hours and send you a calendar invite.',
              },
              {
                icon: CheckCircle,
                title: 'Expert Consultation',
                description: 'Meet with our experts to discuss your needs and get personalized recommendations.',
              },
            ].map((step, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
              >
                <Card className="text-center h-full">
                  <CardContent className="pt-6">
                    <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                      <step.icon className="h-6 w-6 text-primary-600" />
                    </div>
                    <h3 className="text-lg font-semibold text-secondary-900 mb-2">
                      {step.title}
                    </h3>
                    <p className="text-secondary-600">
                      {step.description}
                    </p>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {/* Booking Form */}
            <div className="lg:col-span-2">
              <motion.div
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.3 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Schedule Your Consultation</CardTitle>
                    <CardDescription>
                      Fill out the form below to book your free consultation with our experts.
                    </CardDescription>
                  </CardHeader>
                  <CardContent>
                    <BookingForm 
                      onSubmit={handleBookingSubmit}
                      preselectedService={preselectedService || undefined}
                    />
                  </CardContent>
                </Card>
              </motion.div>
            </div>

            {/* Sidebar */}
            <div className="space-y-6">
              {/* Selected Service Info */}
              {selectedService && (
                <motion.div
                  initial={{ opacity: 0, x: 20 }}
                  animate={{ opacity: 1, x: 0 }}
                  transition={{ duration: 0.6, delay: 0.4 }}
                >
                  <Card>
                    <CardHeader>
                      <CardTitle>Selected Service</CardTitle>
                    </CardHeader>
                    <CardContent>
                      <div className="space-y-3">
                        <h4 className="font-semibold text-secondary-900">
                          {selectedService.title}
                        </h4>
                        <p className="text-sm text-secondary-600">
                          {selectedService.description}
                        </p>
                        {selectedService.pricing && (
                          <div className="p-3 bg-primary-50 rounded-lg">
                            <div className="flex items-center justify-between">
                              <span className="text-sm text-primary-700">Starting at</span>
                              <span className="font-semibold text-primary-900">
                                {selectedService.pricing.startingPrice}
                              </span>
                            </div>
                            <p className="text-xs text-primary-600 mt-1">
                              {selectedService.pricing.description}
                            </p>
                          </div>
                        )}
                      </div>
                    </CardContent>
                  </Card>
                </motion.div>
              )}

              {/* What to Expect */}
              <motion.div
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.5 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>What to Expect</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-3">
                      {[
                        'Free 30-60 minute consultation',
                        'Discussion of your specific needs',
                        'Personalized recommendations',
                        'Project timeline and pricing',
                        'Next steps and follow-up plan',
                      ].map((item, index) => (
                        <div key={index} className="flex items-center space-x-3">
                          <CheckCircle className="h-4 w-4 text-primary-600 flex-shrink-0" />
                          <span className="text-sm text-secondary-700">{item}</span>
                        </div>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>

              {/* Contact Info */}
              <motion.div
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.6 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Need Help?</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-3 text-sm">
                      <p className="text-secondary-600">
                        If you have any questions about booking or need immediate assistance, 
                        feel free to contact us directly.
                      </p>
                      <div className="space-y-2">
                        <p>
                          <span className="font-medium">Email:</span>{' '}
                          <a href="mailto:info@aacinnovation.com" className="text-primary-600 hover:text-primary-700">
                            info@aacinnovation.com
                          </a>
                        </p>
                        <p>
                          <span className="font-medium">Phone:</span>{' '}
                          <a href="tel:+2341234567890" className="text-primary-600 hover:text-primary-700">
                            +234 123 456 7890
                          </a>
                        </p>
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