<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
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
            max-width: 800px;
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
        
        .btn-back {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
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
        
        /* User Profile */
        .user-profile {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            margin-bottom: 2rem;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
        }
        
        .profile-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }
        
        .profile-info p {
            color: #718096;
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .profile-role {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .role-admin {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .role-user {
            background: #f0fdf4;
            color: #166534;
        }
        
        /* User Details */
        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .detail-group {
            background: #f8fafc;
            border-radius: 8px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
        }
        
        .detail-group h4 {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-group h4 i {
            color: #3182ce;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-size: 0.875rem;
            color: #4a5568;
            font-weight: 500;
        }
        
        .detail-value {
            font-size: 0.875rem;
            color: #2d3748;
            font-weight: 400;
        }
        
        .detail-value.badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
        }
        
        .badge-active {
            background: #f0fdf4;
            color: #166534;
        }
        
        .badge-inactive {
            background: #fee2e2;
            color: #dc2626;
        }
        
        /* Actions */
        .actions-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        .actions-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .actions-title i {
            color: #3182ce;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .btn-action {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            color: white;
        }
        
        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }
        
        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .btn-back-list {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }
        
        .btn-back-list:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
            color: white;
            text-decoration: none;
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
            
            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
            
            .user-details {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-action {
                text-align: center;
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
                    <i class="fas fa-user"></i>
                </div>
                <div class="header-title">
                    <h1>User Details</h1>
                    <p>View user information and details</p>
                </div>
            </div>
            <div class="header-right">
                <a href="<?= site_url('user/all') ?>" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i>
                    Back to User List
                </a>
            </div>
        </div>
        
        <!-- Content -->
        <div class="page-content">
            <div class="welcome-section">
                <h2>User Profile</h2>
                <p>Complete user information and details</p>
            </div>
            
            <?php if (isset($user) && $user): ?>
                <!-- User Profile -->
                <div class="user-profile">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="profile-info">
                            <h3><?= $user['first_name'] . ' ' . $user['last_name'] ?></h3>
                            <p><?= $user['email'] ?></p>
                            <span class="profile-role <?= $user['role'] === 'admin' ? 'role-admin' : 'role-user' ?>">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="user-details">
                        <div class="detail-group">
                            <h4><i class="fas fa-id-card"></i> Personal Information</h4>
                            <div class="detail-item">
                                <span class="detail-label">User ID</span>
                                <span class="detail-value">#<?= $user['id'] ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">First Name</span>
                                <span class="detail-value"><?= $user['first_name'] ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Last Name</span>
                                <span class="detail-value"><?= $user['last_name'] ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Email Address</span>
                                <span class="detail-value"><?= $user['email'] ?></span>
                            </div>
                        </div>
                        
                        <div class="detail-group">
                            <h4><i class="fas fa-user-circle"></i> Account Information</h4>
                            <div class="detail-item">
                                <span class="detail-label">Username</span>
                                <span class="detail-value"><?= $user['username'] ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Role</span>
                                <span class="detail-value badge <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                    <?= ucfirst($user['role']) ?>
                                </span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span class="detail-value badge badge-active">Active</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Last Login</span>
                                <span class="detail-value"><?= isset($user['last_login']) ? date('M d, Y H:i', strtotime($user['last_login'])) : 'Never' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="actions-section">
                    <h3 class="actions-title">
                        <i class="fas fa-cogs"></i>
                        Actions
                    </h3>
                    <div class="action-buttons">
                        <a href="<?= site_url('user/edit/' . $user['id']) ?>" class="btn-action btn-edit">
                            <i class="fas fa-edit me-1"></i>
                            Edit User
                        </a>
                        <a href="<?= site_url('user/delete/' . $user['id']) ?>" class="btn-action btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this user?')">
                            <i class="fas fa-trash me-1"></i>
                            Delete User
                        </a>
                        <a href="<?= site_url('user/all') ?>" class="btn-action btn-back-list">
                            <i class="fas fa-list me-1"></i>
                            Back to User List
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">User Not Found</h4>
                    <p class="text-muted">The user you're looking for doesn't exist or has been removed.</p>
                    <a href="<?= site_url('user/all') ?>" class="btn-action btn-back-list">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to User List
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>