<?php 
	include "../app/app.php";
	include_once "connectionController.php";

	if (isset($_POST['action'])) {

		$usersController = new UserController();

		switch ($_POST['action']) {
			case 'update':
				$id = strip_tags($_POST['id']);
				$name = strip_tags($_POST['name']);
				$lastname = strip_tags($_POST['lastname']);
				$status = strip_tags($_POST['status']);
				$email = strip_tags($_POST['email']);
				$rol = strip_tags($_POST['rol']);
				

				$usersController->update($id, $name, $lastname, $status, $email, $rol);
				break;
			case 'destroy':
				$id = strip_tags($_POST['id']);
				$movieController->destroy($id);
				break;
		}
	}

	class UserController{

		public function get(){
			$conn = connect();
			if ($conn->connect_error==false) {
				$query = "select * from users";
				$prepared_query = $conn->prepare($query);
				$prepared_query->execute();

				$results = $prepared_query->get_result();
				$users = $results->fetch_all(MYSQLI_ASSOC);

				if (count($users)>0) {
					return $users;
				}else
				return array();
			}else
			return array();
		}

		
		public function update($id, $name, $lastname, $status, $email, $rol){
			$conn = connect();
			if ($conn->connect_error==false) {
				
				if ($id !="" && $name !="" && $lastname !="" && $status !="" && $email !="" && $rol !="") {
					$query = "update users set name = ?, lastname = ?, status = ?, email = ?, rol = ? where idUser = ?";
					$prepared_query = $conn->prepare($query);
					$prepared_query->bind_param('ssssii', $name, $lastname, $status, $email, $rol, $id);

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