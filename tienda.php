<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda | Amonia 10</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/src/css/style.css">
    </head>
    <body>  
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
                                <a href="tienda.html" class="nav-link navegacion text-white" >Tienda</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <?php 

    $carrito_mio=$_SESSION['carrito'];
    $_SESSION['carrito']=$carrito_mio;

    // contamos nuestro carrito
    if(isset($_SESSION['carrito'])){
        for($i=0;$i<=count($carrito_mio)-1;$i ++){
        if($carrito_mio[$i]!=NULL){ 
        $total_cantidad = $carrito_mio['cantidad'];
        $total_cantidad ++ ;
        $totalcantidad += $total_cantidad;
        }}}
    ?>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mi tienda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modal_cart" style="color: red;"><i class="fas fa-shopping-cart"></i> <?php echo $totalcantidad; ?></a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <!-- END NAVBAR -->



    <!-- MODAL CARRITO -->
    <div class="modal fade" id="modal_cart" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
    
    
        
                <div class="modal-body">
                    <div>
                        <div class="p-2">
                            <ul class="list-group mb-3">
                                <?php
                                if(isset($_SESSION['carrito'])){
                                $total=0;
                                for($i=0;$i<=count($carrito_mio)-1;$i ++){
                                if($carrito_mio[$i]!=NULL){
                            
                ?>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div class="row col-12" >
                                        <div class="col-6 p-0" style="text-align: left; color: #000000;"><h6 class="my-0">Cantidad: <?php echo $carrito_mio[$i]['cantidad'] ?> : <?php echo $carrito_mio[$i]['titulo']; // echo substr($carrito_mio[$i]['titulo'],0,10); echo utf8_decode($titulomostrado)."..."; ?></h6>
                                        </div>
                                        <div class="col-6 p-0"  style="text-align: right; color: #000000;" >
                                        <span   style="text-align: right; color: #000000;"><?php echo $carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad'];    ?> €</span>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                $total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
                                }
                                }
                                }
                                ?>
                                <li class="list-group-item d-flex justify-content-between">
                                <span  style="text-align: left; color: #000000;">Total (EUR)</span>
                                <strong  style="text-align: left; color: #000000;"><?php
                                if(isset($_SESSION['carrito'])){
                                $total=0;
                                for($i=0;$i<=count($carrito_mio)-1;$i ++){
                                if($carrito_mio[$i]!=NULL){ 
                                $total=$total + ($carrito_mio[$i]['precio'] * $carrito_mio[$i]['cantidad']);
                                }}}
                                echo $total; ?> €</strong>
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
    <div class="row" style="justify-content: center;">

    <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
            <input name="precio" type="hidden" id="precio" value="10" />
            <input name="titulo" type="hidden" id="titulo" value="articulo 1" />
            <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
            <img src="img/art.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                            <h5 class="card-title">Producto 1</h5>
                            <p class="card-text">Descripción - Precio 10€</p>
                            <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
            </form>
    </div>



    <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
            <input name="precio" type="hidden" id="precio" value="20" />
            <input name="titulo" type="hidden" id="titulo" value="articulo 2" />
            <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
            <img src="img/art.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                            <h5 class="card-title">Producto 2</h5>
                            <p class="card-text">Descripción - Precio 20€</p>
                            <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
            </form>
    </div>


    <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
            <input name="precio" type="hidden" id="precio" value="30" />
            <input name="titulo" type="hidden" id="titulo" value="articulo 3" />
            <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
            <img src="img/art.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                            <h5 class="card-title">Producto 3</h5>
                            <p class="card-text">Descripción - Precio 30€</p>
                            <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
            </form>
    </div>




    </div>
    </div>
    <!-- END ARTICULOS -->
        
        <!-- Incluyendo el javascript jquery -->
        <script type="text/javascript" src="jquery/code.jquery.com_jquery-3.7.1.min.js"></script>
        <!-- Incluyendo el javascript de Boostrap -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>