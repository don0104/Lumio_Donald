<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Directory</title>
  <style>
    :root {
      --bg: #0f1419;
      --card: #1c2431;
      --muted: #99a3b3;
      --text: #e6ebf2;
      --accent: #4f80ff;
      --border: rgba(255,255,255,0.08);
      --shadow: 0 6px 20px rgba(0,0,0,0.4);
      --radius: 12px;
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: Inter, system-ui, Segoe UI, Roboto, Arial, sans-serif;
      background: var(--bg);
      color: var(--text);
      padding: 20px;
    }
    .container { max-width: 1200px; margin: auto; }

    /* HEADER */
    .header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 24px;
    }
    .title {
      font-size: 28px;
      font-weight: 700;
      color: var(--accent);
      margin: 0;
    }
    .actions-top {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      flex: 1;
      justify-content: flex-end;
    }
    .add-user-btn {
      padding: 10px 16px;
      background: var(--accent);
      color: #fff;
      border-radius: var(--radius);
      text-decoration: none;
      font-weight: 600;
      box-shadow: var(--shadow);
      transition: 0.2s;
    }
    .add-user-btn:hover { opacity: 0.9; }
    .search-group {
      display: flex;
      gap: 8px;
    }
    .search-group input {
      padding: 10px 12px;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      background: #131a23;
      color: var(--text);
    }
    .search-group button {
      padding: 10px 16px;
      background: var(--accent);
      border: none;
      border-radius: var(--radius);
      color: #fff;
      cursor: pointer;
      transition: 0.2s;
    }
    .search-group button:hover { opacity: 0.9; }

    /* STATS */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-bottom: 20px;
    }
    .stat-card {
      background: var(--card);
      border: 1px solid var(--border);
      padding: 20px;
      border-radius: var(--radius);
      text-align: center;
      box-shadow: var(--shadow);
    }
    .stat-number { font-size: 24px; font-weight: 700; color: #fff; }
    .stat-label { font-size: 13px; color: var(--muted); }

    /* TABLE */
    .card {
      background: var(--card);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
      overflow: hidden;
    }
    .card legend {
      font-weight: 600;
      padding: 12px 16px;
      background: #141b26;
      border-bottom: 1px solid var(--border);
      color: var(--accent);
    }
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; min-width: 600px; }
    thead th {
      text-align: left;
      padding: 12px;
      font-size: 13px;
      color: var(--muted);
      border-bottom: 1px solid var(--border);
      text-transform: uppercase;
    }
    tbody td {
      padding: 12px;
      border-bottom: 1px solid var(--border);
    }
    tbody tr:hover { background: rgba(79,128,255,0.05); }
    .actions a {
      margin-right: 8px;
      color: var(--accent);
      text-decoration: none;
      font-weight: 500;
    }
    .footer {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 8px;
      font-size: 12px;
      padding: 12px 16px;
      color: var(--muted);
      border-top: 1px solid var(--border);
      background: #141b26;
    }

    /* MOBILE: table to cards */
    @media (max-width: 768px) {
      .header { flex-direction: column; align-items: stretch; }
      .actions-top { justify-content: center; }
      table { min-width: 0; border: none; }
      thead { display: none; }
      tbody tr {
        display: block;
        margin-bottom: 12px;
        border-radius: var(--radius);
        background: #141b26;
        padding: 8px 0;
      }
      tbody td {
        display: block;
        padding: 10px 16px;
        border-bottom: none;
        position: relative;
      }
      tbody td::before {
        content: attr(data-label);
        display: block;
        font-size: 12px;
        color: var(--muted);
        margin-bottom: 4px;
        font-weight: 600;
      }
      .actions { display: flex; gap: 10px; padding: 8px 16px; }
    }

    /* PAGINATION STYLES */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin-top: 20px;
      padding: 20px;
    }
    
    .pagination a, .pagination span {
      padding: 8px 12px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      border: 1px solid var(--border);
      color: var(--text);
      background-color: var(--card);
    }
    
    .pagination a:hover {
      background-color: var(--accent);
      color: white;
      border-color: var(--accent);
    }
    
    .pagination .active {
      background-color: var(--accent);
      color: white;
      border-color: var(--accent);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1 class="title">User Directory</h1>
      <div class="actions-top">
        <a href="<?= site_url('user/create') ?>" class="add-user-btn">+ Add User</a>
        <form class="search-group" method="get" action="<?= site_url('user/all') ?>">
          <input name="q" type="text" placeholder="Search" value="<?= html_escape($this->io->get('q') ?? '') ?>">
          <button type="submit">Search</button>
        </form>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-number"><?= isset($total_rows) ? $total_rows : (is_array($all) ? count($all) : 0); ?></div>
        <div class="stat-label">Total Users</div>
      </div>
      <div class="stat-card">
        <div class="stat-number"><?= is_array($all) ? count($all) : 0; ?></div>
        <div class="stat-label">Showing</div>
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
              <?php if (isset($all) && is_array($all) && !empty($all)): ?>
                <?php foreach (html_escape($all) as $user): ?>
                <tr>
                  <td data-label="ID"><?= $user['id']; ?></td>
                  <td data-label="Username"><?= $user['username']; ?></td>
                  <td data-label="Email"><?= $user['email']; ?></td>
                  <td data-label="Status">
                    <span style="color:#10b981;font-weight:600;">Active</span>
                  </td>
                  <td data-label="Action">
                    <div class="actions">
                      <a href="<?= site_url('user/update/'.$user['id']); ?>">✏️ Edit</a>
                      <a href="<?= site_url('user/delete/'.$user['id']); ?>" onclick="return confirm('Are you sure?');">🗑️ Delete</a>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="text-align: center; padding: 40px; color: #666;">
                    No users found
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <div class="footer">
          <div>Showing <?= is_array($all) ? count($all) : 0; ?> of <?= isset($total_rows) ? $total_rows : 0; ?> users</div>
          <div>Last updated: <?= date('M d, Y H:i'); ?></div>
        </div>
      </fieldset>
    </div>
  </div>
  <?php echo $page; ?>
</body>
</html>
