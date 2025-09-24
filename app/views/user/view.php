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
    </style>
</head>
<body>
	<div class="container mt-3 ">
	<form action="<?=site_url('user/all');?>" method="get" class="col-sm-4 float-end d-flex">
		<?php
		$q = '';
		if(isset($_GET['q'])) {
			$q = $_GET['q'];
		}
		?>
        <input class="form-control me-2" name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
        <button type="submit" class="btn btn-primary" type="button">Search</button>
	</form>
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
		<tbody>
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
</body>
</html>