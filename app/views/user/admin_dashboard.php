<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?= config_item('base_url') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .admin-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); }
        .stat-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('user/admin_dashboard') ?>">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('user/dashboard'); ?>">
                        <i class="fas fa-user me-1"></i>User Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('auth/logout'); ?>">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card admin-card stat-card">
                    <div class="card-body p-4">
                        <h2><i class="fas fa-crown me-2"></i>Admin Dashboard</h2>
                        <p class="mb-0">Welcome back, <?= $user['first_name'] ?>! Manage your system from here.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card admin-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3><?= $total_users ?></h3>
                        <p class="text-muted">Total Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card admin-card text-center">
                    <div class="card-body">
                        <i class="fas fa-user-shield fa-3x text-success mb-3"></i>
                        <h3>1</h3>
                        <p class="text-muted">Administrators</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card admin-card text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                        <h3><?= date('H:i') ?></h3>
                        <p class="text-muted">Current Time</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card admin-card text-center">
                    <div class="card-body">
                        <i class="fas fa-calendar fa-3x text-info mb-3"></i>
                        <h3><?= date('M j') ?></h3>
                        <p class="text-muted">Today</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card admin-card">
                    <div class="card-header">
                        <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?= site_url('user/all'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-users-cog me-2"></i>Manage Users
                            </a>
                            <a href="<?= site_url('user/all'); ?>" class="btn btn-outline-info">
                                <i class="fas fa-list me-2"></i>View All Users
                            </a>
                            <a href="<?= site_url('user/create'); ?>" class="btn btn-outline-success">
                                <i class="fas fa-user-plus me-2"></i>Add New User
                            </a>
                            <a href="<?= site_url('user/register'); ?>" class="btn btn-outline-danger">
                                <i class="fas fa-user-shield me-2"></i>Add Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card admin-card">
                    <div class="card-header">
                        <h5><i class="fas fa-users me-2"></i>Recent Users</h5>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($recent_users)): ?>
                            <?php foreach ($recent_users as $recent_user): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong><?= $recent_user['username'] ?></strong><br>
                                        <small class="text-muted"><?= $recent_user['email'] ?></small>
                                    </div>
                                    <span class="badge bg-<?= $recent_user['role'] === 'admin' ? 'danger' : 'primary' ?>">
                                        <?= ucfirst($recent_user['role']) ?>
                                    </span>
                                </div>
                                <hr class="my-2">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No recent users</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
