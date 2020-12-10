<?php
include "../app/app.php";
if(!isset($_SESSION) || !isset($_SESSION['idUser']) || $_SESSION['rol']=='2'){
	header("Location:../catalogo");
}
	/*if ($_SESSION['rol']==2) {
		header("Location: ../users");
	}*/
	include "../app/usersController.php";
	$usersController = new UserController();
	$users = $usersController->get();
	
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Users</title>
		<meta charset="utf-8">
	</head>
	<link rel="stylesheet" type="text/css" href="../assets/css/users.css?v=0.0.3" media="all">
	<body>
		<div class="main">
			<h1>Users</h1>
			<a href="../movies">
				Movies
			</a>
			<?php include "../layouts/alerts.template.php"; ?>	
			<div class="T">
				<table>
					<thead>
						<th>
							# Id
						</th>
						<th>
							Name
						</th>
						<th>
							Lastname
						</th>
						<th>
							Status
						</th>
						<th>
							Email
						</th>
						<th>
							Rol
						</th>
						<th>
							Actions
						</th>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
							<tr>
								<td>
									<?= $user['idUser'] ?>
								</td>
								<td>
									<?= $user['name'] ?>
								</td>
								<td>
									<?= $user['lastname'] ?>
								</td>
								<td>
									<?= $user['status'] ?>
								</td>
								<td>
									<?= $user['email'] ?>
								</td>
								<td>
									<?= $user['rol'] ?>
								</td>
								<td>
									<button onclick="edit('<?= $user['idUser'] ?>', '<?= $user['name'] ?>', '<?= $user['lastname'] ?>', '<?= $user['status'] ?>', '<?= $user['email'] ?>', '<?= $user['rol'] ?>')">
										Edit
									</button>
									<button onclick="remove(<?= $user['idUser'] ?>)">
										Delete
									</button>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="F">
				<form id="updateForm" action="../app/usersController.php" method="POST">
					<fieldset>
						<h2>
							Edit user
						</h2>
						<h3>
							Name
						</h3>
						<input type="text" name="name" placeholder="name" id="name">
						<br>
						<h3>
							Lastname
						</h3>
						<input type="text" name="lastname" required=""  id="lastname"> 
						<br>
						<h3>Status</h3>
						<select name="status" required="" id="status">
							<option>Active</option>
							<option>Inactive</option>
						</select>
						<br>
						<h3>Email </h3>
						<input type="text" name="email" placeholder="example@example.com" required="" id="email">
						<br>
						<h3>Rol</h3>
						<select name="rol" required="" id="rol">
							<option value="1">Admin</option>
							<option value="2">User</option>
						</select>
						<br>
						<button type="submit" id="btn">Save</button>
						<br>
						<input type="hidden" name="action" value="update">
						<input type="hidden" name="id" id="id">
					</fieldset>
				</form>
			</div>
			<form id="destroyForm" action="../app/usersController.php" method="POST">
				<input type="hidden" name="action" value="destroy">
				<input type="hidden" name="id" id="id_destroy">
			</form>	
		</div>
	</div>
	<form id="logout" method="POST" action="../app/authController.php" >
		<button type="submit">
			Logout
		</button>
		<input type="hidden" name="action" value="logout">
	</form>
	<script type="text/javascript">
		function edit(id, name,  lastname, status, email, rol){
			document.getElementById("id").value = id;
			document.getElementById("name").value = name;
			document.getElementById("lastname").value = lastname; 
			document.getElementById("status").value = status;
			document.getElementById("email").value = email;
			document.getElementById("rol").value = rol;
		}
		function remove(id){
			var confirm = prompt("¿Desea eliminar el registro? Escriba el id que desee eliminar: " + id);
			if (confirm == id) {
				document.getElementById('id_destroy').value = id;
				document.getElementById('destroyForm').submit();
			}
		}
	</script>
</body>
</html>