<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Datos del cliente (para pruebas, puedes definir el id_cliente manualmente)
$id_cliente = 1; // Ajusta esto según tus necesidades

// Calcular el monto total de la venta
$monto_total = 0;

// Obtener la fecha actual
$fecha_venta = date('Y-m-d H:i:s');

// Iniciar una transacción
mysqli_begin_transaction($conexion);

try {
  // Insertar la venta en la tabla 'ventas' con una sentencia preparada
  $insertar_venta = "INSERT INTO ventas (fecha_venta, id_cliente, estado, monto_total) VALUES (?, ?, 'Pendiente', 0)";
  $stmt_venta = mysqli_prepare($conexion, $insertar_venta);
  mysqli_stmt_bind_param($stmt_venta, 'si', $fecha_venta, $id_cliente);
  $resultado_venta = mysqli_stmt_execute($stmt_venta);

  // Verificar si la inserción de la venta fue exitosa
  if (!$resultado_venta) {
    throw new Exception('Error al registrar la venta: ' . mysqli_error($conexion));
  }

  // Obtener el ID de la venta recién insertada
  $id_venta = mysqli_insert_id($conexion);

  // Recorrer los productos en el carrito y registrar los detalles de venta
  if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $item) {
      $id_producto = obtenerIdProducto($item['titulo'], $conexion); // Función que obtiene el id_producto por el nombre del producto
      $cantidad = $item['cantidad'];
      $precio_total = $item['precio'] * $cantidad;

      // Insertar el detalle de venta en la tabla 'detallesventa' con una sentencia preparada
      $insertar_detalle = "INSERT INTO detallesventa (id_venta, id_producto, cantidad, precio_total) VALUES (?, ?, ?, ?)";
            $stmt_detalle = mysqli_prepare($conexion, $insertar_detalle);
            mysqli_stmt_bind_param($stmt_detalle, 'iiid', $id_venta, $id_producto, $cantidad, $precio_total);
            $resultado_detalle = mysqli_stmt_execute($stmt_detalle);

      // Verificar si la inserción del detalle fue exitosa
      if (!$resultado_detalle) {
        throw new Exception('Error al registrar el detalle de venta: ' . mysqli_error($conexion));
      }

      // Sumar al monto total de la venta
      $monto_total += $precio_total;
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
  }

  // Éxito: Puedes devolver alguna respuesta si es necesario
  $respuesta = array('success' => true, 'message' => 'Venta registrada correctamente');
  echo json_encode($respuesta);
} catch (Exception $e) {
  // En caso de error, revertir la transacción
  mysqli_rollback($conexion);

  // Devolver un mensaje de error
  $respuesta = array('success' => false, 'message' => $e->getMessage());
  echo json_encode($respuesta);
} finally {
  // Cierra las sentencias preparadas
  if (isset($stmt_venta)) {
    mysqli_stmt_close($stmt_venta);
  }
  if (isset($stmt_detalle)) {
    mysqli_stmt_close($stmt_detalle);
  }
  if (isset($stmt_actualizacion)) {
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