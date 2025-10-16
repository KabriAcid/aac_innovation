import React, { useState, useEffect } from 'react';
import { useForm } from 'react-hook-form';
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from 'yup';
import { Calendar, Clock, Send } from 'lucide-react';
import { Button } from '@/components/ui/Button';
import { Input } from '@/components/ui/Input';
import { Textarea } from '@/components/ui/Textarea';
import { Select } from '@/components/ui/Select';
import { Checkbox } from '@/components/ui/Checkbox';
import { BookingFormData } from '@/types';
import { services } from '@/data/services';
import { teamMembers } from '@/data/team';
import { TIME_SLOTS } from '@/utils/constants';
import { useToast } from '@/context/ToastContext';
import { generateId } from '@/utils/helpers';
import API_BASE_URL from '@/utils/apiConfig';

const schema: yup.ObjectSchema<BookingFormData> = yup.object({
  firstName: yup.string().required('First name is required'),
  lastName: yup.string().required('Last name is required'),
  email: yup.string().email('Invalid email').required('Email is required'),
  phone: yup.string().required('Phone number is required'),
  company: yup.string().optional(),
  serviceId: yup.string().required('Please select a service'),
  consultantId: yup.string().optional(),
  preferredDate: yup.string().required('Please select a date'),
  preferredTime: yup.string().required('Please select a time'),
  message: yup.string().optional(),
  consent: yup.boolean().oneOf([true], 'You must agree to the privacy policy').required(),
});

interface BookingFormProps {
  onSubmit?: (data: BookingFormData) => void;
  preselectedService?: string;
}

export const BookingForm: React.FC<BookingFormProps> = ({ 
  onSubmit, 
  preselectedService 
}) => {
  const { success, error } = useToast();
  const {
    register,
    handleSubmit,
    formState: { errors, isSubmitting },
    reset,
    watch,
  } = useForm<BookingFormData>({
    resolver: yupResolver(schema),
    defaultValues: {
      serviceId: preselectedService || '',
    },
  });

  const selectedServiceId = watch('serviceId');

  const [serviceOptions, setServiceOptions] = useState([{ value: '', label: 'Select a service' }]);

  useEffect(() => {
    fetch(`${API_BASE_URL}/services`)
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          setServiceOptions([
            { value: '', label: 'Select a service' },
            ...data.data.map(service => ({
              value: service.id,
              label: service.title,
            })),
          ]);
        }
      });
  }, []);

  const consultantOptions = [
    { value: '', label: 'Any available consultant' },
    ...teamMembers.map(member => ({
      value: member.id,
      label: `${member.name} - ${member.role}`,
    })),
  ];

  const timeOptions = TIME_SLOTS.map(time => ({
    value: time,
    label: time,
  }));

  // Get minimum date (tomorrow)
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  const minDate = tomorrow.toISOString().split('T')[0];

  const handleFormSubmit = async (data: BookingFormData) => {
    try {
      // Generate or get userId from localStorage
      let userId = localStorage.getItem('aac_user_id');
      if (!userId) {
        userId = generateId();
        localStorage.setItem('aac_user_id', userId);
      }

      // Prepare payload
      const payload = { ...data, userId };
      console.log('Booking payload:', payload);

      // POST to backend Node.js API
      let response, result;
      try {
        response = await fetch(`${API_BASE_URL}/bookings`, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload),
        });
        result = await response.json();
        console.log('Booking response:', response, result);
      } catch (networkError) {
        console.error('Network error:', networkError);
        error('Unable to reach backend', 'Please check your internet connection or try again later.');
        return;
      }

      if (!response.ok || !result.success) {
        console.error('Booking error:', result);
        error('Failed to submit booking', result?.message || 'Please try again or contact us directly.');
        return;
      }

      if (onSubmit) {
        onSubmit(data);
      }

      success(
        'Booking request submitted!',
        'We\'ll confirm your appointment within 2 hours and send you a calendar invite.'
      );
      reset();
    } catch (err) {
      console.error('Booking form error:', err);
      error('Failed to submit booking', 'Please try again or contact us directly.');
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
          label="Phone"
          type="tel"
          {...register('phone')}
          error={errors.phone?.message}
          placeholder="0707 653 6019"
        />
      </div>

      <Input
        label="Company (Optional)"
        {...register('company')}
        error={errors.company?.message}
        placeholder="Your Company"
      />

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <Select
          label="Service"
          {...register('serviceId')}
          error={errors.serviceId?.message}
          options={serviceOptions}
        />
        <Select
          label="Preferred Consultant (Optional)"
          {...register('consultantId')}
          error={errors.consultantId?.message}
          options={consultantOptions}
        />
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <Input
          label="Preferred Date"
          type="date"
          {...register('preferredDate')}
          error={errors.preferredDate?.message}
          min={minDate}
          icon={<Calendar className="h-4 w-4" />}
        />
        <Select
          label="Preferred Time"
          {...register('preferredTime')}
          error={errors.preferredTime?.message}
          options={timeOptions}
        />
      </div>

      {selectedServiceId && (
        <div className="p-4 bg-primary-50 rounded-lg border border-primary-200">
          <h4 className="font-medium text-primary-900 mb-2">
            Selected Service Details
          </h4>
          {(() => {
            const service = services.find(s => s.id === selectedServiceId);
            return service ? (
              <div>
                <p className="text-sm text-primary-800 mb-2">
                  {service.description}
                </p>
                {service.pricing && (
                  <p className="text-sm font-medium text-primary-900">
                    Pricing: {service.pricing.startingPrice} ({service.pricing.description})
                  </p>
                )}
              </div>
            ) : null;
          })()}
        </div>
      )}

      <Textarea
        label="Additional Message (Optional)"
        {...register('message')}
        error={errors.message?.message}
        placeholder="Tell us more about your requirements or any specific questions you have..."
        rows={4}
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
            and consent to being contacted to confirm this appointment.
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
        Book Consultation
      </Button>
    </form>
  );
};