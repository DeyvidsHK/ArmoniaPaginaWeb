<?php
include 'conexion.php';

$baseURL = "static/src/img/";

// Consulta para obtener los productos
$query = "SELECT * FROM Productos";
$resultado = mysqli_query($conexion, $query);

// Verifica si hay resultados
if ($resultado) {
    // Muestra los productos
    while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
        <div class="card m-4" style="width: 18rem;">
            <form id="formulario" name="formulario" method="post" action="cart.php">
                <input name="precio" type="hidden" id="precio" value="<?php echo $row['precio']; ?>" />
                <input name="titulo" type="hidden" id="titulo" value="<?php echo $row['nombre']; ?>" />
                <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                <img src="<?php echo $baseURL . $row['imagen']; ?>" class="card-img-top pt-3" alt="...">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title text-center"><?php echo $row['nombre']; ?></h5>
										<p class="card-text"><?php echo $row['descripcion']; ?></p>
                    <p class="card-text">S/<?php echo $row['precio']; ?></p>
                    <div class="boton-container">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
} else {
    echo "Error en la consulta: " . mysqli_error($conexion);
}

// Cierra la conexión
mysqli_close($conexion);
?>
