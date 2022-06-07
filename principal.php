<?php 
    ini_set('display_errors', 0);
    error_reporting(E_ALL);

    require 'conexion.php';

    session_start();

    if (!isset($_SESSION['id'])) {
        header("location: index.php");
    }

    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Responsive Admin Dashboard | Redesign</title>
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
	<div class="container">
		<div class="navigation">
			<ul>
				<li>
					<a href="#">
						<span class="icon"><ion-icon name="car-outline"></ion-icon></span>
						<span class="title">TRANSPORTES JR</span>
					</a>
				</li>
				<li>
					<a href="#">
						<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
						<span class="title">Inicio</span>
					</a>
				</li>
				<?php if ($tipo_usuario == 1) {?>
					<li>
						<a href="#">
							<span class="icon"><ion-icon name="people-outline"></ion-icon></span>
							<span class="title">Control Usuarios</span>
						</a>
					</li>
				<?php } ?>
				<li>
					<a href="logout.php">
						<span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
						<span class="title">Cerrar Sesión</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- Main -->
		<div class="main">
			<div class="topbar">
				<div class="toggle">
					<ion-icon name="menu-outline"></ion-icon>
				</div>
				<!-- search -->
				<div class="search">
					<label>
						<input type="text" placeholder="Search here">
						<ion-icon name="search-outline"></ion-icon>
					</label>
				</div>
				<!-- userImg -->
				<div class="user">
					<span><?php echo $nombre; ?></span><ion-icon name="person-circle-outline"></ion-icon>
				</div>
			</div>
			<div class="details">
				<div class="recentOrders">
					<div class="cardHeader">
						<h2>Tracking Guía</h2>
					</div>
					<div class="inputBx">
						<form method="POST">
							<label>Introduce el número de guía:</label><br>
							<input type="text" name="noguia">
							<input type="submit" class="btn" value="Consultar">
						</form>
						<?php
						    if ($_POST) {
						    	$noguia = $_POST['noguia'];

						    	$sql_descarga_camiones = "SELECT escaneo, fecha, responsabl, manifiesto, rutaingres FROM descargacamiones WHERE escaneo = ?";
						    	$sql_carga_camiones = "SELECT escaneo, fecha, responsabl, manifiesto, rutadestin FROM cargacamiones WHERE escaneo = ?";

						    	if ($sentencia_rows_descarga = $mysqli->prepare($sql_descarga_camiones) and $sentencia_rows_carga = $mysqli->prepare($sql_carga_camiones)) {
						    		$sentencia_rows_descarga->bind_param("s", $noguia);
						    		$sentencia_rows_descarga->execute();
						    		$sentencia_rows_descarga->store_result();

						    		$sentencia_rows_carga->bind_param("s", $noguia);
						    		$sentencia_rows_carga->execute();
						    		$sentencia_rows_carga->store_result();

						    		$num_rows_descarga = $sentencia_rows_descarga->num_rows;
						    		$num_rows_carga = $sentencia_rows_carga->num_rows;

						    		if ($num_rows_descarga > 0 or $num_rows_carga > 0) {
						    			$sentencia_rows_descarga->close();
						    			$sentencia_rows_carga->close();

						    			$sentencia_assoc_descarga = $mysqli->prepare($sql_descarga_camiones);
						    			$sentencia_assoc_descarga->bind_param("s", $noguia);
						    			$sentencia_assoc_descarga->execute();

						    			$result_descarga = $sentencia_assoc_descarga->get_result();
						    			$assoc_descarga = $result_descarga->fetch_assoc();

						    			$sentencia_assoc_descarga->close();

						    			$sentencia_assoc_carga = $mysqli->prepare($sql_carga_camiones);
						    			$sentencia_assoc_carga->bind_param("s", $noguia);
						    			$sentencia_assoc_carga->execute();

						    			$result_carga = $sentencia_assoc_carga->get_result();
						    			$assoc_carga = $result_carga->fetch_assoc();

						    			$sentencia_assoc_carga->close();
						?>
					</div>
					<div class="cardHeader">
						<h2>Descarga Camiones</h2>
					</div>
					<table>
						<thead>
							<tr>
								<td>No. Guía</td>
								<td>Fecha</td>
								<td>Manifiesto</td>
								<td>Ruta Ingreso</td>
								<td>Responsable</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php if($assoc_descarga['escaneo'] != NULL){ echo $assoc_descarga['escaneo']; } ?></td>
								<td><?php if($assoc_descarga['fecha'] != NULL){ echo $assoc_descarga['fecha']; } ?></td>
								<td><?php if($assoc_descarga['manifiesto'] != NULL){ echo $assoc_descarga['manifiesto']; } ?></td>
								<td><?php if($assoc_descarga['rutaingres'] != NULL){ echo $assoc_descarga['rutaingres']; } ?></td>
								<td><?php if($assoc_descarga['responsabl'] != NULL){ echo $assoc_descarga['responsabl']; } ?></td>
							</tr>
						</tbody>
					</table>
					<div class="cardHeader">
						<h2>Carga Camiones</h2>
					</div>
					<table>
						<thead>
							<tr>
								<td>No. Guía</td>
								<td>Fecha</td>
								<td>Manifiesto</td>
								<td>Ruta Ingreso</td>
								<td>Responsable</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php if($assoc_carga['escaneo'] != NULL){ echo $assoc_carga['escaneo']; } ?></td>
								<td><?php if($assoc_carga['fecha'] != NULL){ echo $assoc_carga['fecha']; } ?></td>
								<td><?php if($assoc_carga['manifiesto'] != NULL){ echo $assoc_carga['manifiesto']; } ?></td>
								<td><?php if($assoc_carga['rutadestin'] != NULL){ echo $assoc_carga['rutadestin']; } ?></td>
								<td><?php if($assoc_carga['responsabl'] != NULL){ echo $assoc_carga['responsabl']; } ?></td>
							</tr>
						</tbody>
					</table>
					<?php
									}else{
					?>
										<div class="errorGuia">
											<span class="status pending">No se encontraron resultados con ese número de guía.</span>
										</div>
					<?php
							    		}
							    	}
							    }
					?>
				</div>
			</div>
		</div>
	</div>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	<script>
		//MenuToggle
		let toggle = document.querySelector('.toggle');
		let navigation = document.querySelector('.navigation');
		let main = document.querySelector('.main');

		toggle.onclick = function(){
			navigation.classList.toggle('active');
			main.classList.toggle('active');
		}
		//add hovered class in selected list item
		let list = document.querySelectorAll('.navigation li');
		function activeLink() {
			list.forEach((item)=>{
				item.classList.remove('hovered');
			});
			this.classList.add('hovered');
		}
		list.forEach((item)=>{
			item.addEventListener('mouseover', activeLink)
		})
	</script>
</body>
</html>