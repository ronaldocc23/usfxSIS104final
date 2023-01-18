<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "../verify_logged_out.php";
	require "../header.php";
?>

<html>
	<head>
		<title>Ingreso Administrador</title>
		<link rel="stylesheet" type="text/css" href="../css/EstiloGlobal.css">
		<link rel="stylesheet" type="text/css" href="css/EstilosAdmin.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
		
		<legend>Ingreso Administrador</legend>
		
			<div class="error-message" id="error-message">
				<p id="error"></p>
			</div>
			
			<div class="icon">
				<input class="l-user" type="text" name="l_user" placeholder="Usuario" required />
			</div>
			
			<div class="icon">
				<input class="l-pass" type="password" name="l_pass" placeholder="Contraseña" required />
			</div>
			
			<input type="submit" value="Ingresar" name="l_login"/>
			
		</form>
	</body>
	
	<?php
	
	$type="ss";
		if(isset($_POST['l_login']))
		{
			$query = $con->prepare("SELECT id FROM admins WHERE username = ? AND password = ?;");
			$query->bind_param($type, $_POST['l_user'], $_POST['l_pass']);
			$query->execute();

			$result = $query->get_result();
			
			if(mysqli_num_rows($result) != 1)
				echo error_without_field("Invalid username/password combination");
			else 
			{
				$resultRow = mysqli_fetch_array($result);
				$balance = $resultRow[1];
					$_SESSION['type'] = "admins";
					$_SESSION['id'] = $resultRow[0];
					$_SESSION['username'] = $_POST['l_user'];
					header('Location: home.php');
			}
		}
	?>
	
</html>