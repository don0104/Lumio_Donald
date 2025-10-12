<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        }
        
        /* Main Container */
        .main-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin: 1rem;
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
        .dashboard-header {
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
        .dashboard-content {
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
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-icon.users { background: #e6f3ff; color: #3182ce; }
        .stat-icon.admins { background: #f0f9ff; color: #0ea5e9; }
        .stat-icon.active { background: #f0fdf4; color: #16a34a; }
        .stat-icon.pending { background: #fefce8; color: #eab308; }
        
        .stat-icon i {
            font-size: 1.25rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 500;
        }
        
        /* User Management */
        .user-management {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2d3748;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-title i {
            color: #3182ce;
        }
        
        .btn-create {
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-create:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3);
            color: white;
            text-decoration: none;
        }
        
        /* Table */
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
        
        /* Recent Activity */
        .recent-activity {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }
        
        .activity-icon.register { background: #e6f3ff; color: #3182ce; }
        .activity-icon.update { background: #fef3c7; color: #d97706; }
        .activity-icon.system { background: #f0fdf4; color: #16a34a; }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-text {
            font-size: 0.875rem;
            color: #4a5568;
            margin-bottom: 0.25rem;
        }
        
        .activity-time {
            font-size: 0.75rem;
            color: #9ca3af;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .main-container {
                margin: 0.5rem;
                border-radius: 16px;
            }
            
            .dashboard-header {
                padding: 1rem 1.5rem;
                flex-direction: column;
                gap: 1rem;
            }
            
            .dashboard-content {
                padding: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="header-left">
                <div class="header-icon">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <div class="header-title">
                    <h1>Admin Dashboard</h1>
                    <p>User Management System</p>
                </div>
            </div>
            <div class="header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; font-weight: 500;"><?= isset($current_user['first_name']) ? $current_user['first_name'] . ' ' . $current_user['last_name'] : 'Admin User' ?></div>
                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.8);">Administrator</div>
                    </div>
                </div>
                <a href="<?= site_url('user/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-1"></i>
                    Logout
                </a>
            </div>
        </div>
        
        <!-- Content -->
        <div class="dashboard-content">
            <div class="welcome-section">
                <h2>Welcome back, <?= isset($current_user['first_name']) ? $current_user['first_name'] : 'Admin' ?>!</h2>
                <p>Manage your users and monitor system activity</p>
            </div>
            
            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon users">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($total_users) ? $total_users : '0' ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon admins">
                            <i class="fas fa-user-shield"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($admin_count) ? $admin_count : '0' ?></div>
                    <div class="stat-label">Administrators</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon active">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($active_users) ? $active_users : '0' ?></div>
                    <div class="stat-label">Active Users</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($pending_users) ? $pending_users : '0' ?></div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
            
            <div class="row">
                <!-- User Management -->
                <div class="col-lg-8">
                    <div class="user-management">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-users"></i>
                                User Management
                            </h3>
                            <a href="<?= site_url('user/create') ?>" class="btn-create">
                                <i class="fas fa-plus me-1"></i>
                                Create User
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($users_all) && !empty($users_all)): ?>
                                        <?php foreach ($users_all as $user): ?>
                                            <tr>
                                                <td><?= $user['id'] ?></td>
                                                <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                                <td><?= $user['email'] ?></td>
                                                <td>
                                                    <span class="badge <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                                        <?= ucfirst($user['role']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">Active</span>
                                                </td>
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
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-users fa-2x mb-2"></i>
                                                    <p>No users found</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="col-lg-4">
                    <div class="recent-activity">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-history"></i>
                                Recent Activity
                            </h3>
                        </div>
                        
                        <?php if (isset($recent_activity) && !empty($recent_activity)): ?>
                            <?php foreach ($recent_activity as $activity): ?>
                                <div class="activity-item">
                                    <div class="activity-icon <?= $activity['type'] ?>">
                                        <i class="fas fa-<?= $activity['icon'] ?>"></i>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-text"><?= $activity['message'] ?></div>
                                        <div class="activity-time"><?= $activity['time'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-history fa-2x mb-2"></i>
                                    <p>No recent activity</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>