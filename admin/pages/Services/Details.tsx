import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { adapter } from '../../data/adapter';
import Button from '../../ui/Button';
// ToastContext import removed for now (if needed, use a fallback toast or alert)

const ServiceDetails: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const [service, setService] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  // ToastContext not found, fallback to alert for errors
  const navigate = useNavigate();

  useEffect(() => {
    if (id) {
      adapter.getService(id)
        .then(setService)
        .catch((err) => {
          alert('Failed to load service details');
          navigate('/admin/services');
        })
        .finally(() => setLoading(false));
    }
  }, [id, navigate]);

  if (loading) {
    return <div className="p-8">Loading...</div>;
  }
  if (!service) {
    return <div className="p-8">Service not found.</div>;
  }

  return (
    <div className="max-w-2xl mx-auto p-6">
      <div className="bg-white rounded-lg shadow p-8">
        <h1 className="text-2xl font-bold mb-2">{service.name}</h1>
        <div className="mb-2 text-gray-600">Category: {service.category}</div>
        <div className="mb-2 text-gray-600">Price: {service.price}</div>
        <div className="mb-2 text-gray-600">Duration: {service.duration}</div>
        <div className="mb-4 text-gray-600">Status: {service.is_active ? 'Active' : 'Inactive'}</div>
        <div className="mb-6 text-gray-800">{service.description}</div>
        <Button onClick={() => navigate('/admin/services')}>Back to Services</Button>
      </div>
    </div>
  );
};

export default ServiceDetails;
