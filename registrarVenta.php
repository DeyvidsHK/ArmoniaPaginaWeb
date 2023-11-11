<?php
session_start();

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si la sesión del carrito está establecida y no está vacía
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo 'Error: El carrito está vacío.';
    exit();
}


// Datos del cliente (para pruebas, puedes definir el id_cliente manualmente)
$id_cliente = 5; // Ajusta esto según tus necesidades

// Calcular el monto total de la venta
$monto_total = 0;

// Iniciar una transacción
mysqli_begin_transaction($conexion);

try {

    // Obtener la fecha actual
    $fecha_venta = date('Y-m-d');

    // Insertar la venta en la tabla 'ventas' con una sentencia preparada
    $insertar_venta = "INSERT INTO ventas (fecha_venta, id_cliente, estado, monto_total) VALUES (?, ?, 'Pendiente', 0)";
    $stmt_venta = mysqli_prepare($conexion, $insertar_venta);

    // Verificar si la preparación fue exitosa
    if ($stmt_venta) {
        mysqli_stmt_bind_param($stmt_venta, 'di', $fecha_venta, $id_cliente);
        $resultado_venta = mysqli_stmt_execute($stmt_venta);

        // Verificar si la inserción de la venta fue exitosa
        if (!$resultado_venta) {
            throw new Exception('Error al registrar la venta: ' . mysqli_error($conexion));
        }

        // Obtener el ID de la venta recién insertada
        $id_venta = mysqli_insert_id($conexion);

        // Recorrer los productos en el carrito y registrar los detalles de venta
        foreach ($_SESSION['carrito'] as $item) {
            $id_producto = obtenerIdProducto($item['titulo'], $conexion); // Función que obtiene el id_producto por el nombre del producto
            $cantidad = $item['cantidad'];
            $precio_total = $item['precio'] * $cantidad;

            // Insertar el detalle de venta en la tabla 'detallesventa' con una sentencia preparada
            $insertar_detalle = "INSERT INTO detallesventa (id_venta, id_producto, cantidad, precio_total) VALUES (?, ?, ?, ?)";
            $stmt_detalle = mysqli_prepare($conexion, $insertar_detalle);

            // Verificar si la preparación fue exitosa
            if ($stmt_detalle) {
                mysqli_stmt_bind_param($stmt_detalle, 'iiid', $id_venta, $id_producto, $cantidad, $precio_total);
                $resultado_detalle = mysqli_stmt_execute($stmt_detalle);

                // Verificar si la inserción del detalle fue exitosa
                if (!$resultado_detalle) {
                    throw new Exception('Error al registrar el detalle de venta: ' . mysqli_error($conexion));
                }

                // Sumar al monto total de la venta
                $monto_total += $precio_total;

                // Cerrar la sentencia preparada del detalle
                mysqli_stmt_close($stmt_detalle);
            } else {
                throw new Exception('Error en la preparación de la consulta de detallesventa: ' . mysqli_error($conexion));
            }
        }

        // Actualizar el monto total en la tabla 'ventas' con una sentencia preparada
        $actualizar_monto_total = "UPDATE ventas SET monto_total = ? WHERE id_venta = ?";
        $stmt_actualizacion = mysqli_prepare($conexion, $actualizar_monto_total);
        mysqli_stmt_bind_param($stmt_actualizacion, 'di', $monto_total, $id_venta);
        $resultado_actualizacion = mysqli_stmt_execute($stmt_actualizacion);

        // Verificar si la actualización fue exitosa
        if (!$resultado_actualizacion) {
            throw new Exception('Error al actualizar el monto total de la venta: ' . mysqli_error($conexion));
        }

        // Confirmar la transacción
        mysqli_commit($conexion);

        // Limpiar la sesión del carrito después de realizar la venta
        unset($_SESSION['carrito']);

        // Redirigir al usuario después de realizar la venta
        header("Location: tienda.php");
        exit();
    } else {
        // Manejar el error de preparación de la consulta de ventas
        throw new Exception('Error en la preparación de la consulta de ventas: ' . mysqli_error($conexion));
    }
} catch (Exception $e) {
    // En caso de error, revertir la transacción
    mysqli_rollback($conexion);

    // Mostrar un mensaje de error
    echo 'Error en el proceso de venta: ' . $e->getMessage();
} finally {
    // Cierra las sentencias preparadas
    if (isset($stmt_venta) && gettype($stmt_venta) === 'object') {
        mysqli_stmt_close($stmt_venta);
    }
    if (isset($stmt_actualizacion) && gettype($stmt_actualizacion) === 'object') {
        mysqli_stmt_close($stmt_actualizacion);
    }

    // Cierra la conexión
    mysqli_close($conexion);
}

// Función para obtener el id_producto por el nombre del producto
function obtenerIdProducto($nombre_producto, $conexion)
{
    $query = "SELECT id_producto FROM productos WHERE nombre LIKE ?";
    $stmt = mysqli_prepare($conexion, $query);
    $nombre_producto_like = '%' . $nombre_producto . '%';
    mysqli_stmt_bind_param($stmt, 's', $nombre_producto_like);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_producto);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $id_producto;
}
?>
