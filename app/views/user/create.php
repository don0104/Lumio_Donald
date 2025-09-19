<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
  <style>
    :root {
      --bg:#0b1020;
      --card:#121827;
      --muted:#99a3b3;
      --text:#e6ebf2;
      --accent:#4f80ff;
    }
    body {
      margin:0;
      font-family:Inter,system-ui,Segoe UI,Roboto,Arial;
      background:linear-gradient(135deg,#0b1020,#111827);
      color:var(--text);
    }
    .container {
      max-width:760px;
      margin:30px auto;
      padding:20px;
    }
    .header {
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }
    .title {
      font-size:26px;
      font-weight:700;
      margin:0;
      color:var(--accent);
    }
    .back-btn {
      color:var(--muted);
      text-decoration:none;
      font-size:14px;
    }
    .back-btn span {margin-right:6px;}
    .card {
      background:linear-gradient(145deg,rgba(18,26,43,0.9),rgba(20,30,50,0.8));
      padding:20px;
      border-radius:12px;
      border:1px solid rgba(255,255,255,0.05);
    }
    .card-title {
      font-size:18px;
      margin:0 0 16px;
      color:var(--text);
    }
    form {
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:14px;
    }
    label {
      font-size:13px;
      color:var(--muted);
      margin-bottom:6px;
      display:block;
    }
    input {
      width:100%;
      padding:10px;
      border-radius:8px;
      border:1px solid rgba(255,255,255,0.08);
      background:transparent;
      color:var(--text);
    }
    .helper {
      font-size:11px;
      color:var(--muted);
      margin-top:4px;
    }
    .actions {
      grid-column:1 / -1;
      display:flex;
      justify-content:flex-end;
      gap:12px;
      margin-top:10px;
    }
    .btn {
      padding:10px 14px;
      border-radius:8px;
      font-weight:600;
      cursor:pointer;
      font-size:14px;
    }
    .btn-primary {
      background:linear-gradient(135deg,var(--accent),#6366f1);
      color:white;
      border:none;
    }
    .btn-secondary {
      background:transparent;
      border:1px solid rgba(255,255,255,0.08);
      color:var(--muted);
    }
    @media(max-width:768px) {
      form {grid-template-columns:1fr;}
      .actions {flex-direction:column;}
      .btn {width:100%;}
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1 class="title">Create New User</h1>
      <a href="<?= site_url('/') ?>" class="back-btn">
        <span>←</span> Back to Users
      </a>
    </div>

    <div class="card">
      <h2 class="card-title">User Information</h2>

      <form method="post" action="<?= site_url('user/create') ?>">
        <div>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter username" required>
        </div>

        <div>
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="Enter email address" required>
          <div class="helper">We'll never share your email with anyone else.</div>
        </div>

        <div class="actions">
          <a href="<?= site_url('/') ?>" class="btn btn-secondary">✕ Cancel</a>
          <button type="submit" class="btn btn-primary">✓ Create User</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
