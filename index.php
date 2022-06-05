<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require 'conexion.php';

    session_start();

    if ($_POST) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $sql = $mysqli->prepare("SELECT id, password, nombre, tipo_usuario FROM usuarios WHERE usuario = ?");
        $sql->bind_param("i", $usuario, $password);
        $resultado = $mysqli->query($sql);
        

        /*$resultado = $mysqli->query($sql);
        $num = $resultado->num_rows;

        if ($num>0) {
            $row = $resultado->fetch_assoc();
            $password_bd = $row['password'];

            $pass_c = sha1($password);

            if ($password_bd == $pass_c) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['tipo_usuario'] = $row['tipo_usuario'];

                header("location: principal.php");
            }else{
                echo "La contraseña no coincide";
            }
        }else{
            echo "NO existe el usuario";
        }*/
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