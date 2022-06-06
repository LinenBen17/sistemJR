<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

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
						<h2>Recent Orders</h2>
						<a href="#" class="btn">View All</a>
					</div>
					<table>
						<thead>
							<tr>
								<td>Name</td>
								<td>Price</td>
								<td>Payment</td>
								<td>Status</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status delivered">Delivered</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status return">Return</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status inprogress">In Progress</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status delivered">Delivered</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status return">Return</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status inprogress">In Progress</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status return">Return</span></td>
							</tr>
							<tr>
								<td>Star Refrigerator</td>
								<td>$1200</td>
								<td>Paid</td>
								<td><span class="status pending">Pending</span></td>
							</tr>
						</tbody>
					</table>
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