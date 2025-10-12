<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User</title>
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
    
    .main-container {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border: 1px solid #e2e8f0;
      width: 100%;
      max-width: 600px;
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
    
    .form-control {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 0.9rem;
      background: #ffffff;
      transition: all 0.3s ease;
      color: #2d3748;
    }
    
    .form-control:focus {
      outline: none;
      border-color: #3182ce;
      box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
    }
    
    .form-control::placeholder {
      color: #a0aec0;
    }
    
    .btn-create {
      background: linear-gradient(135deg, #3182ce 0%, #2c5aa0 100%);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-right: 0.5rem;
    }
    
    .btn-create:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(49, 130, 206, 0.3);
    }
    
    .btn-cancel {
      background: #6b7280;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 0.75rem 1.5rem;
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .btn-cancel:hover {
      background: #4b5563;
      color: white;
      text-decoration: none;
      transform: translateY(-1px);
    }
    
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 0.5rem;
      margin-top: 2rem;
    }
    
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
      
      .form-actions {
        flex-direction: column;
      }
      
      .btn-create,
      .btn-cancel {
        width: 100%;
        margin-right: 0;
        margin-bottom: 0.5rem;
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
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="header-title">
          <h1>Create User</h1>
          <p>Add a new user to the system</p>
        </div>
      </div>
      <a href="<?= site_url('user/all') ?>" class="btn-back">
        <i class="fas fa-arrow-left me-1"></i>
        Back to User List
      </a>
    </div>
    
    <!-- Content -->
    <div class="page-content">
      <div class="welcome-section">
        <h2>Create New User</h2>
        <p>Fill in the details to create a new user account</p>
      </div>
      
      <form method="post" action="<?= site_url('user/create') ?>">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
            </div>
          </div>
        </div>
        
        <div class="form-actions">
          <a href="<?= site_url('user/all') ?>" class="btn-cancel">Cancel</a>
          <button type="submit" class="btn-create">
            <i class="fas fa-user-plus me-1"></i>
            Create User
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
