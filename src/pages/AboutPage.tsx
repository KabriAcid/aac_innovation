import React from 'react';
import { motion } from 'framer-motion';
import { 
  Target, 
  Eye, 
  Heart, 
  Users, 
  Award, 
  Globe,
  CheckCircle,
  ArrowRight
} from 'lucide-react';
import { Link } from 'react-router-dom';
import { Button } from '@/components/ui/Button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/Card';
import { COMPANY_INFO } from '@/utils/constants';
import { teamMembers } from '@/data/team';

export const AboutPage: React.FC = () => {
  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative py-24 text-white">
        {/* Background Image */}
        <div className="absolute inset-0 z-0">
          <img
            src="/img/3-staff.jpg"
            alt="AAC Innovation About Background"
            className="w-full h-full object-cover object-center"
            style={{ objectPosition: 'center 30%' }}
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
              About {COMPANY_INFO.name}
            </h1>
            <p className="text-xl text-primary-100 max-w-3xl mx-auto">
              {COMPANY_INFO.tagline} - We're passionate about empowering businesses 
              across Africa with innovative technology solutions that drive growth and success.
            </p>
          </motion.div>
        </div>
      </section>

      {/* Mission, Vision, Values */}
      <section className="section-padding bg-white">
        <div className="container-max">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {[
              {
                icon: Target,
                title: 'Our Mission',
                content: 'To provide innovative, scalable, and accessible digital services in areas such as cybersecurity, fintech, cloud computing, AI, IoT, and strategic consulting—helping businesses and individuals embrace the digital future.',
              },
              {
                icon: Eye,
                title: 'Our Vision',
                content: 'To establish a trusted online platform that highlights our expertise in cutting-edge digital solutions, positioning us as a leader in technology services across Africa.',
              },
              {
                icon: Heart,
                title: 'Our Values',
                content: 'Innovation, integrity, excellence, and partnership. We believe in building long-term relationships with our clients and delivering solutions that create lasting value.',
              },
            ].map((item, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
              >
                <Card className="text-center h-full box-shadow">
                  <CardContent className="pt-6">
                    <div className="w-16 h-16 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-6">
                      <item.icon className="h-8 w-8 text-primary-600" />
                    </div>
                    <h3 className="text-xl font-bold text-secondary-900 mb-4">
                      {item.title}
                    </h3>
                    <p className="text-secondary-600">
                      {item.content}
                    </p>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Company Story */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-6">
                Our Story
              </h2>
              <div className="space-y-4 text-secondary-600">
                <p>
                  Founded with a vision to bridge the technology gap across Africa, 
                  AAC Innovation has grown from a small team of passionate technologists 
                  to a leading provider of digital solutions across the continent.
                </p>
                <p>
                  We recognized early on that Africa's digital transformation required 
                  more than just technology—it needed partners who understood the unique 
                  challenges and opportunities of the African market. That's why we've 
                  dedicated ourselves to creating solutions that are not only innovative 
                  but also practical and accessible.
                </p>
                <p>
                  Today, we're proud to have helped hundreds of businesses across Africa 
                  leverage technology to grow, compete, and thrive in the digital economy. 
                  Our journey is just beginning, and we're excited about the future we're 
                  building together with our clients and partners.
                </p>
              </div>
            </motion.div>
                        <motion.div
              initial={{ opacity: 0, x: 30 }}
              whileInView={{ opacity: 1, x: 0 }}
              transition={{ duration: 0.6 }}
              viewport={{ once: true }}
            >
              <img
                src="/img/3-staff-2.jpg"
                alt="AAC Innovation Team"
                className="rounded-lg shadow-lg"
              />
            </motion.div>
          </div>
        </div>
      </section>

      {/* Stats */}
      <section className="section-padding bg-primary-600 text-white">
        <div className="container-max">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold mb-4">
              Our Impact in Numbers
            </h2>
            <p className="text-xl text-primary-100 max-w-2xl mx-auto">
              These numbers represent the trust our clients place in us and the 
              impact we've made across Africa's technology landscape.
            </p>
          </motion.div>

          <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
            {[
              { number: '100+', label: 'Projects Completed' },
              { number: '50+', label: 'Happy Clients' },
              { number: '10+', label: 'Countries Served' },
              { number: '5+', label: 'Years Experience' },
            ].map((stat, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                viewport={{ once: true }}
                className="text-center"
              >
                <div className="text-4xl md:text-5xl font-bold text-white mb-2">
                  {stat.number}
                </div>
                <div className="text-primary-200">
                  {stat.label}
                </div>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Team */}
      <section className="section-padding bg-white">
        <div className="container-max">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
              Meet Our Team
            </h2>
            <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
              Our diverse team of experts brings together decades of experience 
              in technology, business, and innovation.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {teamMembers.map((member, index) => (
              <motion.div
                key={member.id}
                initial={{ opacity: 0, y: 20 }}
                whileInView={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                viewport={{ once: true }}
              >
                <Card className="text-center box-shadow">
                  <CardContent className="pt-6">
                    <img
                      src={member.avatar}
                      alt={member.name}
                      className="w-24 h-24 rounded-full mx-auto mb-4 object-cover"
                    />
                    <h3 className="text-xl font-bold text-secondary-900 mb-1">
                      {member.name}
                    </h3>
                    <p className="text-primary-600 font-medium mb-3">
                      {member.role}
                    </p>
                    <div className="flex flex-wrap gap-2 justify-center">
                      {member.expertise.map((skill, skillIndex) => (
                        <span
                          key={skillIndex}
                          className="px-2 py-1 bg-secondary-100 text-secondary-700 text-xs rounded-full"
                        >
                          {skill}
                        </span>
                      ))}
                    </div>
                  </CardContent>
                </Card>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* Why Choose Us */}
      <section className="section-padding bg-secondary-50">
        <div className="container-max">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6 }}
            viewport={{ once: true }}
            className="text-center mb-12"
          >
            <h2 className="text-3xl md:text-4xl font-bold text-secondary-900 mb-4">
              Why Choose AAC Innovation?
            </h2>
            <p className="text-lg text-secondary-600 max-w-2xl mx-auto">
              We're more than just a technology provider—we're your strategic partner 
              in digital transformation.
            </p>
          </motion.div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {[
              'Deep understanding of African markets and challenges',
              'Proven track record of successful implementations',
              'Comprehensive range of technology services',
              'Expert team with international experience',
              '24/7 support and ongoing partnership',
              'Innovative solutions tailored to your needs',
              'Competitive pricing and flexible engagement models',
              'Strong focus on security and compliance',
            ].map((item, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, x: -20 }}
                whileInView={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.6, delay: index * 0.1 }}
                viewport={{ once: true }}
                className="flex items-center space-x-3"
              >
                <CheckCircle className="h-5 w-5 text-primary-600 flex-shrink-0" />
                <span className="text-secondary-700">{item}</span>
              </motion.div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
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
              Ready to Work with Us?
            </h2>
            <p className="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
              Let's discuss how we can help transform your business with innovative 
              technology solutions tailored to your needs.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link to="/contact">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg" icon={<ArrowRight className="h-5 w-5" />}>
                  Get in Touch
                </Button>
              </Link>
              <Link to="/booking">
                <Button className="!bg-white !text-primary-600 !border-white hover:!bg-gray-50" size="lg">
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