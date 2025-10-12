<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Users</title>
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
    <link rel="shortcut icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🔥</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table { font-size: 0.95rem; }
        .no-results { text-align: center; padding: 2rem; color: #6c757d; }
    </style>
    </head>
<body>
    <div class="container mt-3 ">
        <div class="d-flex align-items-center mb-2">
            <h2 class="me-auto mb-0">Auth Users (auth_users)</h2>
        </div>
        <div class="col-sm-4 float-end d-flex mb-2">
            <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
            <input id="searchInput" class="form-control me-2" type="text" placeholder="Search auth users..." value="<?=html_escape($q);?>" autocomplete="off">
            <button id="searchBtn" class="btn btn-primary" type="button">Search</button>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody id="authUserTableBody">
            <?php if (!empty($all)): ?>
                <?php foreach(html_escape($all) as $auser): ?>
                <tr>
                    <td><?=$auser['id'];?></td>
                    <td><?=$auser['username'];?></td>
                    <td><?=$auser['email'];?></td>
                    <td><?= isset($auser['role']) ? $auser['role'] : 'user'; ?></td>
                    <td><?= isset($auser['created_at']) ? $auser['created_at'] : ''; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="no-results">No auth users found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php echo $page; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const tableBody = document.getElementById('authUserTableBody');

            function performSearch(query) {
                const url = '<?=site_url('auth_users/all');?>?q=' + encodeURIComponent(query);
                window.location.href = url;
            }

            searchBtn.addEventListener('click', function() {
                performSearch(searchInput.value.trim());
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    performSearch(searchInput.value.trim());
                }
            });
        });
    </script>
</body>
</html>


