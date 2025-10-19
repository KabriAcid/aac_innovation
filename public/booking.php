<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Consultation | AAC Innovation</title>
    <link rel="shortcut icon" href="../favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include '../components/header.php'; ?>
    <main class="min-h-screen">
        <!-- Hero Section -->
        <section class="relative py-24" style="background: linear-gradient(120deg, var(--primary-900) 0%, var(--primary-700) 60%, var(--primary-600) 100%);">
            <div class="container-max section-padding text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-white drop-shadow-lg">Book a Consultation</h1>
                <p class="text-xl max-w-3xl mx-auto text-primary-100 drop-shadow-md" style="color: #e2e8f0;">
                    Schedule a free consultation with our experts to discuss your technology needs <br>
                    <span style="color: #f1f5f9;">and discover how we can help transform your business.</span>
                </p>
            </div>
        </section>
        <!-- Booking Process Steps -->
        <section class="section-padding bg-secondary-50">
            <div class="container-max">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                    <div class="text-center h-full card box-shadow">
                        <div class="pt-6">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <!-- Calendar SVG -->
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="18" rx="2" />
                                    <path d="M16 2v4M8 2v4M3 10h18" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-secondary-900 mb-2">Choose Service & Date</h3>
                            <p class="text-secondary-600">Select the service you're interested in and pick a convenient date and time.</p>
                        </div>
                    </div>
                    <div class="text-center h-full card box-shadow">
                        <div class="pt-6">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <!-- Clock SVG -->
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M12 6v6l4 2" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-secondary-900 mb-2">Confirmation</h3>
                            <p class="text-secondary-600">We'll confirm your appointment within 2 hours and send you a calendar invite.</p>
                        </div>
                    </div>
                    <div class="text-center h-full card box-shadow">
                        <div class="pt-6">
                            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <!-- CheckCircle SVG -->
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M9 12l2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-secondary-900 mb-2">Expert Consultation</h3>
                            <p class="text-secondary-600">Meet with our experts to discuss your needs and get personalized recommendations.</p>
                        </div>
                    </div>
                </div>
                <!-- Main Grid: Booking Form & Sidebar -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <!-- Booking Form (to be implemented) -->
                    <div class="lg:col-span-2">
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h2 class="card-title">Schedule Your Consultation</h2>
                                <p class="card-description">Fill out the form below to book your free consultation with our experts.</p>
                            </div>
                            <div class="card-content">
                                <!-- Booking form will go here -->
                                <form id="booking-form" class="space-y-6" autocomplete="off">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="firstName" class="block text-sm font-medium text-secondary-700 mb-1">First Name</label>
                                            <input type="text" id="firstName" name="firstName" class="input w-full" placeholder="John" required>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-firstName"></div>
                                        </div>
                                        <div>
                                            <label for="lastName" class="block text-sm font-medium text-secondary-700 mb-1">Last Name</label>
                                            <input type="text" id="lastName" name="lastName" class="input w-full" placeholder="Doe" required>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-lastName"></div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                                            <input type="email" id="email" name="email" class="input w-full" placeholder="john@example.com" required>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-email"></div>
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-secondary-700 mb-1">Phone</label>
                                            <input type="tel" id="phone" name="phone" class="input w-full" placeholder="0707 653 6019" required>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-phone"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="company" class="block text-sm font-medium text-secondary-700 mb-1">Company (Optional)</label>
                                        <input type="text" id="company" name="company" class="input w-full" placeholder="Your Company">
                                        <div class="form-error text-red-600 text-xs mt-1" id="error-company"></div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="serviceId" class="block text-sm font-medium text-secondary-700 mb-1">Service</label>
                                            <select id="serviceId" name="serviceId" class="input w-full" required></select>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-serviceId"></div>
                                        </div>
                                        <div>
                                            <label for="consultantId" class="block text-sm font-medium text-secondary-700 mb-1">Preferred Consultant (Optional)</label>
                                            <select id="consultantId" name="consultantId" class="input w-full"></select>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-consultantId"></div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label for="preferredDate" class="block text-sm font-medium text-secondary-700 mb-1">Preferred Date</label>
                                            <input type="date" id="preferredDate" name="preferredDate" class="input w-full" required>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-preferredDate"></div>
                                        </div>
                                        <div>
                                            <label for="preferredTime" class="block text-sm font-medium text-secondary-700 mb-1">Preferred Time</label>
                                            <select id="preferredTime" name="preferredTime" class="input w-full" required></select>
                                            <div class="form-error text-red-600 text-xs mt-1" id="error-preferredTime"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-secondary-700 mb-1">Additional Message (Optional)</label>
                                        <textarea id="message" name="message" rows="4" class="input w-full" placeholder="Tell us more about your requirements or any specific questions you have..."></textarea>
                                        <div class="form-error text-red-600 text-xs mt-1" id="error-message"></div>
                                    </div>
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" id="consent" name="consent" class="mr-2">
                                            <span class="text-sm">I agree to the <a href="/privacy" class="text-primary-600 hover:text-primary-700 underline">Privacy Policy</a> and consent to being contacted to confirm this appointment.</span>
                                        </label>
                                        <div class="form-error text-red-600 text-xs mt-1" id="error-consent"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-full flex items-center justify-center gap-2" id="booking-submit-btn">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M22 2L11 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M22 2l-7 20-4-9-9-4 20-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span>Book Consultation</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Selected Service Info (JS) -->
                        <div id="selected-service-info"></div>
                        <!-- What to Expect -->
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h3 class="card-title">What to Expect</h3>
                            </div>
                            <div class="card-content">
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3"><svg class="h-4 w-4 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 12l2 2 4-4" />
                                        </svg><span class="text-sm text-secondary-700">Free 30-60 minute consultation</span></div>
                                    <div class="flex items-center space-x-3"><svg class="h-4 w-4 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 12l2 2 4-4" />
                                        </svg><span class="text-sm text-secondary-700">Discussion of your specific needs</span></div>
                                    <div class="flex items-center space-x-3"><svg class="h-4 w-4 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 12l2 2 4-4" />
                                        </svg><span class="text-sm text-secondary-700">Personalized recommendations</span></div>
                                    <div class="flex items-center space-x-3"><svg class="h-4 w-4 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 12l2 2 4-4" />
                                        </svg><span class="text-sm text-secondary-700">Project timeline and pricing</span></div>
                                    <div class="flex items-center space-x-3"><svg class="h-4 w-4 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 12l2 2 4-4" />
                                        </svg><span class="text-sm text-secondary-700">Next steps and follow-up plan</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact Info -->
                        <div class="card box-shadow">
                            <div class="card-header">
                                <h3 class="card-title">Need Help?</h3>
                            </div>
                            <div class="card-content">
                                <div class="space-y-3 text-sm">
                                    <p class="text-secondary-600">If you have any questions about booking or need immediate assistance, feel free to contact us directly.</p>
                                    <div class="space-y-2">
                                        <p><span class="font-medium">Email:</span> <a href="mailto:aacinovations43@gmail.com" class="text-primary-600 hover:text-primary-700">aacinovations43@gmail.com</a></p>
                                        <p><span class="font-medium">Phone:</span> <a href="tel:+2341234567890" class="text-primary-600 hover:text-primary-700">0707 653 6019</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include '../components/footer.php'; ?>
    <!-- Toast Container (already implemented in contact.php, will be reused here) -->
    <div id="toast-container" class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:items-start sm:justify-end sm:p-6" style="display:none;">
        <div id="toast-stack" class="flex w-full flex-col items-center space-y-4 sm:items-end"></div>
    </div>
    <script src="js/navbar.js"></script>
    <script>
        // --- Data (could be fetched from backend in production) ---
        const services = [{
                id: 'ai-chatbots',
                title: 'AI Chatbot Development',
                description: 'Custom AI chatbots for your business',
                pricing: {
                    startingPrice: '$500',
                    description: 'Basic chatbot'
                }
            },
            {
                id: 'cloud-migration',
                title: 'Cloud Migration Services',
                description: 'Seamless migration to the cloud',
                pricing: {
                    startingPrice: '$1000',
                    description: 'Includes assessment'
                }
            },
            // Add more as needed
        ];
        // teamMembers removed; now fetched from backend
        const TIME_SLOTS = [
            '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM',
            '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM',
        ];

        // --- Populate select options ---
        async function populateOptions() {
            // Service select
            const serviceSelect = document.getElementById('serviceId');
            serviceSelect.innerHTML = '<option value="">Select a service</option>' +
                services.map(s => `<option value="${s.id}">${s.title}</option>`).join('');
            // Consultant select (fetch from backend)
            const consultantSelect = document.getElementById('consultantId');
            consultantSelect.innerHTML = '<option value="">Any available consultant</option>';
            try {
                const res = await fetch('../backend/api/consultants.php');
                const data = await res.json();
                if (data.success && Array.isArray(data.data)) {
                    consultantSelect.innerHTML += data.data.map(m => `<option value="${m.id}">${m.name} - ${m.role.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}</option>`).join('');
                }
            } catch (err) {
                consultantSelect.innerHTML += '<option value="" disabled>(Failed to load consultants)</option>';
            }
            // Time select
            const timeSelect = document.getElementById('preferredTime');
            timeSelect.innerHTML = '<option value="">Select a time</option>' +
                TIME_SLOTS.map(t => `<option value="${t}">${t}</option>`).join('');
            // Min date (tomorrow)
            const dateInput = document.getElementById('preferredDate');
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateInput.min = tomorrow.toISOString().split('T')[0];
        }

        // --- Preselect service from URL ---
        function preselectServiceFromURL() {
            const params = new URLSearchParams(window.location.search);
            const serviceId = params.get('service');
            if (serviceId) {
                const serviceSelect = document.getElementById('serviceId');
                serviceSelect.value = serviceId;
                showSelectedServiceInfo(serviceId);
            }
        }

        // --- Show selected service info in sidebar ---
        function showSelectedServiceInfo(serviceId) {
            const infoDiv = document.getElementById('selected-service-info');
            const service = services.find(s => s.id === serviceId);
            if (!service) {
                infoDiv.innerHTML = '';
                return;
            }
            infoDiv.innerHTML = `
                    <div class="card box-shadow">
                        <div class="card-header"><h3 class="card-title">Selected Service</h3></div>
                        <div class="card-content">
                            <div class="space-y-3">
                                <h4 class="font-semibold text-secondary-900">${service.title}</h4>
                                <p class="text-sm text-secondary-600">${service.description}</p>
                                ${service.pricing ? `<div class='p-3 bg-primary-50 rounded-lg'><div class='flex items-center justify-between'><span class='text-sm text-primary-700'>Starting at</span><span class='font-semibold text-primary-900'>${service.pricing.startingPrice}</span></div><p class='text-xs text-primary-600 mt-1'>${service.pricing.description}</p></div>` : ''}
                            </div>
                        </div>
                    </div>
                `;
        }

        // --- Toast system (reuse from contact.php) ---
        function showToast({
            type = 'info',
            title = '',
            message = '',
            duration = 3500
        }) {
            const container = document.getElementById('toast-container');
            const stack = document.getElementById('toast-stack');
            if (!container || !stack) return;
            container.style.display = 'flex';
            const icons = {
                success: '<svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M9 12l2 2 4-4" stroke-width="2"/></svg>',
                error: '<svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 8v4m0 4h.01" stroke-width="2"/></svg>',
                warning: '<svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 8v4m0 4h.01" stroke-width="2"/></svg>',
                info: '<svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 16v-4m0-4h.01" stroke-width="2"/></svg>'
            };
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `
                    <div class="flex items-start p-4">
                        <div class="toast-icon">${icons[type] || icons.info}</div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">${title}</p>
                            ${message ? `<p class="mt-1 text-sm opacity-90">${message}</p>` : ''}
                        </div>
                        <button class="toast-close" aria-label="Close">&times;</button>
                    </div>
                `;
            toast.querySelector('.toast-close').onclick = function() {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                    if (!stack.children.length) container.style.display = 'none';
                }, 200);
            };
            setTimeout(() => toast.classList.add('show'), 10);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                    if (!stack.children.length) container.style.display = 'none';
                }, 200);
            }, duration);
            stack.appendChild(toast);
        }

        // --- Booking form validation and submit ---
        document.addEventListener('DOMContentLoaded', function() {
            populateOptions();
            preselectServiceFromURL();
            // Update sidebar on service change
            document.getElementById('serviceId').addEventListener('change', function(e) {
                showSelectedServiceInfo(e.target.value);
            });
            // Booking form submit
            const form = document.getElementById('booking-form');
            const submitBtn = document.getElementById('booking-submit-btn');
            const fields = ['firstName', 'lastName', 'email', 'phone', 'company', 'serviceId', 'consultantId', 'preferredDate', 'preferredTime', 'message', 'consent'];

            function clearErrors() {
                fields.forEach(f => {
                    const el = document.getElementById('error-' + f);
                    if (el) el.textContent = '';
                });
            }

            function validate(formData) {
                let valid = true;
                clearErrors();
                if (!formData.firstName) {
                    document.getElementById('error-firstName').textContent = 'First name is required';
                    valid = false;
                }
                if (!formData.lastName) {
                    document.getElementById('error-lastName').textContent = 'Last name is required';
                    valid = false;
                }
                if (!formData.email) {
                    document.getElementById('error-email').textContent = 'Email is required';
                    valid = false;
                } else if (!/^\S+@\S+\.\S+$/.test(formData.email)) {
                    document.getElementById('error-email').textContent = 'Invalid email';
                    valid = false;
                }
                if (!formData.phone) {
                    document.getElementById('error-phone').textContent = 'Phone is required';
                    valid = false;
                }
                if (!formData.serviceId) {
                    document.getElementById('error-serviceId').textContent = 'Please select a service';
                    valid = false;
                }
                if (!formData.preferredDate) {
                    document.getElementById('error-preferredDate').textContent = 'Please select a date';
                    valid = false;
                }
                if (!formData.preferredTime) {
                    document.getElementById('error-preferredTime').textContent = 'Please select a time';
                    valid = false;
                }
                if (!document.getElementById('consent').checked) {
                    document.getElementById('error-consent').textContent = 'You must agree to the privacy policy';
                    valid = false;
                }
                return valid;
            }

            if (form) {
                form.onsubmit = async function(e) {
                    e.preventDefault();
                    clearErrors();
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-60');
                    // Gather form data
                    const formData = {
                        firstName: form.firstName.value.trim(),
                        lastName: form.lastName.value.trim(),
                        email: form.email.value.trim(),
                        phone: form.phone.value.trim(),
                        company: form.company.value.trim(),
                        serviceId: form.serviceId.value,
                        consultantId: form.consultantId.value,
                        preferredDate: form.preferredDate.value,
                        preferredTime: form.preferredTime.value,
                        message: form.message.value.trim(),
                        consent: form.consent.checked
                    };
                    if (!validate(formData)) {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-60');
                        return;
                    }
                    // Submit via AJAX
                    try {
                        const res = await fetch('../backend/api/bookings.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        });
                        const data = await res.json();
                        if (data.success) {
                            form.reset();
                            showToast({
                                type: 'success',
                                title: 'Booking Submitted',
                                message: "We'll confirm your appointment within 2 hours and send you a calendar invite."
                            });
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: data.message || 'Failed to submit booking. Please try again.'
                            });
                        }
                    } catch (err) {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Failed to submit booking. Please try again.'
                        });
                    } finally {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-60');
                    }
                };
            }
        });
    </script>
</body>

</html>