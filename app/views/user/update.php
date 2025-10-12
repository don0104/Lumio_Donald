<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
  <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .card { max-width: 720px; margin: 24px auto; }
  </style>
</head>
<body>
  <div class="container py-3">
    <div class="d-flex align-items-center mb-3">
      <h2 class="me-auto mb-0">Update User</h2>
      <a href="<?= site_url('user/all') ?>" class="btn btn-outline-secondary">Back</a>
    </div>

    <div class="card p-3">
      <form method="post" action="<?= site_url('user/update/'. $user['id']) ?>" class="row g-3">
        <div class="col-md-6">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?= html_escape($user['username']) ?>" required>
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?= html_escape($user['email']) ?>" required>
        </div>
        <div class="col-12 d-flex justify-content-end gap-2">
          <a class="btn btn-outline-secondary" href="<?= site_url('user/all') ?>">Cancel</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
