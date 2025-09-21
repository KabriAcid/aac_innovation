import React from 'react';
import { motion } from 'framer-motion';
import { Mail, Phone, MapPin, Clock, Send } from 'lucide-react';
import { ContactForm } from '@/components/forms/ContactForm';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { COMPANY_INFO } from '@/utils/constants';
import { ContactFormData } from '@/types';

export const ContactPage: React.FC = () => {
  const handleContactSubmit = (data: ContactFormData) => {
    console.log('Contact form submitted:', data);
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
              Get in Touch
            </h1>
            <p className="text-xl text-primary-100 max-w-3xl mx-auto">
              Ready to transform your business with innovative technology solutions? 
              We'd love to hear from you and discuss how we can help.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Contact Information */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            {[
              {
                icon: Mail,
                title: 'Email Us',
                content: COMPANY_INFO.email,
                link: `mailto:${COMPANY_INFO.email}`,
                description: 'Send us an email anytime',
              },
              {
                icon: Phone,
                title: 'Call Us',
                content: COMPANY_INFO.phone,
                link: `tel:${COMPANY_INFO.phone}`,
                description: 'Mon-Fri from 8am to 6pm',
              },
              {
                icon: MapPin,
                title: 'Visit Us',
                content: COMPANY_INFO.address,
                description: 'Come say hello at our office',
              },
              {
                icon: Clock,
                title: 'Business Hours',
                content: 'Mon - Fri: 8:00 AM - 6:00 PM',
                description: 'Saturday: 9:00 AM - 2:00 PM',
              },
            ].map((item, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
              >
                <Card className="text-center h-full">
                  <CardContent className="pt-6">
                    <div className="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                      <item.icon className="h-6 w-6 text-primary-600" />
                    </div>
                    <h3 className="text-lg font-semibold text-secondary-900 mb-2">
                      {item.title}
                    </h3>
                    {item.link ? (
                      <a
                        href={item.link}
                        className="text-primary-600 hover:text-primary-700 font-medium block mb-1"
                      >
                        {item.content}
                      </a>
                    ) : (
                      <p className="text-secondary-900 font-medium mb-1">
                        {item.content}
                      </p>
                    )}
                    <p className="text-sm text-secondary-600">
                      {item.description}
                    </p>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
            {/* Contact Form */}
            <div className="lg:col-span-2">
              <motion.div
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.4 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Send us a Message</CardTitle>
                    <CardDescription>
                      Fill out the form below and we'll get back to you within 24 hours.
                    </CardDescription>
                  </CardHeader>
                  <CardContent>
                    <ContactForm onSubmit={handleContactSubmit} />
                  </CardContent>
                </Card>
              </motion.div>
            </div>

            {/* Sidebar */}
            <div className="space-y-6">
              {/* Why Choose Us */}
              <motion.div
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.5 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Why Choose AAC Innovation?</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
                      {[
                        {
                          title: 'Expert Team',
                          description: 'Experienced professionals with deep industry knowledge',
                        },
                        {
                          title: 'Proven Track Record',
                          description: 'Successfully delivered 100+ projects across Africa',
                        },
                        {
                          title: '24/7 Support',
                          description: 'Round-the-clock support for all our clients',
                        },
                        {
                          title: 'Innovative Solutions',
                          description: 'Cutting-edge technology tailored to your needs',
                        },
                      ].map((item, index) => (
                        <div key={index} className="border-l-4 border-primary-600 pl-4">
                          <h4 className="font-semibold text-secondary-900 mb-1">
                            {item.title}
                          </h4>
                          <p className="text-sm text-secondary-600">
                            {item.description}
                          </p>
                        </div>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>

              {/* FAQ */}
              <motion.div
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: 0.6 }}
              >
                <Card>
                  <CardHeader>
                    <CardTitle>Frequently Asked Questions</CardTitle>
                  </CardHeader>
                  <CardContent>
                    <div className="space-y-4">
                      {[
                        {
                          question: 'How quickly do you respond?',
                          answer: 'We typically respond to all inquiries within 24 hours during business days.',
                        },
                        {
                          question: 'Do you offer free consultations?',
                          answer: 'Yes, we offer free initial consultations to understand your needs and provide recommendations.',
                        },
                        {
                          question: 'What industries do you serve?',
                          answer: 'We work with businesses across all industries, from startups to large enterprises.',
                        },
                      ].map((item, index) => (
                        <div key={index}>
                          <h4 className="font-medium text-secondary-900 mb-1">
                            {item.question}
                          </h4>
                          <p className="text-sm text-secondary-600">
                            {item.answer}
                          </p>
                        </div>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            </div>
          </div>
        </div>
      </section>

      {/* Map Section (Placeholder) */}
      <section className="h-96 bg-secondary-200 relative overflow-hidden">
        <div className="absolute inset-0 flex items-center justify-center">
          <div className="text-center">
            <MapPin className="h-12 w-12 text-secondary-400 mx-auto mb-4" />
            <h3 className="text-lg font-semibold text-secondary-700 mb-2">
              Find Us Here
            </h3>
            <p className="text-secondary-600">
              {COMPANY_INFO.address}
            </p>
          </div>
        </div>
      </section>
    </div>
  );
};