<?php 
	include "../app/app.php";
	include "../app/movieController.php";
	if(!isset($_SESSION) || !isset($_SESSION['idUser'])){
		header("Location:../");
	}
	/*var_dump($_SESSION);*/
		if($_SESSION['rol']=='1'){
		header("Location:../users");
	}

	$movieController = new MovieController();
	$movies = $movieController->get(); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Ghiblix
	</title>
</head>

<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../assets/css/ui.css?v=0.0.6" media="all">
<body>

<!--Etiqueta en donde se enceuntra el parallax, tiulo e imagen -->
	<div class="hola2">

		<img src="../assets/img/logoo.png">

		<h2>
			Todas tus películas de studio ghibli en un solo sitio <br><br>

			<span>
				GHIBLIX
			</span>
		</h2>
	</div>


<!-- Etiqueta en donde se encuentra el slider de las peliculas top-->

	<div class="hola3" id="mirara">

		<!-- Cacda imagen va a contener su efecto hover con el nombre de la pelicula y simbolo de repoducir -->
		<div class="slider">
			<ul>
				<li>
					
						<img src="../assets/img/castillo.png">
					
					
				</li>
				<li>
					
						<img src="../assets/img/mononoke.jpg">
					
				</li>
				<li>
					
						<img src="../assets/img/setsuko.jpg">
				
				</li>
				<li>
					
						<img src="../assets/img/marnie.jpg">
					
					
				</li>
			</ul>
		</div>

	</div>

		
		<!-- Cacda imagen va a contener su efecto hover con el nombre de la pelicula y simbolo de repoducir -->
		




		<!--Catálogo de películas. Añadir estilo-->
		<div class="hola4" id="pelii">
			<h2 >
				<span> Peliculas </span> recomendadas
			</h2>
			<?php foreach ($movies as $movie): ?>
				<a href="#openModal<?= $movie['idMovies']?>">

					<div class="catalago">
						<ul>
							<li>
								<img src="../assets/img/movies/<?= $movie['cover']?>">
							</li>	
						</ul>	
					</div>
				</a>
			<?php endforeach ?>
		</div>
		<div class="fondo5">

		<div class="hola5">

	 	</div>

	 	<div class="frase">
	 		<h2>
	 			La inspiración desbloquea el futuro  <br><br>
	 			<span>
	 				<i> - Hayao Miyazaki - </i>
	 			</span>
	 		</h2>
	 	</div>
	</div>
	<div class="hola7">

	</div>

	<div class="hola8">
		
		<div class="fondo8">
			<img src="../assets/img/kawaii.jpeg">
		</div>


		<div class="fondo9">

			<a href="">
				<img src="../assets/img/logoo.png">
			</a>

			
			<h2>
				Disfruta tus películas solo en <br><br>  <span> GHIBLIX </span>
			</h2>

		</div>


	</div>

	<!-- Información de nosotros-->
<div class="hola9">
	<hr>

	<p>
		Integrantes:<br>
		Martínez Barrios, Alexis <br>
		Turrubiates Carrillo, Cinthya Josselyn
	</p>

	<label>
		© Matínez & Turrubiates |  <span> All rights reserved 2020 </span>
	</label>	
</div>

	<form id="logout" method="POST" action="../app/authController.php" >
		<button type="submit">
			Logout
		</button>
		<input type="hidden" name="action" value="logout">
	</form>
</body>
</html>