<?php
session_start();
error_log('SESSION: ' . print_r($_SESSION, true));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab logic
            const tabBtns = document.querySelectorAll('.profile-tab-btn');
            const tabPanels = document.querySelectorAll('.profile-tab-panel');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(b => b.classList.remove('border-blue-600', 'text-blue-600', 'font-semibold'));
                    this.classList.add('border-blue-600', 'text-blue-600', 'font-semibold');
                    tabPanels.forEach(panel => panel.style.display = 'none');
                    document.getElementById(this.dataset.tab).style.display = 'block';
                });
            });
            // Show first tab by default
            if (tabBtns.length) tabBtns[0].click();

            // Toast logic (same as before)
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

            // Profile tab logic
            const form = document.getElementById('profileForm');
            const loadingDiv = document.getElementById('profile-loading');
            let saving = false;

            function setLoading(loading) {
                loadingDiv.style.display = loading ? 'block' : 'none';
                form.style.display = loading ? 'none' : 'block';
            }

            function fillProfile(data) {
                form.username.value = data.username || '';
                form.email.value = data.email || '';
                form.firstName.value = data.firstName || '';
                form.lastName.value = data.lastName || '';
                form.role.value = data.role || '';
            }

            function loadProfile() {
                setLoading(true);
                fetch('../backend/api/profile.php?action=profile', {
                        credentials: 'include'
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.data) {
                            fillProfile(data.data);
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: data.error || 'Failed to load profile'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Failed to load profile'
                        });
                    })
                    .finally(() => setLoading(false));
            }
            form.onsubmit = function(e) {
                e.preventDefault();
                if (saving) return;
                saving = true;
                const btn = form.querySelector('button[type="submit"]');
                btn.disabled = true;
                fetch('../backend/api/profile.php?action=profile', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            email: form.email.value,
                            firstName: form.firstName.value,
                            lastName: form.lastName.value
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast({
                                type: 'success',
                                title: 'Profile Saved',
                                message: 'Profile updated successfully.'
                            });
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: data.error || 'Failed to update profile'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Failed to update profile'
                        });
                    })
                    .finally(() => {
                        saving = false;
                        btn.disabled = false;
                    });
            };
            loadProfile();

            // Password tab logic
            const passwordForm = document.getElementById('passwordForm');
            passwordForm.onsubmit = function(e) {
                e.preventDefault();
                if (saving) return;
                const newPassword = passwordForm.newPassword.value;
                const confirmPassword = passwordForm.confirmPassword.value;
                if (newPassword !== confirmPassword) {
                    showToast({
                        type: 'error',
                        title: 'Error',
                        message: 'Passwords do not match'
                    });
                    return;
                }
                saving = true;
                const btn = passwordForm.querySelector('button[type="submit"]');
                btn.disabled = true;
                fetch('../backend/api/profile.php?action=password', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        credentials: 'include',
                        body: JSON.stringify({
                            currentPassword: passwordForm.password.value,
                            newPassword: newPassword
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast({
                                type: 'success',
                                title: 'Password Changed',
                                message: 'Password changed successfully.'
                            });
                            passwordForm.password.value = '';
                            passwordForm.newPassword.value = '';
                            passwordForm.confirmPassword.value = '';
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: data.error || 'Failed to change password'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Failed to change password'
                        });
                    })
                    .finally(() => {
                        saving = false;
                        btn.disabled = false;
                    });
            };

            // Add Admin tab logic
            const addAdminForm = document.getElementById('addAdminForm');
            if (addAdminForm) {
                addAdminForm.onsubmit = function(e) {
                    e.preventDefault();
                    if (saving) return;
                    const btn = addAdminForm.querySelector('button[type="submit"]');
                    btn.disabled = true;
                    const password = addAdminForm.password.value;
                    const confirmPassword = addAdminForm.confirmPassword.value;
                    if (password !== confirmPassword) {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Passwords do not match'
                        });
                        btn.disabled = false;
                        return;
                    }
                    saving = true;
                    fetch('../backend/api/profile.php?action=add_admin', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            credentials: 'include',
                            body: JSON.stringify({
                                username: addAdminForm.username.value,
                                email: addAdminForm.email.value,
                                firstName: addAdminForm.firstName.value,
                                lastName: addAdminForm.lastName.value,
                                role: addAdminForm.role.value,
                                password: password
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                showToast({
                                    type: 'success',
                                    title: 'Admin Added',
                                    message: 'New admin added successfully.'
                                });
                                addAdminForm.reset();
                            } else {
                                showToast({
                                    type: 'error',
                                    title: 'Error',
                                    message: data.error || 'Failed to add admin'
                                });
                            }
                        })
                        .catch(() => {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: 'Failed to add admin'
                            });
                        })
                        .finally(() => {
                            saving = false;
                            btn.disabled = false;
                        });
                };
            }
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col lg:flex-row sidebar-open">
    <?php include 'components/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        <?php include 'components/topnav.php'; ?>
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="w-full max-w-4xl mx-auto">
                <h1 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">Admin Profile</h1>
                <div class="mb-6 border-b border-gray-200 flex space-x-4">
                    <button class="profile-tab-btn px-4 py-2 border-b-2 font-medium text-gray-600 focus:outline-none" data-tab="profile-tab">Profile</button>
                    <button class="profile-tab-btn px-4 py-2 border-b-2 font-medium text-gray-600 focus:outline-none" data-tab="password-tab">Change Password</button>
                    <button class="profile-tab-btn px-4 py-2 border-b-2 font-medium text-gray-600 focus:outline-none" data-tab="add-admin-tab">Add Admin</button>
                </div>
                <div id="profile-tab" class="profile-tab-panel" style="display:none;">
                    <div id="profile-loading" class="py-12 text-center text-gray-500">Loading profile...</div>
                    <form id="profileForm" class="card p-6 box-shadow space-y-4" style="display:none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" name="username" class="input w-full" disabled />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="firstName" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="lastName" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <input type="text" name="role" class="input w-full" disabled />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary min-w-32">Save Changes</button>
                        </div>
                    </form>
                </div>
                <div id="password-tab" class="profile-tab-panel" style="display:none;">
                    <form id="passwordForm" class="card p-6 box-shadow space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                <input type="password" name="password" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" name="newPassword" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                                <input type="password" name="confirmPassword" class="input w-full" required />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary min-w-32">Change Password</button>
                        </div>
                    </form>
                </div>
                <div id="add-admin-tab" class="profile-tab-panel" style="display:none;">
                    <form id="addAdminForm" class="card p-6 box-shadow space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Add Admin</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" name="username" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="firstName" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                                <input type="text" name="lastName" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select name="role" class="input w-full" required>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                    <option value="sales">Sales</option>
                                    <option value="support">Support</option>
                                    <option value="viewer">Viewer</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" name="password" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="input w-full" required />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary min-w-32">Add Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <!-- Toast Container -->
        <div id="toast-container" class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:items-start sm:justify-end sm:p-6" style="display:none;">
            <div id="toast-stack" class="flex w-full flex-col items-center space-y-4 sm:items-end"></div>
        </div>
        <!-- End Toast Container -->
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>