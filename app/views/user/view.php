<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f8fafc;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            color: #2d3748;
            padding: 1rem;
        }
        
        /* Main Container */
        .main-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            animation: slideInUp 0.6s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Header */
        .page-header {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .header-icon i {
            font-size: 1.25rem;
            color: white;
        }
        
        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }
        
        .header-title p {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-avatar i {
            font-size: 0.875rem;
            color: white;
        }
        
        .btn-logout {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        
        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
        }
        
        /* Content */
        .page-content {
            padding: 2rem;
            background: #ffffff;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .welcome-section h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .welcome-section p {
            color: #718096;
            font-size: 1rem;
        }
        
        /* Search and Actions */
        .search-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
        }
        
        .search-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .search-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .search-title i {
            color: #3182ce;
        }
        
        .search-form {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }
        
        .btn-search {
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-search:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3);
        }
        
        .btn-create {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-create:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
            color: white;
            text-decoration: none;
        }
        
        /* Table */
        .table-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table {
            margin: 0;
            font-size: 0.875rem;
        }
        
        .table thead th {
            background: #f8fafc;
            border: none;
            color: #4a5568;
            font-weight: 600;
            padding: 1rem;
        }
        
        .table tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }
        
        .table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table tbody tr:hover {
            background: #f8fafc;
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
        }
        
        .badge-admin {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .badge-user {
            background: #f0fdf4;
            color: #166534;
        }
        
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 4px;
            text-decoration: none;
            margin: 0 0.125rem;
            transition: all 0.2s ease;
        }
        
        .btn-view {
            background: #e6f3ff;
            color: #3182ce;
        }
        
        .btn-view:hover {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .btn-edit {
            background: #fef3c7;
            color: #d97706;
        }
        
        .btn-edit:hover {
            background: #fde68a;
            color: #b45309;
        }
        
        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .btn-delete:hover {
            background: #fecaca;
            color: #b91c1c;
        }
        
        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }
        
        .no-results i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #cbd5e0;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-container {
                margin: 0.5rem;
                border-radius: 16px;
            }
            
            .page-header {
                padding: 1rem 1.5rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .page-content {
                padding: 1.5rem;
            }
            
            .search-section {
                padding: 1rem;
            }
            
            .search-form {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .search-input {
                width: 100%;
            }
            
            .table-responsive {
                font-size: 0.75rem;
            }
            
            .table thead th,
            .table tbody td {
                padding: 0.5rem;
            }
        }
        
        /* Tablet Responsive */
        @media (max-width: 1024px) and (min-width: 769px) {
            .main-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="page-header">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="header-title">
                    <h1>User List</h1>
                    <p>Manage all users in the system</p>
                </div>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; font-weight: 500;"><?= isset($current_user['first_name']) ? $current_user['first_name'] . ' ' . $current_user['last_name'] : 'User' ?></div>
                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.8);"><?= isset($current_user['role']) ? ucfirst($current_user['role']) : 'User' ?></div>
                    </div>
                </div>
                <?php if (isset($is_admin) && $is_admin): ?>
                    <a href="<?= site_url('user/admin_dashboard') ?>" class="btn-logout">
                        <i class="fas fa-tachometer-alt me-1"></i>
                        Admin Dashboard
                    </a>
                <?php endif; ?>
                <a href="<?= site_url('user/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </a>
            </div>
        </div>
        
        <!-- Content -->
        <div class="page-content">
            <div class="welcome-section">
                <h2>User Management</h2>
                <p>View and manage all users in the system</p>
            </div>
            
            <!-- Search Section -->
            <div class="search-section">
                <div class="search-header">
                    <h3 class="search-title">
                        <i class="fas fa-search"></i>
                        Search Users
                    </h3>
                </div>
                <form method="GET" action="<?= site_url('user/all') ?>" class="search-form">
                    <input type="text" name="q" class="search-input" 
                           placeholder="Search by name, email, or username..." 
                           value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                    <button type="submit" class="btn-search">
                        <i class="fas fa-search me-1"></i>
                        Search
                    </button>
                    <?php if (isset($is_admin) && $is_admin): ?>
                        <a href="<?= site_url('user/create') ?>" class="btn-create">
                            <i class="fas fa-plus me-1"></i>
                            Create User
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            
            <!-- Table -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table" id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <?php if (isset($is_admin) && $is_admin): ?>
                                    <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($all) && !empty($all)): ?>
                                <?php foreach ($all as $user): ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td>
                                            <span class="badge <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                                <?= ucfirst($user['role']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <?php if (isset($is_admin) && $is_admin): ?>
                                            <td>
                                                <a href="<?= site_url('user/view/' . $user['id']) ?>" class="btn-action btn-view">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('user/edit/' . $user['id']) ?>" class="btn-action btn-edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= site_url('user/delete/' . $user['id']) ?>" class="btn-action btn-delete" 
                                                   onclick="return confirm('Are you sure you want to delete this user?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="<?= isset($is_admin) && $is_admin ? '7' : '6' ?>" class="no-results">
                                        <i class="fas fa-users"></i>
                                        <h5>No users found</h5>
                                        <p>Try adjusting your search criteria or create a new user.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.querySelector('.search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#usersTable tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Auto-submit search form
        document.querySelector('.search-form').addEventListener('submit', function(e) {
            const searchInput = this.querySelector('.search-input');
            if (searchInput.value.trim() === '') {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>