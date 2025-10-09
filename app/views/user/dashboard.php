<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= config_item('base_url') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .dashboard-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card dashboard-card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user me-2"></i>
                            Welcome, <?= isset($user['first_name']) ? $user['first_name'] : 'User' ?> <?= isset($user['last_name']) ? $user['last_name'] : '' ?>!
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Account Information</h5>
                                <p><strong>Username:</strong> <?= isset($user['username']) ? $user['username'] : 'N/A' ?></p>
                                <p><strong>Email:</strong> <?= isset($user['email']) ? $user['email'] : 'N/A' ?></p>
                                <p><strong>Role:</strong> <span class="badge bg-info"><?= isset($user['role']) ? ucfirst($user['role']) : 'User' ?></span></p>
                            </div>
                            <div class="col-md-6">
                                <h5>Quick Actions</h5>
                                <div class="d-grid gap-2">
                                    <a href="<?= base_url('user/all'); ?>" class="btn btn-outline-primary">
                                        <i class="fas fa-users me-2"></i>View All Users
                                    </a>
                                    <a href="<?= base_url('user/create'); ?>" class="btn btn-outline-success">
                                        <i class="fas fa-user-plus me-2"></i>Add New User
                                    </a>
                                    <?php if (isset($user['role']) && strtolower($user['role']) === 'admin'): ?>
                                    <a href="<?= base_url('user/admin_dashboard'); ?>" class="btn btn-outline-warning">
                                        <i class="fas fa-cog me-2"></i>Admin Panel
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
