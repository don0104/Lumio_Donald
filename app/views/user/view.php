<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
	<h2>User Lists</h2>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th>Email</th>
			<th>Created At</th>
			<th>Updated At</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach(html_escape($all) as $user): ?>
		<tr>
			<td><?=$user['id'];?></td>
			<td><?=$user['username'];?></td>
			<td><?=$user['email'];?></td>
			<td><?=$user['created_at'];?></td>
			<td><?=$user['updated_at'];?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php
	echo $page;?>
	</div>
</body>
</html>