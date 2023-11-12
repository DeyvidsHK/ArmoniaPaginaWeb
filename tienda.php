<?php
session_start();

$carrito_mio = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
$_SESSION['carrito'] = $carrito_mio;

// Inicializa $totalcantidad
$totalcantidad = 0;

// Cuenta los elementos en el carrito
if (isset($_SESSION['carrito'])) {
	foreach ($carrito_mio as $item) {
		if ($item != NULL) {
			// Asumiendo que el elemento del carrito tiene una clave "cantidad"
			$total_cantidad = $item['cantidad'];
			$totalcantidad += $total_cantidad;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tienda | Amonia 10</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="static/src/css/style.css">
</head>
<style>
	.fondo {
		background-image: linear-gradient(to right, #d83c25, #ff6728, #ff6728, #f8c600, #f2de09, #f8c600, #f2de09, #d83c25, #ff6728) !important;
	}
</style>

<body class="fondo">
	<header>
		<!-- Navegacion de la pagina -->
		<nav class="navbar fixed-top navbar-expand-lg nav-color bg-dark">
			<div class="container">
				<a href="index.html" class="navbar-brand text-white">Armonia 10</a>
				<button type="button" class="navbar-toggler bg-white" data-bs-target="#navbarNav" data-bs-toggle="collapse"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav text-center ms-auto nav-underline">
						<li class="nav-item">
							<a href="index.html" class="nav-link navegacion text-white">Inicio</a>
						</li>
						<li class="nav-item">
							<a href="login.php" class="nav-link navegacion text-white">Registrar</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="color: red;">Carrito
								<?php echo $totalcantidad; ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!-- MODAL CARRITO -->
	<div class="modal fade" id="modal_cart" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Carrito de Compras</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="modal-body">
						<div>
							<div class="p-2">
								<ul class="list-group mb-3">
									<?php
									if (isset($_SESSION['carrito'])) {
										$total = 0;
										foreach ($carrito_mio as $item) {
											if ($item != NULL) {
												?>
												<li class="list-group-item d-flex justify-content-between lh-condensed">
													<div class="row col-12">
														<div class="col-6 p-0" style="text-align: left; color: #000000;">
															<h6 class="my-0">Cantidad:
																<?php echo $item['cantidad'] ?> :
																<?php echo $item['titulo']; ?>
															</h6>
														</div>
														<div class="col-6 p-0" style="text-align: right; color: #000000;">
															<span style="text-align: right; color: #000000;"> S/
																<?php echo $item['precio'] * $item['cantidad']; ?>
															</span>
														</div>
													</div>
												</li>
												<?php
												$total = $total + ($item['precio'] * $item['cantidad']);
											}
										}
									}
									?>
									<li class="list-group-item d-flex justify-content-between">
										<span style="text-align: left; color: #000000;">Total (SOL)</span>
										<strong style="text-align: left; color: #000000;">
											<?php
											if (isset($_SESSION['carrito'])) {
												$total = 0;
												foreach ($carrito_mio as $item) {
													if ($item != NULL) {
														$total = $total + ($item['precio'] * $item['cantidad']);
													}
												}
											}
											?>S/
											<?php
											echo $total;
											?>
										</strong>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<?php
						// Verifica si el usuario está autenticado
							
							if (!isset($_SESSION["usuario"])) {
								echo "
									<a type='button' class='btn btn-primary' 
									onclick=\"alert('Por favor, inicia sesión para realizar el pago'); 
												window.location.href = '/ArmoniaPaginaWeb/login.php';\">
									Realizar Pagos
									</a>
								";
							} else {
								// Si el usuario está autenticado, muestra el botón normalmente
								echo "<a id='realizarPagoBtn' type='button' class='btn btn-primary' data-bs-dismiss='modal'>Realizar Pago</a>";
							}
						?>

					<a type="button" class="btn btn-primary" href="borrarcarro.php">Vaciar carrito</a>
                </div>
			</div>
		</div>
	</div>
	<!-- END MODAL CARRITO -->

	<!-- MODAL PAGO -->
	<div class="modal fade" id="modal_pago" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Pago con tarjeta de Crédito / Débito</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php
					// Requiere el archivo PHP
					require('realizarPago.php');
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					<form action="registrarVenta.php" method="POST">
						<button type="submit" class="btn btn-primary" name="confirmarPagoBtn">Confirmar Pago</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	
	<!-- END MODAL PAGO -->


	<!-- ARTICULOS -->
	<div class="container mt-5">
		<div class="row" style="justify-content: center">
			<?php
			include "mostrarProductos.php";
			?>
		</div>
	</div>
	<!-- END ARTICULOS -->

	<!-- Incluyendo el JavaScript de jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- Incluyendo el JavaScript de Bootstrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="static/src/js/funcionModal.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
</body>
</html>