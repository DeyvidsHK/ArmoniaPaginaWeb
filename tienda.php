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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda | Amonia 10</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/src/css/style.css">
</head>
<style>
    .fondo{
    background-image: linear-gradient(to right, #d83c25,#ff6728,#ff6728, #f8c600, #f2de09,#f8c600, #f2de09,#d83c25,#ff6728) !important;
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
                        <a href="tienda.html" class="nav-link navegacion text-white">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="color: red;">Carrito <?php echo $totalcantidad; ?></a>
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
                                                        <h6 class="my-0">Cantidad: <?php echo $item['cantidad'] ?> : <?php echo $item['titulo']; ?></h6>
                                                    </div>
                                                    <div class="col-6 p-0" style="text-align: right; color: #000000;">
                                                        <span style="text-align: right; color: #000000;"> S/<?php echo $item['precio'] * $item['cantidad']; ?> </span>
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
                                    <span style="text-align: left; color: #000000;">Total (Sol)</span>
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
                <a type="button" class="btn btn-primary" href="borrarcarro.php">Vaciar carrito</a>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL CARRITO -->

<!-- ARTICULOS -->
<div class="container mt-5">
    <div class="row" style="justify-content: center">

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="15" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 1" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-1.png" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Polo diseño 1</h5>
                    <p class="card-text">Descripción - Precio S/15</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="35" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 2" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-2.png" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Chaqueta diseño 1</h5>
                    <p class="card-text">Descripción - Precio S/35</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="15" />
                <input name "titulo" type="hidden" id="titulo" value="articulo 3" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-3.png" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Polo diseño negro</h5>
                    <p class="card-text">Descripción - Precio S/15</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="40" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 4" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-4.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Chaqueta diseño 2</h5>
                    <p class="card-text">Descripción - Precio S/40</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="40" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 5" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-5.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Chaqueta diseño 3</h5>
                    <p class="card-text">Descripción - Precio S/40</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="20" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 6" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-7.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title text-center">Polo cumbia</h5>
                    <p class="card-text">Descripción - Precio S/20</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="20" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 7" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-6.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Gorra diseño 1</h5>
                    <p class="card-text">Descripción - Precio S/20</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="20" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 8" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-8.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Gorra diseño 2</h5>
                    <p class="card-text">Descripción - Precio S/20</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="15" />
                <input name="titulo" type="hidden" id="titulo" value="articulo 9" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="static/src/img/tienda-9.jpeg" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center"">
                    <h5 class="card-title">Cantimplora Armonia 10</h5>
                    <p class="card-text">Descripción - Precio S/15</p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END ARTICULOS -->

<!-- Incluyendo el JavaScript de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluyendo el JavaScript de Bootstrap -->
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
