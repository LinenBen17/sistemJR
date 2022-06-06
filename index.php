<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require 'conexion.php';

    session_start();

    if ($_POST) {
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "SELECT id, password, nombre, tipo_usuario FROM usuarios WHERE usuario = ?";

        if ($sentencia_inicial = $mysqli->prepare($sql)) {

	        $sentencia_inicial->bind_param("s", $usuario);
	        $sentencia_inicial->execute();
	        $sentencia_inicial->store_result();

	        $num_rows = $sentencia_inicial->num_rows;

			if ($num_rows > 0) {
	            $sentencia_inicial->close();

	            $sentencia_fetch = $mysqli->prepare($sql);
	        	$sentencia_fetch->bind_param("s", $usuario);
	        	$sentencia_fetch->execute();

	        	$result = $sentencia_fetch->get_result();
	        	$assoc = $result->fetch_assoc();

	        	$password_bd = $assoc['password'];
	        	$pass_c = password_hash($password, PASSWORD_DEFAULT);


	        	/*if (password_verify($password, $password_bd)) {
	        		$_SESSION['id'] = $assoc['id'];
	        		$_SESSION['nombre'] = $assoc['nombre'];
	        		$_SESSION['tipo_usuario'] = $assoc['tipo_usuario'];

	        		header("location: principal.php");
	        	}else{
	        		echo "La contraseña no coincide";
	        	}*/
	        }else{
	            echo "NO existe el usuario";
	        }
        }	
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/index.css">
	<title>Login</title>
</head>
<body>
	<section>
		<div class="box">
			<div class="form">
				<h2>Login</h2>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="nope" method="POST">
					<div class="inputBx">
						<input type="text" name="usuario" placeholder="Username" autocomplete="nope">
						<ion-icon name="person-circle-outline"></ion-icon>
					</div>
					<div class="inputBx">
						<input type="password" name="password" placeholder="Contraseña" autocomplete="nope">
						<ion-icon name="lock-closed-outline"></ion-icon>
					</div>
					<div class="inputBx">
						<input type="submit" value="Login">
					</div>
				</form>
			</div>
		</div>
	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>