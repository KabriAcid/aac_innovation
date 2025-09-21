import React from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from 'yup';
import { Send } from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { Textarea } from '@/components/ui/Textarea';
import { Select } from '@/components/ui/Select';
import { Checkbox } from '@/components/ui/Checkbox';
import { ContactFormData } from '@/types';
import { services } from '@/data/services';
import { useToast } from '@/hooks/useToast';

const schema = yup.object({
  firstName: yup.string().required('First name is required'),
  lastName: yup.string().required('Last name is required'),
  email: yup.string().email('Invalid email').required('Email is required'),
  phone: yup.string(),
  company: yup.string(),
  serviceInterest: yup.string(),
  message: yup.string().required('Message is required').min(10, 'Message must be at least 10 characters'),
  consent: yup.boolean().oneOf([true], 'You must agree to the privacy policy'),
});

interface ContactFormProps {
  onSubmit?: (data: ContactFormData) => void;
}

export const ContactForm: React.FC<ContactFormProps> = ({ onSubmit }) => {
  const { success, error } = useToast();
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
    reset,
  } = useForm<ContactFormData>({
    resolver: yupResolver(schema),
  });

  const serviceOptions = [
    { value: '', label: 'Select a service (optional)' },
    ...services.map(service => ({
      value: service.id,
      label: service.title,
    })),
  ];

  const handleFormSubmit = async (data: ContactFormData) => {
    try {
      // Simulate API call
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      if (onSubmit) {
        onSubmit(data);
      }
      
      success('Message sent successfully!', 'We\'ll get back to you within 24 hours.');
      reset();
    } catch (err) {
      error('Failed to send message', 'Please try again or contact us directly.');
    }
  };

  return (
    <form onSubmit={handleSubmit(handleFormSubmit)} className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <Input
          label="First Name"
          {...register('firstName')}
          error={errors.firstName?.message}
          placeholder="John"
        />
        <Input
          label="Last Name"
          {...register('lastName')}
          error={errors.lastName?.message}
          placeholder="Doe"
        />
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <Input
          label="Email"
          type="email"
          {...register('email')}
          error={errors.email?.message}
          placeholder="john@example.com"
        />
        <Input
          label="Phone (Optional)"
          type="tel"
          {...register('phone')}
          error={errors.phone?.message}
          placeholder="+234 123 456 7890"
        />
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <Input
          label="Company (Optional)"
          {...register('company')}
          error={errors.company?.message}
          placeholder="Your Company"
        />
        <Select
          label="Service of Interest (Optional)"
          {...register('serviceInterest')}
          error={errors.serviceInterest?.message}
          options={serviceOptions}
        />
      </div>

      <Textarea
        label="Message"
        {...register('message')}
        error={errors.message?.message}
        placeholder="Tell us about your project or how we can help you..."
        rows={5}
      />

      <Checkbox
        {...register('consent')}
        error={errors.consent?.message}
        label={
          <span>
            I agree to the{' '}
            <a href="/privacy" className="text-primary-600 hover:text-primary-700 underline">
              Privacy Policy
            </a>{' '}
            and consent to being contacted about my inquiry.
          </span>
        }
      />

      <Button
        type="submit"
        variant="primary"
        size="lg"
        loading={isSubmitting}
        icon={<Send className="h-4 w-4" />}
        fullWidth
      >
        Send Message
      </Button>
    </form>
  );
};