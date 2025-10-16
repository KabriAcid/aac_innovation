import React, { useState } from 'react';
import { useToast } from '../../src/context/ToastContext';
import { motion } from 'framer-motion';
import Button from '../ui/Input';
import Input from '../ui/Button';
import API_BASE_URL from '../config/apiConfig';

const AdminRegisterPage: React.FC = () => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    confirmPassword: '',
    first_name: '',
    last_name: '',
    role: 'user',
  });
  const [errors, setErrors] = useState<Record<string, string>>({});
  const { error: showToastError, success: showToastSuccess } = useToast();
  const [submitting, setSubmitting] = useState(false);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
    if (errors[name]) {
      setErrors(prev => ({ ...prev, [name]: '' }));
    }
  };

  const validateForm = () => {
    const newErrors: Record<string, string> = {};
    if (!formData.first_name) newErrors.first_name = 'First name is required';
    if (!formData.last_name) newErrors.last_name = 'Last name is required';
    if (!formData.email) newErrors.email = 'Email is required';
    else if (!/\S+@\S+\.\S+/.test(formData.email)) newErrors.email = 'Please enter a valid email';
    if (!formData.password) newErrors.password = 'Password is required';
    if (formData.password.length < 6) newErrors.password = 'Password must be at least 6 characters';
    if (formData.password !== formData.confirmPassword) newErrors.confirmPassword = 'Passwords do not match';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!validateForm()) return;
    setSubmitting(true);
    try {
      const res = await fetch(`${API_BASE_URL}/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          email: formData.email,
          password: formData.password,
          first_name: formData.first_name,
          last_name: formData.last_name,
          role: formData.role,
        }),
      });
      const data = await res.json();
      if (data.success) {
        showToastSuccess('Registration successful', 'You can now log in.');
        window.location.href = '/admin/login';
      } else {
        showToastError('Registration failed', data.message || 'Unknown error');
      }
    } catch (err) {
      showToastError('Registration failed', err instanceof Error ? err.message : 'Unknown error');
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center p-4">
      <div className="w-full max-w-md">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="card rounded-3xl p-8 box-shadow"
        >
          <div className="text-center mb-8">
            <h1 className="text-2xl font-bold text-spiritual-900 mb-2">Register</h1>
            <p className="text-spiritual-600">Create a new admin account</p>
          </div>
          <form onSubmit={handleSubmit} className="space-y-6">
            {errors.general && (
              <div className="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                {errors.general}
              </div>
            )}
            <div className="flex gap-2">
              <Input
                label="First Name"
                name="first_name"
                value={formData.first_name}
                onChange={handleInputChange}
                placeholder="First Name"
                error={errors.first_name}
                type="text"
              />
              <Input
                label="Last Name"
                name="last_name"
                value={formData.last_name}
                onChange={handleInputChange}
                placeholder="Last Name"
                error={errors.last_name}
                type="text"
              />
            </div>
            <Input
              label="Email"
              type="email"
              name="email"
              value={formData.email}
              onChange={handleInputChange}
              placeholder="Enter Email"
              error={errors.email}
            />
            <Input
              label="Password"
              type="password"
              name="password"
              value={formData.password}
              onChange={handleInputChange}
              placeholder="Enter Password"
              error={errors.password}
            />
            <Input
              label="Confirm Password"
              type="password"
              name="confirmPassword"
              value={formData.confirmPassword}
              onChange={handleInputChange}
              placeholder="Confirm Password"
              error={errors.confirmPassword}
            />
            <Button
              type="submit"
              variant="primary"
              size={"md"}
              className="w-full cursor-pointer"
              loading={submitting}
            >
              {submitting ? 'Registering...' : 'Register'}
            </Button>
          </form>
        </motion.div>
      </div>
    </div>
  );
};

export default AdminRegisterPage;
