<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register | AAC Innovation</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-secondary-50 min-h-screen flex items-center justify-center">
    <main class="w-full max-w-md p-6">
        <div class="card box-shadow rounded-3xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-primary-900 mb-2">Register</h1>
                <p class="text-primary-600">Create a new admin account</p>
            </div>
            <form id="admin-register-form" class="space-y-6">
                <div class="flex gap-2">
                    <div class="w-1/2">
                        <label for="first_name" class="block text-sm font-medium text-secondary-700 mb-1">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="input w-full" placeholder="First Name" required>
                        <div class="form-error text-red-600 text-xs mt-1" id="error-first_name"></div>
                    </div>
                    <div class="w-1/2">
                        <label for="last_name" class="block text-sm font-medium text-secondary-700 mb-1">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="input w-full" placeholder="Last Name" required>
                        <div class="form-error text-red-600 text-xs mt-1" id="error-last_name"></div>
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-secondary-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="input w-full" placeholder="Enter Email" required autocomplete="username">
                    <div class="form-error text-red-600 text-xs mt-1" id="error-email"></div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-secondary-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="input w-full" placeholder="Enter Password" required autocomplete="new-password">
                    <div class="form-error text-red-600 text-xs mt-1" id="error-password"></div>
                </div>
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-secondary-700 mb-1">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="input w-full" placeholder="Confirm Password" required autocomplete="new-password">
                    <div class="form-error text-red-600 text-xs mt-1" id="error-confirmPassword"></div>
                </div>
                <button type="submit" class="btn btn-primary w-full flex items-center justify-center gap-2" id="register-submit-btn">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M22 2L11 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M22 2l-7 20-4-9-9-4 20-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Register</span>
                </button>
                <div class="text-center mt-4">
                    <a href="login.php" class="text-primary-600 hover:underline text-sm">Already have an account? Log in</a>
                </div>
            </form>
        </div>
        <!-- Toast Container -->
        <div id="toast-container" class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:items-start sm:justify-end sm:p-6" style="display:none;">
            <div id="toast-stack" class="flex w-full flex-col items-center space-y-4 sm:items-end"></div>
        </div>
    </main>
    <script>
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

        // Admin register form logic
        document.getElementById('admin-register-form').onsubmit = async function(e) {
            e.preventDefault();
            const first_name = document.getElementById('first_name').value.trim();
            const last_name = document.getElementById('last_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            // Error elements
            const errorFirstName = document.getElementById('error-first_name');
            const errorLastName = document.getElementById('error-last_name');
            const errorEmail = document.getElementById('error-email');
            const errorPassword = document.getElementById('error-password');
            const errorConfirmPassword = document.getElementById('error-confirmPassword');
            // Clear errors
            errorFirstName.textContent = '';
            errorLastName.textContent = '';
            errorEmail.textContent = '';
            errorPassword.textContent = '';
            errorConfirmPassword.textContent = '';
            let valid = true;
            if (!first_name) {
                errorFirstName.textContent = 'First name is required';
                valid = false;
            }
            if (!last_name) {
                errorLastName.textContent = 'Last name is required';
                valid = false;
            }
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
            } else if (password.length < 6) {
                errorPassword.textContent = 'Password must be at least 6 characters';
                valid = false;
            }
            if (password !== confirmPassword) {
                errorConfirmPassword.textContent = 'Passwords do not match';
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
            const submitBtn = document.getElementById('register-submit-btn');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-60');
            try {
                const res = await fetch('../backend/api/auth.php?action=register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    credentials: 'include',
                    body: JSON.stringify({
                        email,
                        password,
                        first_name,
                        last_name
                    })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    showToast({
                        type: 'success',
                        title: 'Registration Successful',
                        message: 'You can now log in with your credentials'
                    });
                    setTimeout(() => {
                        window.location.href = 'login.php';
                    }, 1500);
                } else {
                    showToast({
                        type: 'error',
                        title: 'Registration Failed',
                        message: data.message || 'Unknown error occurred'
                    });
                }
            } catch (err) {
                showToast({
                    type: 'error',
                    title: 'Registration Failed',
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