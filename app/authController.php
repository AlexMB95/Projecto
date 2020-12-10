<?php 

include "../app/app.php";
include_once "connectionController.php";

if (isset($_POST['action'])) {
	$authController = new AuthController();

	switch ($_POST['action']) {
		case 'register':

			$name = strip_tags($_POST['name']);
			$lastname = strip_tags($_POST['lastname']);
			$email= strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);
			$authController->register($name, $lastname, $email, $password);
			#var_dump($_POST);
		break;
		
		case 'login':
			$email= strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);
			$authController->access($email, $password);
		break;
		case 'logout':
			$authController->logout($email, $password);
			break;
	}
}

class AuthController{
	
	public function register($name, $lastname, $email, $password){
		$conn = connect();
		if (!$conn->connect_error) {

			if ($name != "" && $lastname !="" && $email != "" && $password != "") {
				$originalPassword = $password;
				$password = md5($password.'yamete_kudasai');
				$query = "insert into users (name, lastname, email, password) value (?,?,?,?)";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('ssss', $name, $lastname, $email, $password);

				if ($prepared_query->execute()) {
					//proceso de login. Mi novia es la más Hermosa. ♥w♥
					$this->access($email, $originalPassword);
				}else{
					
					$_SESSION['error'] = 'Verifique datos enviados.';
					header("Location: ". $_SERVER['HTTP_REFERER']);
				}
			}else{
				
				$_SESSION['error'] = 'Verifique la información del formulario';
			header("Location: ". $_SERVER['HTTP_REFERER']);
			}
		}else{
			$_SESSION['error'] = 'Verifique la conexión a la base de datos';
			header("Location: ". $_SERVER['HTTP_REFERER']);
		}
	}


	public  function access($email, $password){
		$conn = connect();
		if (!$conn->connect_error) {
			
			if ($email !="" && $password !="") {
				
				$password = md5($password.'yamete_kudasai'); 

				$query = "select * from users where email = ? and password = ?";
				$prepared_query = $conn->prepare($query);
				$prepared_query->bind_param('ss', $email, $password);
				
				if ($prepared_query->execute()) {
					$result = $prepared_query->get_result();
					$user = $result->fetch_all(MYSQLI_ASSOC);
					

					if (count($user)>0) {
						$user = array_pop($user);
						$_SESSION['idUser'] = $user['idUser'];
						$_SESSION['name'] = $user['name'];
						$_SESSION['email'] = $user['email'];
						$_SESSION['rol'] = $user['rol'];
						header("Location: ../catalogo");						
					}else{
						$_SESSION['error'] = 'Verifique datos enviados.';
						header("Location: ". $_SERVER['HTTP_REFERER']);
						//echo "1";
					}	

				}else{
					$_SESSION['error'] = 'Verifique datos enviados.';
					header("Location: ". $_SERVER['HTTP_REFERER']);
					//echo "2";
				}
			}else{
				$_SESSION['error'] = 'Verifique la información del formulario';
			header("Location: ". $_SERVER['HTTP_REFERER']);
			//echo "3";			
		}
		
		}else{
			$_SESSION['error'] = 'Verifique la conexión a la base de datos';
			header("Location: ". $_SERVER['HTTP_REFERER']);
			//echo "4";
		}		
	}

	public function logout(){
		session_destroy();
		header('Location: ../');
	}
}

?>