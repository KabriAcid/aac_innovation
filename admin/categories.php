<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    <link rel="shortcut icon" href="../public/favicon/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="script.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let categories = [];
            const list = document.getElementById('categories-list');
            const addBtn = document.getElementById('addCategoryBtn');

            function fetchCategories() {
                fetch('../backend/api/category.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.success && Array.isArray(data.data)) {
                            categories = data.data;
                            renderCategories(categories);
                        } else {
                            list.innerHTML = `<div class='card p-12 text-center'><h3 class='text-lg font-medium text-gray-900 mb-2'>No categories found</h3><p class='text-gray-500'>No category records found.</p></div>`;
                        }
                    });
            }

            function renderCategories(arr) {
                if (!list) return;
                if (!arr.length) {
                    list.innerHTML = `<div class='card p-12 text-center'><h3 class='text-lg font-medium text-gray-900 mb-2'>No categories found</h3><p class='text-gray-500'>No category records found.</p></div>`;
                    return;
                }
                list.innerHTML = arr.map(cat => `
                    <div class='card p-4 flex items-center justify-between'>
                        <span class='font-medium text-gray-900'>${cat.name}</span>
                        <div class='flex gap-2'>
                            <button class='edit-category-btn btn btn-secondary btn-sm' data-id='${cat.id}'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-pencil-icon lucide-pencil'><path d='M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z'/><path d='m15 5 4 4'/></svg></button>
                            <button class='delete-category-btn btn btn-danger btn-sm' data-id='${cat.id}'><svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-trash-2'><polyline points='3 6 5 6 21 6'/><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m5 6v6m4-6v6'/></svg></button>
                        </div>
                    </div>
                `).join('');
                // Attach listeners
                document.querySelectorAll('.edit-category-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = this.getAttribute('data-id');
                        openCategoryModal('edit', id);
                    });
                });
                document.querySelectorAll('.delete-category-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const id = this.getAttribute('data-id');
                        if (confirm('Are you sure you want to delete this category?')) {
                            fetch(`../backend/api/category.php?id=${id}`, {
                                    method: 'DELETE'
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) fetchCategories();
                                    else alert('Failed to delete category');
                                });
                        }
                    });
                });
            }

            addBtn.addEventListener('click', function() {
                openCategoryModal('add');
            });

            function openCategoryModal(mode, id = null) {
                let category = {
                    name: ''
                };
                if (mode === 'edit' && id) {
                    const cat = categories.find(c => String(c.id) === String(id));
                    if (cat) category = {
                        name: cat.name
                    };
                }
                showCategoryModal(category, mode, id);
            }

            function showCategoryModal(category, mode, id) {
                document.getElementById('category-modal')?.remove();
                const modal = document.createElement('div');
                modal.id = 'category-modal';
                modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30 backdrop-blur-sm';
                modal.innerHTML = `
                    <div class='bg-white rounded-lg shadow-lg w-full max-w-md p-8 relative'>
                        <button class='absolute top-4 right-4 text-gray-400 hover:text-gray-600' onclick='document.getElementById("category-modal").remove()'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><path d='M6 18L18 6M6 6l12 12'/></svg>
                        </button>
                        <h2 class='text-xl font-bold mb-6'>${mode === 'edit' ? 'Edit Category' : 'Add Category'}</h2>
                        <form id='categoryForm' class='space-y-4'>
                            <div>
                                <label class='block text-sm font-medium text-gray-700 mb-1'>Category Name</label>
                                <input type='text' name='name' value='${category.name}' class='input w-full' required placeholder='e.g., Cybersecurity' />
                            </div>
                            <div class='flex space-x-3 pt-4'>
                                <button type='submit' class='btn btn-primary flex-1'>${mode === 'edit' ? 'Update Category' : 'Save Category'}</button>
                                <button type='button' class='btn btn-secondary flex-1' onclick='document.getElementById("category-modal").remove()'>Cancel</button>
                            </div>
                        </form>
                    </div>
                `;
                document.body.appendChild(modal);
                document.getElementById('categoryForm').onsubmit = function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    const payload = {
                        name: fd.get('name')
                    };
                    if (mode === 'edit' && id) {
                        fetch(`../backend/api/category.php?id=${id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('category-modal').remove();
                                    fetchCategories();
                                } else {
                                    alert('Failed to update category');
                                }
                            });
                    } else {
                        fetch('../backend/api/category.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('category-modal').remove();
                                    fetchCategories();
                                } else {
                                    alert('Failed to save category');
                                }
                            });
                    }
                };
            }

            fetchCategories();
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
                    <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
                    <button id="addCategoryBtn" class="btn btn-primary flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>Add Category</button>
                </div>
                <div id="categories-list" class="space-y-4"></div>
            </div>
        </main>
        <?php include 'components/footer.php'; ?>
    </div>
</body>

</html>