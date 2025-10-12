<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
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
            max-width: 600px;
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
            font-size: 1.5rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }
        
        .welcome-section p {
            color: #718096;
            font-size: 0.9rem;
        }
        
        /* Form */
        .edit-form {
            background: #ffffff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        
        /* Form Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 1rem;
            z-index: 2;
        }
        
        .form-control {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            background: #ffffff;
            transition: all 0.3s ease;
            color: #2d3748;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 4px rgba(49, 130, 206, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control:focus + .input-icon {
            color: #3182ce;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        .form-select {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            background: #ffffff;
            transition: all 0.3s ease;
            color: #2d3748;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 4px rgba(49, 130, 206, 0.1);
            transform: translateY(-2px);
        }
        
        /* Buttons */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .btn-save {
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-save::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .btn-save:hover::before {
            left: 100%;
        }
        
        .btn-save:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(49, 130, 206, 0.4);
        }
        
        .btn-save:active {
            transform: translateY(-1px);
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(107, 114, 128, 0.4);
            color: white;
            text-decoration: none;
        }
        
        /* Alert */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: alertSlideIn 0.3s ease-out;
            border-left: 4px solid;
        }
        
        @keyframes alertSlideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left-color: #dc2626;
        }
        
        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border-left-color: #16a34a;
        }
        
        /* Loading State */
        .btn-save.loading {
            position: relative;
            color: transparent;
        }
        
        .btn-save.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 24px;
            height: 24px;
            margin: -12px 0 0 -12px;
            border: 3px solid transparent;
            border-top: 3px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Mobile Responsive */
        @media (max-width: 480px) {
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
            
            .edit-form {
                padding: 1.5rem;
            }
            
            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
        
        /* Tablet Responsive */
        @media (min-width: 768px) {
            .main-container {
                max-width: 700px;
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
                    <i class="fas fa-edit"></i>
                </div>
                <div class="header-title">
                    <h1>Edit User</h1>
                    <p>Update user information</p>
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
                <h2>Edit User Information</h2>
                <p>Update the user's details and settings</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $success ?>
                </div>
            <?php endif; ?>

            <?php if (isset($user) && $user): ?>
                <div class="edit-form">
                    <form method="POST" action="<?= site_url('user/update/' . $user['id']) ?>" id="editForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <div class="input-wrapper">
                                        <input type="text" class="form-control" id="first_name" name="first_name" 
                                               value="<?= isset($user['first_name']) ? $user['first_name'] : '' ?>" 
                                               placeholder="First name" required>
                                        <i class="fas fa-user input-icon"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <div class="input-wrapper">
                                        <input type="text" class="form-control" id="last_name" name="last_name" 
                                               value="<?= isset($user['last_name']) ? $user['last_name'] : '' ?>" 
                                               placeholder="Last name" required>
                                        <i class="fas fa-user input-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?= isset($user['username']) ? $user['username'] : '' ?>" 
                                       placeholder="Username" required>
                                <i class="fas fa-at input-icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-wrapper">
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= isset($user['email']) ? $user['email'] : '' ?>" 
                                       placeholder="Email address" required>
                                <i class="fas fa-envelope input-icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">New Password (Optional)</label>
                            <div class="input-wrapper">
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Leave blank to keep current password">
                                <i class="fas fa-lock input-icon"></i>
                            </div>
                            <small class="text-muted">Leave blank to keep the current password</small>
                        </div>

                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <div class="input-wrapper">
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user" <?= (isset($user['role']) && $user['role'] === 'user') ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= (isset($user['role']) && $user['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <i class="fas fa-user-tag input-icon"></i>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save" id="saveBtn">
                                <i class="fas fa-save me-2"></i>
                                Update User
                            </button>
                            <a href="<?= site_url('user/all') ?>" class="btn-cancel">
                                <i class="fas fa-times me-2"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">User Not Found</h4>
                    <p class="text-muted">The user you're trying to edit doesn't exist or has been removed.</p>
                    <a href="<?= site_url('user/all') ?>" class="btn-cancel">
                        <i class="fas fa-arrow-left me-1"></i>
                        Back to User List
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form submission with loading state
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('saveBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
        
        // Auto-dismiss alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
        
        // Add focus effects
        document.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#3182ce';
                this.style.boxShadow = '0 0 0 4px rgba(49, 130, 206, 0.1)';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = '#e2e8f0';
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>