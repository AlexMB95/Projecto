<?php
include "../app/categoryController.php";
include "../app/movieController.php";
if(!isset($_SESSION) || !isset($_SESSION['idUser']) || $_SESSION['rol']=='2'){
	header("Location:../catalogo");
}
$categoryController = new CategoryController();
$movieController = new MovieController();

$categories = $categoryController->get();
$movies = $movieController->get();
?>
<!DOCTYPE html>
<html>
<head>
	<title>MOVIES</title>
	<meta charset="utf-8">
</head>
<link rel="stylesheet" type="text/css" href="../assets/css/movies.css?v=0.0.16" media="all">


<body>
	<div class="pelis">
		<h1>Movies</h1>
		<a href="../users">
			Users
		</a>
		
		<?php include "../layouts/alerts.template.php"; ?>	
		<div class="T">
			<table>
				<thead>
					<th>
						# Id
					</th>
					<th>
						Title
					</th>
					<th>
						Cover
					</th>
					<th>
						Duration
					</th>
					<th>
						Category
					</th>
					<th>
						Clasification
					</th>
					<th>
						Actions
					</th>
				</thead>
				<tbody>
					<?php foreach ($movies as $movie): ?>
						<tr>
							<td>
								<?= $movie['idMovies'] ?>
							</td>
							<td>
								<?= $movie['title'] ?>
							</td>
							<td>
								<img src="../assets/img/movies/<?= $movie['cover']?>">
							</td>
							<td>
								<?= $movie['minutes'] ?> minutes
							</td>
							<td>
								<?= $movie['idCategories'] ?>
							</td>
							<td>
								<?= $movie['clasification'] ?>
							</td>
							<td>
								<button onclick="edit(<?= $movie['idMovies'] ?>, '<?= $movie['title']?>', '<?= $movie['minutes']?>', '<?= $movie['idCategories']?>', '<?= $movie['clasification'] ?>','<?= $movie['description']?>')">
									Edit
								</button>
								<button onclick="remove(<?= $movie['idMovies'] ?>)">
									Delete
								</button>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>	
		<div class="F">
			<form id="storeForm" action="../app/movieController.php" method="POST" enctype="multipart/form-data" style="height: 100px;">
				<fieldset>
					<h2>
						Add movie
					</h2>
					<h3>
						Title
					</h3>
					<input type="text" name="title" placeholder="Movie name" id="title">
					<br>
					<h3>Cover</h3>
					<input type="file" name="cover" required="" accept="image/*" id="cover"> 
					<br>	
					<h3>Minutes </h3>
					<input type="number" name="minutes" placeholder="80" required="" id="min">
					<br>
					<h3>Category</h3>
					<select name="idCategories" required="" id="cat">

						<?php foreach ($categories as $category): ?>
							<option value="<?= $category['idCategories'] ?>"><?= $category['name'] ?></option>
						<?php endforeach ?>

					</select>
					<br>
					<h3>Clasification</h3>
					<select name="clasification" required="" id="clas">
						<option>A</option>
						<option>AA</option>
						<option>B</option>
						<option>B15</option>
						<option>C</option>
						<option>D</option>
					</select>
					<br>
					<h3>
						Description
					</h3>
					<textarea name="description" rows="5" placeholder="Description" id="desc"></textarea>
					<br>
					<br>
					<button type="submit" id="btn1">Save</button>
					<br>
					<input type="hidden" name="action" value="store">
				</fieldset>
			</form>

			<form id="updateForm" action="../app/movieController.php" method="POST" enctype="multipart/form-data">
				<fieldset>
					<h2>
						Edit movie
					</h2>
					<h3>
						Title
					</h3>
					<input type="text" name="title" placeholder="Movie name" id="title2">
					<br>
					<h3>
						Cover
					</h3>
					<input type="file" name="cover" required="" accept="image/*" id="cover2"> 
					<br>
					<h3>Minutes </h3>
					<input type="number" name="minutes" placeholder="80" required="" id="minutes2">
					<br>
					<h3>Category</h3>
					<select name="idCategories" required="" id="category2">

						<?php foreach ($categories as $category): ?>
							<option value="<?= $category['idCategories'] ?>"><?= $category['name'] ?></option>
						<?php endforeach ?>

					</select>
					<br>
					<h3>Clasification</h3>
					<select name="clasification" required="" id="clasification2">
						<option>A</option>
						<option>AA</option>
						<option>B</option>
						<option>B15</option>
						<option>C</option>
						<option>D</option>
					</select>
					<br>
					<h3>
						Description
					</h3>
					<textarea name="description" rows="5" placeholder="Description" id="description2"></textarea>
					<br>	
					<br>
					<button type="submit" id="btn2">Save</button>
					<br>
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="id" id="id">
				</fieldset>
			</form>
		</div>
		
		<form id="destroyForm" action="../app/movieController.php" method="POST">
			<input type="hidden" name="action" value="destroy">
			<input type="hidden" name="id" id="id_destroy">
		</form>	
	</div>
	<form id="logout" method="POST" action="../app/authController.php" >
		<button type="submit">
			Logout
		</button>
		<input type="hidden" name="action" value="logout">
	</form>
	<script type="text/javascript">
		function edit(id, title2,  minutes, category, clasification, description){
			document.getElementById("storeForm").style.display="none";
			document.getElementById("updateForm").style.display="block";
			document.getElementById("id").value = id;
			document.getElementById("title2").value = title2;
			document.getElementById("minutes2").value = minutes; 
			document.getElementById("category2").value = category;
			document.getElementById("clasification2").value = clasification;
			document.getElementById("description2").value = description;
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