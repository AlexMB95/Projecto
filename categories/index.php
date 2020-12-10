<?php 
	include "../app/categoryController.php";
	if(!isset($_SESSION) || !isset($_SESSION['idUser']) || $_SESSION['rol']=='2'){
		header("Location:../catalogo");
	}
	$categoryController = new CategoryController();
	
	$categories = $categoryController->get();

	#echo json_encode($categories);
	//Para que usuario no ingrese al apartado de agregar categorías
	//if (isset($_SESSION)==false || isset($_SESSION['idUser'])==1) {
		//header("Location: ../");
	//}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<style type="text/css">
		table, th, td{
			border: 1px solid black;
			border-collapse: collapse;
		}
		#updateForm{
			display: none;
		}
	</style>
</head>
<body>
	<form id="logout" method="POST" action="../app/authController.php" >
		<button type="submit">
			Logout
		</button>
		<input type="hidden" name="action" value="logout">
	</form>
	<div>
		<h1>Categories</h1>
		<?php include "../layouts/alerts.template.php"; ?>
		<table>
			<thead>
				<th>
					#
				</th>
				<th> 
					Name
				</th>
				<th>
					Description
				</th>
				<th>
					Status
				</th>
				<th>
					Actions
				</th>
			</thead>
			<tbody>

				<?php foreach ($categories as $category): ?>

					<tr>
						<td>
							<?= $category['idCategories']?>
						</td>
						<td>
							<?= $category['name']?>
						</td>
						<td>
							<?= $category['description']?>
						</td>
						<td>
							<?= $category['status']?>
						</td>
						<td>
							<button onclick="edit(<?= $category['idCategories'] ?>, '<?= $category['name']?>', '<?= $category['description']?>', '<?= $category['status']?>')" >
								Edit category
							</button>

							<button onclick="remove(<?= $category['idCategories']?>)" style="background-color: red; color: white;">
								Delete category
							</button>
						</td>
					</tr>	
				<?php endforeach ?>
			</tbody>
		</table>

		<form id="storeForm" action="../app/categoryController.php" method="POST">
			<fieldset>
				<legend>
					Add new category
				</legend>
				<label>
					Name
				</label>
				<input type="" name="name" placeholder="terror">
				<br>
				<label>
					Description
				</label>
				<textarea name="description" placeholder="Write here" rows="5" required=""></textarea>
				<br>
				<label>
					Status
				</label>
				<select name="status">
					<option>Active</option>
					<option>Inactive</option>
				</select>
				<br>
				<button type="submit">Save category</button>
				<input type="hidden" name="action" value="store">
			</fieldset>
		</form>


		<form id="updateForm" action="../app/categoryController.php" method="POST">
			<fieldset>
				<legend>
					Edit category
				</legend>
				<label>
					Name
				</label>
				<input type="" id="name" name="name" placeholder="terror">
				<br>
				<label>
					Description
				</label>
				<textarea id="description" name="description" placeholder="Write here" rows="5" required=""></textarea>
				<br>
				<label>
					Status
				</label>
				<select id="status" name="status">
					<option>Active</option>
					<option>Inactive</option>
				</select>
				<br>
				<button type="submit">Save category</button>
				<input type="hidden" name="action" value="update">
				<input type="hidden" name="id" id="id">
			</fieldset>
		</form>

		<form id="destroyForm" action="../app/categoryController.php" method="POST">
			<input type="hidden" name="action" value="destroy">
			<input type="hidden" name="id" id="id_destroy">
		</form>

	</div>
	<script type="text/javascript">
		function edit(id, name, description, status){
			document.getElementById('storeForm').style.display="none";
			document.getElementById('updateForm').style.display="block";
			document.getElementById('name').value = name;
			document.getElementById('description').value = description;
			document.getElementById('status').value = status;
			document.getElementById('id').value = id;
			/*alert("hola " + idCategories)
			alert("hola " + name)
			alert("hola " + description)
			alert("hola " + status)*/

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