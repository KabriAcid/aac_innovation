import React, { useState } from 'react';
import { useToast } from '@/context/ToastContext';
import { motion } from 'framer-motion';
import Button from '../ui/Input';
import Input from '../ui/Button';
import API_BASE_URL, { createRequestConfig } from '../../src/config/apiConfig';

const AdminLoginPage: React.FC = () => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
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
    if (!formData.email.trim()) newErrors.email = 'Email is required';
    else if (!/\S+@\S+\.\S+/.test(formData.email)) newErrors.email = 'Please enter a valid email';
    if (!formData.password) newErrors.password = 'Password is required';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    if (!validateForm()) {
      showToastError('Validation Error', 'Please fix the errors in the form');
      return;
    }

    setSubmitting(true);

    try {
      const response = await fetch(
        `${API_BASE_URL}/auth.php?action=login`,
        createRequestConfig('POST', {
          email: formData.email.trim(),
          password: formData.password,
        })
      );

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({
          message: `Server error: ${response.status} ${response.statusText}`,
        }));
        throw new Error(errorData.message || 'Login failed');
      }

      const data = await response.json();

      if (data.success) {
        showToastSuccess('Login Successful', 'Welcome back!');

        // Clear form
        setFormData({
          email: '',
          password: '',
        });

        // Redirect to dashboard
        setTimeout(() => {
          window.location.href = '/admin/dashboard';
        }, 1500);
      } else {
        showToastError('Login Failed', data.message || 'Unknown error occurred');
      }
    } catch (err) {
      console.error('Login error:', err);
      const errorMessage = err instanceof Error ? err.message : 'Network error occurred';
      showToastError('Login Failed', errorMessage);
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
            <h1 className="text-2xl font-bold text-spiritual-900 mb-2">Sign In</h1>
            <p className="text-spiritual-600">Welcome back!</p>
          </div>

          <form onSubmit={handleSubmit} className="space-y-6">
            {errors.general && (
              <div className="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                {errors.general}
              </div>
            )}

            <Input
              label="Email"
              type="email"
              name="email"
              value={formData.email}
              onChange={handleInputChange}
              placeholder="Enter Email"
              error={errors.email}
              disabled={submitting}
            />

            <Input
              label="Password"
              type="password"
              name="password"
              value={formData.password}
              onChange={handleInputChange}
              placeholder="Enter Password"
              error={errors.password}
              disabled={submitting}
            />

            <Button
              type="submit"
              variant="primary"
              size="md"
              className="w-full cursor-pointer"
              loading={submitting}
              disabled={submitting}
            >
              {submitting ? 'Signing In...' : 'Sign In'}
            </Button>

            <div className="text-center mt-4">
              <a href="/admin/register" className="text-primary-600 hover:underline text-sm">
                Don&apos;t have an account? Register
              </a>
            </div>
          </form>
        </motion.div>
      </div>
    </div>
  );
};

export default AdminLoginPage;