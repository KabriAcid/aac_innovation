<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let settings = null;
            const form = document.getElementById('settingsForm');
            const loadingDiv = document.getElementById('settings-loading');
            const saveCompanyBtn = document.getElementById('saveCompanyBtn');
            const saveSocialBtn = document.getElementById('saveSocialBtn');
            const saveSmtpBtn = document.getElementById('saveSmtpBtn');

            // Toast system (copied from booking.php for consistency)
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

            function setLoading(loading) {
                loadingDiv.style.display = loading ? 'block' : 'none';
                form.style.display = loading ? 'none' : 'block';
            }

            function fillForm(data) {
                form.companyName.value = data.companyName || '';
                form.companyEmail.value = data.companyEmail || '';
                form.companyPhone.value = data.companyPhone || '';
                form.companyAddress.value = data.companyAddress || '';
                form.websiteUrl.value = data.websiteUrl || '';
                form.facebook.value = data.socialMedia.facebook || '';
                form.twitter.value = data.socialMedia.twitter || '';
                form.linkedin.value = data.socialMedia.linkedin || '';
                form.instagram.value = data.socialMedia.instagram || '';
                form.smtpHost.value = data.emailSettings.smtpHost || '';
                form.smtpPort.value = data.emailSettings.smtpPort || '';
                form.smtpUser.value = data.emailSettings.smtpUser || '';
                form.smtpPassword.value = data.emailSettings.smtpPassword || '';
            }

            function getFormData() {
                return {
                    companyName: form.companyName.value,
                    companyEmail: form.companyEmail.value,
                    companyPhone: form.companyPhone.value,
                    companyAddress: form.companyAddress.value,
                    websiteUrl: form.websiteUrl.value,
                    socialMedia: {
                        facebook: form.facebook.value,
                        twitter: form.twitter.value,
                        linkedin: form.linkedin.value,
                        instagram: form.instagram.value
                    },
                    emailSettings: {
                        smtpHost: form.smtpHost.value,
                        smtpPort: form.smtpPort.value,
                        smtpUser: form.smtpUser.value,
                        smtpPassword: form.smtpPassword.value
                    }
                };
            }

            function getCompanyData() {
                return {
                    companyName: form.companyName.value,
                    companyEmail: form.companyEmail.value,
                    companyPhone: form.companyPhone.value,
                    companyAddress: form.companyAddress.value,
                    websiteUrl: form.websiteUrl.value
                };
            }

            function getSocialData() {
                return {
                    socialMedia: {
                        facebook: form.facebook.value,
                        twitter: form.twitter.value,
                        linkedin: form.linkedin.value,
                        instagram: form.instagram.value
                    }
                };
            }

            function getSmtpData() {
                return {
                    emailSettings: {
                        smtpHost: form.smtpHost.value,
                        smtpPort: form.smtpPort.value,
                        smtpUser: form.smtpUser.value,
                        smtpPassword: form.smtpPassword.value
                    }
                };
            }

            function loadSettings() {
                setLoading(true);
                fetch('../backend/api/settings.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && data.data) {
                            settings = data.data;
                            fillForm(settings);
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Failed to load settings'
                        });
                    })
                    .finally(() => setLoading(false));
            }
            form.onsubmit = function(e) {
                e.preventDefault();
            };

            saveCompanyBtn.onclick = function() {
                saveCompanyBtn.disabled = true;
                fetch('../backend/api/settings.php', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(getCompanyData())
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast({
                                type: 'success',
                                title: 'Company Saved',
                                message: 'Company info updated.'
                            });
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: 'Failed to save company info.'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Network or server error.'
                        });
                    })
                    .finally(() => {
                        saveCompanyBtn.disabled = false;
                    });
            };
            saveSocialBtn.onclick = function() {
                saveSocialBtn.disabled = true;
                fetch('../backend/api/settings.php', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(getSocialData())
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast({
                                type: 'success',
                                title: 'Social Saved',
                                message: 'Social media updated.'
                            });
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: 'Failed to save social media.'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Network or server error.'
                        });
                    })
                    .finally(() => {
                        saveSocialBtn.disabled = false;
                    });
            };
            saveSmtpBtn.onclick = function() {
                saveSmtpBtn.disabled = true;
                fetch('../backend/api/settings.php', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(getSmtpData())
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showToast({
                                type: 'success',
                                title: 'SMTP Saved',
                                message: 'SMTP settings updated.'
                            });
                        } else {
                            showToast({
                                type: 'error',
                                title: 'Error',
                                message: 'Failed to save SMTP settings.'
                            });
                        }
                    })
                    .catch(() => {
                        showToast({
                            type: 'error',
                            title: 'Error',
                            message: 'Network or server error.'
                        });
                    })
                    .finally(() => {
                        saveSmtpBtn.disabled = false;
                    });
            };
            loadSettings();
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col lg:flex-row sidebar-open">
    <?php include 'components/sidebar.php'; ?>
    <div class="flex-1 flex flex-col min-h-screen lg:ml-0 lg:pl-0">
        <?php include 'components/topnav.php'; ?>
        <main class="p-4 sm:p-6 lg:p-8 flex-1">
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke-width="2" />
                            <path d="M12 16v-4m0-4h.01" stroke-width="2" />
                        </svg>
                        Settings
                    </h1>
                </div>
                <div id="settings-loading" class="animate-pulse space-y-4">
                    <div class="bg-gray-200 h-64 rounded-lg"></div>
                </div>
                <form id="settingsForm" class="space-y-6" style="display:none;">
                    <div class="card p-6 box-shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                                <input type="text" name="companyName" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="companyEmail" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="tel" name="companyPhone" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Website URL</label>
                                <input type="url" name="websiteUrl" class="input w-full" required />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea name="companyAddress" class="input w-full" rows="2" required></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="saveCompanyBtn" type="button" class="btn btn-primary min-w-32">Save Company</button>
                        </div>
                    </div>
                    <div class="card p-6 box-shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Media</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                                <input type="url" name="facebook" class="input w-full" placeholder="https://facebook.com/yourpage" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Twitter</label>
                                <input type="url" name="twitter" class="input w-full" placeholder="https://twitter.com/youraccount" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                                <input type="url" name="linkedin" class="input w-full" placeholder="https://linkedin.com/company/yourcompany" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                                <input type="url" name="instagram" class="input w-full" placeholder="https://instagram.com/youraccount" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="saveSocialBtn" type="button" class="btn btn-primary min-w-32">Save Social</button>
                        </div>
                    </div>
                    <div class="card p-6 box-shadow">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Email (SMTP) Settings</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Host</label>
                                <input type="text" name="smtpHost" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Port</label>
                                <input type="text" name="smtpPort" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP User</label>
                                <input type="text" name="smtpUser" class="input w-full" required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SMTP Password</label>
                                <input type="password" name="smtpPassword" class="input w-full" required />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button id="saveSmtpBtn" type="button" class="btn btn-primary min-w-32">Save SMTP</button>
                        </div>
                    </div>
                </form>
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