<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        :root { 
            --bg: linear-gradient(135deg, #0b1020 0%, #1a1f3a 50%, #0f1419 100%);
            --card: linear-gradient(145deg, rgba(18,26,43,0.95), rgba(25,35,55,0.9));
            --muted: #99a3b3; 
            --text: #e6ebf2; 
            --accent: #4f80ff; 
            --accent-2: #ff5c5c; 
            --border: rgba(34,48,75,0.6);
            --success: #10b981;
            --warning: #f59e0b;
            --shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        
        * { box-sizing: border-box; }
        
        html, body { 
            height: 100%; 
            margin: 0; 
            padding: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(79,128,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,92,92,0.1) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }
        
        .container { 
            max-width: 1200px; 
            margin: 30px auto; 
            padding: 0 20px;
            animation: fadeInUp 0.6s ease-out;
        }
        
        .header { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            margin-bottom: 30px;
            padding: 20px 0;
        }
        
        .title { 
            font-size: 32px; 
            font-weight: 700;
            line-height: 1.2; 
            margin: 0; 
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, var(--accent), #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .add-user-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: linear-gradient(135deg, var(--accent), #6366f1);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79,128,255,0.3);
        }
        
        .add-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79,128,255,0.4);
        }
        
        .card { 
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px; 
            box-shadow: var(--shadow);
            overflow: hidden;
            backdrop-filter: blur(20px);
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }
        
        .table-wrap { 
            width: 100%; 
            overflow-x: auto;
            border-radius: 16px;
        }
        
        table { 
            width: 100%; 
            border-collapse: separate; 
            border-spacing: 0; 
            min-width: 700px;
        }
        
        thead th { 
            text-align: left; 
            font-weight: 600; 
            color: var(--muted); 
            background: linear-gradient(135deg, rgba(79,128,255,0.08), rgba(139,92,246,0.05));
            border-bottom: 2px solid var(--border); 
            padding: 18px 20px; 
            position: sticky; 
            top: 0; 
            backdrop-filter: blur(10px);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        tbody td { 
            padding: 18px 20px; 
            border-bottom: 1px solid rgba(34,48,75,0.3);
            transition: all 0.2s ease;
        }
        
        tbody tr { 
            transition: all 0.3s ease;
        }
        
        tbody tr:hover { 
            background: linear-gradient(135deg, rgba(79,128,255,0.08), rgba(139,92,246,0.05));
            transform: translateX(4px);
        }
        
        .badge { 
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #6366f1);
            color: white;
            font-size: 12px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(79,128,255,0.3);
        }
        
        .actions { 
            display: flex; 
            gap: 10px; 
            align-items: center; 
        }
        
        .btn { 
            display: inline-flex; 
            align-items: center; 
            gap: 6px; 
            padding: 10px 16px; 
            border-radius: 10px; 
            border: 1px solid var(--border); 
            background: rgba(22,35,59,0.8);
            color: var(--text); 
            text-decoration: none; 
            transition: all 0.3s ease; 
            font-size: 13px;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }
        
        .btn:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        
        .btn-edit { 
            border-color: rgba(79,128,255,0.4); 
            background: linear-gradient(135deg, rgba(79,128,255,0.15), rgba(99,102,241,0.1));
            color: #60a5fa;
        }
        
        .btn-edit:hover { 
            background: linear-gradient(135deg, rgba(79,128,255,0.25), rgba(99,102,241,0.2));
            box-shadow: 0 8px 20px rgba(79,128,255,0.3);
        }
        
        .btn-danger { 
            border-color: rgba(255,92,92,0.4); 
            background: linear-gradient(135deg, rgba(255,92,92,0.15), rgba(239,68,68,0.1));
            color: #f87171;
        }
        
        .btn-danger:hover { 
            background: linear-gradient(135deg, rgba(255,92,92,0.25), rgba(239,68,68,0.2));
            box-shadow: 0 8px 20px rgba(255,92,92,0.3);
        }
        
        .footer { 
            display: flex; 
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px; 
            color: var(--muted); 
            font-size: 13px;
            background: rgba(18,26,43,0.5);
            border-top: 1px solid var(--border);
        }
        
        .user-count {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
        }
        
        .user-count::before {
            content: '👥';
            font-size: 16px;
        }
        
        fieldset { 
            border: none;
            padding: 0;
            margin: 0;
        }
        
        legend { 
            color: var(--accent); 
            font-weight: 700; 
            font-size: 18px; 
            padding: 0 0 20px 0;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        legend::before {
            content: '⚡';
            font-size: 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        }
        
        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--muted);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @media (max-width: 768px) { 
            .container { padding: 0 16px; }
            .title { font-size: 24px; } 
            .header { flex-direction: column; gap: 20px; align-items: stretch; }
            .stats-grid { grid-template-columns: 1fr; }
            thead th, tbody td { padding: 12px 16px; }
            .actions { flex-direction: column; gap: 8px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">User Directory</h1>
            <a href="<?= site_url('user/create') ?>" class="add-user-btn">
                <span>+</span> Add New User
            </a>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= is_array($users) ? count($users) : 0; ?></div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= is_array($users) ? count($users) : 0; ?></div>
                <div class="stat-label">Active Users</div>
            </div>
           
        </div>
        
        <div class="card">
            <fieldset>
                <legend>User Management</legend>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (html_escape($users) as $user): ?>
                            <tr>
                                <td><span class="badge"><?= $user['id']; ?></span></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--accent), #6366f1); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                                            <?= strtoupper(substr($user['username'], 0, 1)); ?>
                                        </div>
                                        <span style="font-weight: 500;"><?= $user['username']; ?></span>
                                    </div>
                                </td>
                                <td><?= $user['email']; ?></td>
                                <td>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 20px; background: rgba(16,185,129,0.15); color: #10b981; font-size: 12px; font-weight: 500;">
                                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></span>
                                        Active
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-edit" href="<?= site_url('user/update/'.$user['id']); ?>">
                                            <span>✏️</span> Edit
                                        </a>
                                        <a class="btn btn-danger" href="<?= site_url('user/delete/'.$user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                                            <span>🗑️</span> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="footer">
                    <div class="user-count">Showing <?= is_array($users) ? count($users) : 0; ?> users</div>
                    <div style="color: var(--muted); font-size: 12px;">
                        Last updated: <?= date('M d, Y H:i'); ?>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</body>
</html>