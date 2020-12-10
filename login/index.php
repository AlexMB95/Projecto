<?php 	
include "../app/app.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<link rel="stylesheet" type="text/css" href="../assets/css/login.css?v=0.0.21" media="all">
<body>
	<?php include "../layouts/alerts.template.php"; ?>
<!----------Fondo---------->
<div class="fondo">
	<img src="../assets/img/fondo1.jpg">
</div>
<!----------Login---------->
<div class="iniciar">	
		
	<form action="../app/authController.php" method="POST" id="loginForm">
		<fieldset >
			<h2>
				Access in your account
			</h2>
			<h3>
				Email
			</h3>
			<input type="email" name="email" required="" placeholder="example@example.com" id="user">
			<h3>
				Password
			</h3>
			<input type="password" name="password" required="" placeholder="* * * * *" id="pass">
			<br><br>
			
			<br><br>
			<button type="submit" id="btn">
				Access
			</button>

			<button type="" id="btn2" onclick="registrar();">
				¿No tienes cuenta? Regístrate ahora.
			</button>

			<input type="hidden" name="action" value="login">
		</fieldset>
	</form>	
</div>

<!----------Registro---------->

	<form method="POST" action="../app/authController.php" id="registerForm">
		<fieldset >
			<h2>
				Register
			</h2>
			<h3>
				Name
			</h3>
			<input type="text" name="name" required="" id="name" placeholder="Name">
			<h3>
				Lastname
			</h3>
			<input type="text" name="lastname" required="" id="lastname" placeholder="Lastname">
			<h3>
				Email
			</h3>
			<input type="email" name="email" required="" id="email" placeholder="email">
			<h3>
				Password
			</h3>
		
			<input type="password" name="password" required="" id="password" placeholder="* * * * *">
		
			<button type="submit" id="btn3">
				Save user
			</button>
			<input type="hidden" name="action" value="register">
		</fieldset>
	</form>
<!----------Javascript---------->
<script type="text/javascript">

	function registrar(name, lastname, email, password){
		document.getElementById('loginForm').style.display="none";
		document.getElementById('registerForm').style.display="block";
		document.getElementById('name').value = name;
		document.getElementById('lastname').value = lastname;
		document.getElementById('email').value = email;
		document.getElementById('password').value = password;
	}

</script>
</body>
</html>