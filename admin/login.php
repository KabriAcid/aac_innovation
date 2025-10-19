<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | AAC Innovation</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-secondary-50 min-h-screen flex items-center justify-center">
    <main class="w-full max-w-lg p-6">
        <div class="card box-shadow rounded-3xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-primary-900 mb-2">Admin Sign In</h1>
                <p class="text-primary-600">Welcome back, admin!</p>
            </div>
            <form id="admin-login-form" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="input w-full" placeholder="Enter Email" required autocomplete="username">
                    <div class="form-error text-red-600 text-xs mt-1" id="error-email"></div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-secondary-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="input w-full" placeholder="Enter Password" required autocomplete="current-password">
                    <div class="form-error text-red-600 text-xs mt-1" id="error-password"></div>
                </div>
                <button type="submit" class="btn btn-primary w-full flex items-center justify-center gap-2" id="login-submit-btn">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M22 2L11 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 2l-7 20-4-9-9-4 20-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Sign In</span>
                </button>
                <div class="text-center mt-4">
                    <a href="#" id="forgot-password-link" class="text-primary-600 hover:underline text-sm">Forgot password?</a>
                </div>
            </form>
        </div>
        <!-- Forgot Password Modal -->
        <div id="forgot-password-modal" class="backdrop-blur-sm fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" style="display:none;">
            <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-sm relative">
                <button id="close-forgot-modal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl leading-none">&times;</button>
                <h2 class="text-xl font-bold mb-4 text-primary-900">Reset Password</h2>
                <form id="forgot-password-form" class="space-y-4">
                    <div>
                        <label for="forgot-email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                        <input type="email" id="forgot-email" name="forgot-email" class="input w-full" placeholder="Enter your email" required>
                        <div class="form-error text-red-600 text-xs mt-1" id="error-forgot-email"></div>
                    </div>
                    <button type="submit" class="btn btn-primary w-full">Send Reset Link</button>
                </form>
            </div>
        </div>
        </div>
        </form>
        </div>
        <!-- Toast Container -->
        <div id="toast-container" class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:items-start sm:justify-end sm:p-6" style="display:none;">
            <div id="toast-stack" class="flex w-full flex-col items-center space-y-4 sm:items-end"></div>
        </div>
    </main>
    <script>
        // Forgot password modal logic
        const forgotLink = document.getElementById('forgot-password-link');
        const forgotModal = document.getElementById('forgot-password-modal');
        const closeForgotModal = document.getElementById('close-forgot-modal');
        forgotLink.onclick = function(e) {
            e.preventDefault();
            forgotModal.style.display = 'flex';
        };
        closeForgotModal.onclick = function() {
            forgotModal.style.display = 'none';
        };
        window.onclick = function(e) {
            if (e.target === forgotModal) forgotModal.style.display = 'none';
        };
        document.getElementById('forgot-password-form').onsubmit = function(e) {
            e.preventDefault();
            const email = document.getElementById('forgot-email').value.trim();
            const errorForgotEmail = document.getElementById('error-forgot-email');
            errorForgotEmail.textContent = '';
            if (!email) {
                errorForgotEmail.textContent = 'Email is required';
                return;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                errorForgotEmail.textContent = 'Please enter a valid email';
                return;
            }
            // Placeholder for future email sending functionality
            showToast({
                type: 'info',
                title: 'Reset Link',
                message: 'Password reset link will be sent to your email (feature coming soon).'
            });
            setTimeout(() => {
                forgotModal.style.display = 'none';
            }, 1800);
        };
        // Toast system (reuse from public site)
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

        // Admin login form logic
        document.getElementById('admin-login-form').onsubmit = async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const errorEmail = document.getElementById('error-email');
            const errorPassword = document.getElementById('error-password');
            errorEmail.textContent = '';
            errorPassword.textContent = '';
            let valid = true;
            if (!email) {
                errorEmail.textContent = 'Email is required';
                valid = false;
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                errorEmail.textContent = 'Please enter a valid email';
                valid = false;
            }
            if (!password) {
                errorPassword.textContent = 'Password is required';
                valid = false;
            }
            if (!valid) {
                showToast({
                    type: 'error',
                    title: 'Validation Error',
                    message: 'Please fix the errors in the form'
                });
                return;
            }
            const submitBtn = document.getElementById('login-submit-btn');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-60');
            try {
                const res = await fetch('../backend/api/auth.php?action=login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'include',
                    body: JSON.stringify({
                        email,
                        password
                    })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    showToast({
                        type: 'success',
                        title: 'Login Successful',
                        message: 'Welcome back!'
                    });
                    setTimeout(() => {
                        window.location.href = '/admin/dashboard.php';
                    }, 1500);
                } else {
                    showToast({
                        type: 'error',
                        title: 'Login Failed',
                        message: data.message || 'Unknown error occurred'
                    });
                }
            } catch (err) {
                showToast({
                    type: 'error',
                    title: 'Login Failed',
                    message: 'Network or server error occurred'
                });
            } finally {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-60');
            }
        };
    </script>
</body>

</html>