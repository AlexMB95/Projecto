<?php 
	include "../app/app.php";
	include_once "connectionController.php";

	if (isset($_POST['action'])) {

		$movieController = new MovieController();

		switch ($_POST['action']) {
			case 'store':
				$title = strip_tags($_POST['title']);
				$description = strip_tags($_POST['description']);
				$minutes = strip_tags($_POST['minutes']);
				$clasification = strip_tags($_POST['clasification']);
				$idCategories = strip_tags($_POST['idCategories']);

				$movieController->store($title, $description, $minutes, $clasification, $idCategories);

				//var_dump($_POST);
			break;
			case 'update':
				$title = strip_tags($_POST['title']);
				$description = strip_tags($_POST['description']);
				$minutes = strip_tags($_POST['minutes']);
				$clasification = strip_tags($_POST['clasification']);
				$idCategories = strip_tags($_POST['idCategories']);
				$id = strip_tags($_POST['id']);

				$movieController->update($id, $title, $description, $minutes, $clasification, $idCategories);
				break;
			case 'destroy':
				$id = strip_tags($_POST['id']);
				$movieController->destroy($id);
				break;
		}
	}

	class MovieController{

		public function get(){
			$conn = connect();
			if ($conn->connect_error==false) {
				$query = "select * from movies";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$movies = $results->fetch_all(MYSQLI_ASSOC);

				if (count($movies )>0) {
					return $movies;
				}else
				return array();
			}else
			return array();
		}

		public function store($title, $description, $minutes, $clasification, $idCategories){
			
			$conn = connect();
			if ($conn->connect_error==false) {
				
				if ($title !="" && $description !="" && $minutes !="" && $clasification !="" && $idCategories !="") {
					
					//echo "1";
					//Subir archivo cover
					$target_path = "../assets/img/movies/";
					$original_name = basename($_FILES['cover']['name']);
					$new_file_name = $target_path.basename($_FILES['cover']['name']);
					if (move_uploaded_file($_FILES['cover']['tmp_name'], $new_file_name)) {
						$query = "insert into movies (title, description, minutes, cover, clasification, idCategories) values (?,?,?,?,?,?)";
						$prepared_query = $conn->prepare($query);
						$prepared_query->bind_param('ssissi', $title, $description, $minutes, $original_name, $clasification, $idCategories);

						if ($prepared_query->execute()) {
							$_SESSION['success'] = 'El registro se ha guardado correctamente.';
							header("Location: ". $_SERVER['HTTP_REFERER']);
						}else{
							$_SESSION['error'] = 'Verifique los datos enviados.';
							header("Location: ". $_SERVER['HTTP_REFERER']);
						}
					}
					echo $new_file_name;
					//basename($_FILES['cover']['name']);


				}else{
					$_SESSION['error'] = 'Verifique la información del formulario.';
				header("Location: ". $SERVER['HTTP_REFERER']);
				}

			}else{
				$_SESSION['error'] = 'Verifique la conexión a la Base de Datos.';
				header("Location: ". $SERVER['HTTP_REFERER']);
			}
		}
		public function update($id, $title, $description, $minutes, $clasification, $idCategories){
			$conn = connect();
			if ($conn->connect_error==false) {
				
				if ($id !="" && $title !="" && $description !="" && $minutes !="" && $clasification !="" && $idCategories !="") {
					$query = "update movies set title = ?, description = ?, clasification = ?, minutes = ?, idCategories = ? where idMovies = ?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('sssiii', $title, $description, $clasification, $minutes, $idCategories, $id);

					if ($prepared_query->execute()) {
						//echo "1";
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}else{
						//echo "2";
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}
				}else{
					//echo "3";
					header("Location: ".$_SERVER['HTTP_REFERER']);
				}
			}else{
				//echo "4";
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
		}

		public function destroy($id){
			$conn = connect();
			
			if ($conn->connect_error==false) {
					
				if ($id!="") {
					$query = "delete from movies where idMovies = ?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('i',$id);

					if ($prepared_query->execute()) {
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}else{
						header("Location: ".$_SERVER['HTTP_REFERER']);
					}
				}else{
					header("Location: ".$_SERVER['HTTP_REFERER']);
				}
			}else{
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
		}
	}
?>