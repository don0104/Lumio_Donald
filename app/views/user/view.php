<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="icon" href="<?= base_url(); ?>favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .table { font-size: 0.95rem; }
        .search-loading { opacity: 0.6; }
        .no-results { text-align: center; padding: 2rem; color: #6c757d; }
    </style>
</head>
<body>
	<div class="container mt-3 ">
	<!-- Real-time Search Form -->
	<div class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input id="searchInput" class="form-control me-2" type="text" placeholder="Search users..." value="<?=html_escape($q);?>" autocomplete="off">
        <button id="searchBtn" class="btn btn-primary" type="button">Search</button>
	</div>
	<div class="d-flex align-items-center mb-2">
		<h2 class="me-auto mb-0">User Lists</h2>
		<a href="<?=site_url('user/create');?>" class="btn btn-primary">+ Create User</a>
	</div>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th class="text-end">Actions</th>
		</tr>
		</thead>
		<tbody id="userTableBody">
		<?php foreach(html_escape($all) as $user): ?>
		<tr>
			<td><?=$user['id'];?></td>
			<td><?=$user['username'];?></td>
			<td><?=$user['email'];?></td>
			<td class="text-end">
				<a href="<?=site_url('user/update/'.$user['id']);?>" class="btn btn-sm btn-primary me-1">Edit</a>
				<a href="<?=site_url('user/delete/'.$user['id']);?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete user #<?=$user['id'];?>?');">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
	echo $page;?>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		// Real-time Search Implementation
		document.addEventListener('DOMContentLoaded', function() {
			const searchInput = document.getElementById('searchInput');
			const searchBtn = document.getElementById('searchBtn');
			const tableBody = document.getElementById('userTableBody');
			let searchTimeout;

			// Debounce function to prevent too many requests
			function debounce(func, wait) {
				return function executedFunction(...args) {
					const later = () => {
						clearTimeout(searchTimeout);
						func(...args);
					};
					clearTimeout(searchTimeout);
					searchTimeout = setTimeout(later, wait);
				};
			}

			// Function to perform search
			function performSearch(query) {
				if (query.length === 0) {
					// If empty, reload the page to show all users
					window.location.href = '<?=site_url('user/all');?>';
					return;
				}

				// Show loading state
				tableBody.classList.add('search-loading');
				
				// Make AJAX request
				fetch(`<?=site_url('user/search_ajax');?>?q=${encodeURIComponent(query)}`, {
					method: 'GET',
					headers: {
						'X-Requested-With': 'XMLHttpRequest',
						'Content-Type': 'application/json'
					}
				})
				.then(response => response.json())
				.then(data => {
					tableBody.classList.remove('search-loading');
					
					if (data.success) {
						updateTable(data.data);
					} else {
						showNoResults();
					}
				})
				.catch(error => {
					tableBody.classList.remove('search-loading');
					console.error('Search error:', error);
					showNoResults('Error occurred while searching');
				});
			}

			// Update table with search results
			function updateTable(users) {
				if (users.length === 0) {
					showNoResults();
					return;
				}

				let html = '';
				users.forEach(user => {
					html += `
						<tr>
							<td>${user.id}</td>
							<td>${user.username}</td>
							<td>${user.email}</td>
							<td class="text-end">
								<a href="<?=site_url('user/update');?>/${user.id}" class="btn btn-sm btn-primary me-1">Edit</a>
								<a href="<?=site_url('user/delete');?>/${user.id}" class="btn btn-sm btn-danger" onclick="return confirm('Delete user #${user.id}?');">Delete</a>
							</td>
						</tr>
					`;
				});
				tableBody.innerHTML = html;
			}

			// Show no results message
			function showNoResults(message = 'No users found') {
				tableBody.innerHTML = `
					<tr>
						<td colspan="4" class="no-results">${message}</td>
					</tr>
				`;
			}

			// Debounced search function
			const debouncedSearch = debounce(performSearch, 300);

			// Event listeners
			searchInput.addEventListener('input', function() {
				const query = this.value.trim();
				debouncedSearch(query);
			});

			searchBtn.addEventListener('click', function() {
				const query = searchInput.value.trim();
				performSearch(query);
			});

			// Allow Enter key to trigger search
			searchInput.addEventListener('keypress', function(e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					const query = this.value.trim();
					performSearch(query);
				}
			});
		});
	</script>
</body>
</html>