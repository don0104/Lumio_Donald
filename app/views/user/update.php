<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
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
            max-width: 600px; 
            margin: 40px auto; 
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
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: rgba(22,35,59,0.8);
            color: var(--text);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            backdrop-filter: blur(10px);
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            background: rgba(22,35,59,0.9);
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
        
        .card-header { 
            padding: 24px 30px; 
            border-bottom: 1px solid var(--border);
            background: rgba(18,26,43,0.5);
        }
        
        .card-title { 
            margin: 0; 
            font-size: 20px; 
            font-weight: 600;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-title::before {
            content: '✏️';
            font-size: 24px;
        }
        
        form { 
            padding: 30px; 
            display: grid; 
            gap: 24px; 
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        label { 
            font-size: 14px; 
            color: var(--muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        input[type="text"], input[type="email"] { 
            width: 100%; 
            padding: 16px 20px; 
            border-radius: 12px; 
            border: 2px solid var(--border); 
            background: rgba(22,35,59,0.8);
            color: var(--text); 
            outline: none; 
            transition: all 0.3s ease;
            font-size: 16px;
            backdrop-filter: blur(10px);
        }
        
        input[type="text"]:focus, input[type="email"]:focus { 
            border-color: var(--accent); 
            box-shadow: 0 0 0 4px rgba(79,128,255,0.15);
            background: rgba(22,35,59,0.9);
            transform: translateY(-2px);
        }
        
        .helper { 
            font-size: 12px; 
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .helper::before {
            content: '💡';
            font-size: 14px;
        }
        
        .actions { 
            display: flex; 
            gap: 12px; 
            justify-content: space-between; 
            padding: 20px 30px 30px;
            background: rgba(18,26,43,0.3);
            border-top: 1px solid var(--border);
        }
        
        .btn { 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            padding: 14px 24px; 
            border-radius: 12px; 
            border: 1px solid var(--border); 
            background: rgba(22,35,59,0.8);
            color: var(--text); 
            text-decoration: none; 
            cursor: pointer; 
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }
        
        .btn:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        
        .btn-primary { 
            border-color: var(--accent);
            background: linear-gradient(135deg, var(--accent), #6366f1);
            color: white;
            box-shadow: 0 4px 15px rgba(79,128,255,0.3);
        }
        
        .btn-primary:hover { 
            background: linear-gradient(135deg, #5a8cff, #7c3aed);
            box-shadow: 0 8px 25px rgba(79,128,255,0.4);
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
        
        .form-icon {
            position: relative;
        }
        
        .form-icon::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-size: contain;
            z-index: 1;
        }
        
        .form-icon input {
            padding-left: 50px;
        }
        
        .username-icon::before {
            content: '👤';
            font-size: 16px;
        }
        
        .email-icon::before {
            content: '📧';
            font-size: 16px;
        }
        
        .user-info {
            background: rgba(79,128,255,0.1);
            border: 1px solid rgba(79,128,255,0.2);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
        }
        
        .user-details h3 {
            margin: 0;
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
        }
        
        .user-details p {
            margin: 4px 0 0 0;
            color: var(--muted);
            font-size: 14px;
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
            .actions { flex-direction: column; }
            .btn { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Update User</h1>
            <a href="<?= site_url('/') ?>" class="back-btn">
                <span>←</span> Back to Users
            </a>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Edit User Information</h2>
            </div>
            
            <div class="user-info">
                <div class="user-avatar">
                    <?= strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                <div class="user-details">
                    <h3><?= html_escape($user['username']) ?></h3>
                    <p>User ID: #<?= $user['id'] ?></p>
                </div>
            </div>
            
            <form method="post" action="<?= site_url('user/update/'. $user['id']) ?>">
                <div class="form-group form-icon username-icon">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= html_escape($user['username']) ?>" placeholder="Enter username" required>
                </div>
                
                <div class="form-group form-icon email-icon">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?= html_escape($user['email']) ?>" placeholder="Enter email address" required>
                    <div class="helper">Update the user's email address.</div>
                </div>
                
                <div class="actions">
                    <a class="btn btn-danger" href="<?= site_url('/') ?>">
                        <span>✕</span> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span>💾</span> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>