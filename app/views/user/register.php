<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - User Management System</title>
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
        .register-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 500px;
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
        
        /* Form */
        .register-form {
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
        
        /* Checkbox */
        .form-check {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e0;
            border-radius: 4px;
            margin-right: 0.75rem;
            margin-top: 0.2rem;
            accent-color: #3182ce;
            cursor: pointer;
        }
        
        .form-check-label {
            font-size: 0.9rem;
            color: #4a5568;
            cursor: pointer;
            line-height: 1.4;
        }
        
        .form-check-label a {
            color: #3182ce;
            text-decoration: none;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }
        
        /* Button */
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 1rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }
        
        .btn-register:hover::before {
            left: 100%;
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(49, 130, 206, 0.4);
        }
        
        .btn-register:active {
            transform: translateY(-1px);
        }
        
        .btn-register:disabled {
            background: #a0aec0;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }
        
        .divider span {
            padding: 0 1.5rem;
            font-size: 0.8rem;
            color: #a0aec0;
            background: #ffffff;
        }
        
        /* Login Link */
        .login-section {
            text-align: center;
        }
        
        .login-section p {
            font-size: 0.9rem;
            color: #718096;
            margin-bottom: 0.5rem;
        }
        
        .btn-login {
            color: #3182ce;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .btn-login:hover {
            color: #2c5aa0;
            text-decoration: underline;
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
        .btn-register.loading {
            position: relative;
            color: transparent;
        }
        
        .btn-register.loading::after {
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
            .register-container {
                margin: 0.5rem;
                border-radius: 16px;
            }
            
            .register-form {
                padding: 1.5rem;
            }
            
            .welcome-section h2 {
                font-size: 1.25rem;
            }
            
            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }
        
        /* Tablet Responsive */
        @media (min-width: 768px) {
            .register-container {
                max-width: 550px;
            }
        }
        
        /* Desktop Responsive */
        @media (min-width: 1024px) {
            .register-container {
                max-width: 600px;
            }
            
            .register-form {
                padding: 2.5rem;
            }
            
            .welcome-section h2 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Form -->
        <div class="register-form">
            <div class="welcome-section">
                <h2>Create Account</h2>
                <p>Join our platform today</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $success ?>
                    <?php if (isset($show_navigation) && $show_navigation): ?>
                        <div class="mt-3">
                            <a href="<?php echo base_url('user/login'); ?>" class="btn btn-primary me-2">Go to Login</a>
                            <a href="<?php echo base_url(); ?>" class="btn btn-outline-primary">Back to Home</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo base_url('user/register'); ?>" id="registerForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="form-label">First Name</label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                       value="<?= isset($form_data['first_name']) ? $form_data['first_name'] : '' ?>" 
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
                                       value="<?= isset($form_data['last_name']) ? $form_data['last_name'] : '' ?>" 
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
                               value="<?= isset($form_data['username']) ? $form_data['username'] : '' ?>" 
                               placeholder="Choose a username" required>
                        <i class="fas fa-at input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= isset($form_data['email']) ? $form_data['email'] : '' ?>" 
                               placeholder="Enter email address" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Create password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                               placeholder="Confirm password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <?php $isAdmin = isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin'; ?>
                <?php if ($isAdmin): ?>
                <div class="form-group">
                    <label for="role" class="form-label">Role</label>
                    <div class="input-wrapper">
                        <select class="form-select" id="role" name="role">
                            <option value="user" <?= (isset($form_data['role']) && $form_data['role']==='user')?'selected':''; ?>>User</option>
                            <option value="admin" <?= (isset($form_data['role']) && $form_data['role']==='admin')?'selected':''; ?>>Admin</option>
                        </select>
                        <i class="fas fa-user-tag input-icon"></i>
                    </div>
                </div>
                <?php endif; ?>

                <button type="submit" class="btn-register" id="registerBtn">
                    <i class="fas fa-user-plus me-2"></i>
                    CREATE ACCOUNT
                </button>
            </form>

            <div class="divider">
                <span>or</span>
            </div>

            <div class="login-section">
                <p>Already have an account? <a href="<?php echo base_url('user/login'); ?>" class="btn-login">Sign In</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form submission with loading state
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
        
        // Form validation
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long!');
                return false;
            }
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