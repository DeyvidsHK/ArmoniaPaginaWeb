document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("confirmarPagoBtn").addEventListener("click", function () {
    // Realizar solicitud AJAX con jQuery
    $.ajax({
      url: "registrarVenta.php",
      type: "POST", // o 'GET' según lo que necesites
      dataType: "json", // o 'html', 'text', etc., según lo que responda registrarVenta.php
      success: function (response) {
        // Manejar la respuesta si es necesario
        if (response.success) {
          // Si la venta se registró correctamente, muestra un mensaje de éxito
          console.log("Venta registrada correctamente");
          // Puedes mostrar el mensaje en la pantalla si lo prefieres
          alert("Venta registrada correctamente");
        } else {
          // Si hay un error en la venta, muestra el mensaje de error
          console.error("Error en la venta:", response.message);
          // Puedes mostrar el mensaje en la pantalla si lo prefieres
          alert("Error en la venta: " + response.message);
        }

        // Cerrar el modal en ambos casos
        //$("#modal_pago").modal("hide");
      },
      error: function (xhr, status, error) {
        // Manejar errores si es necesario
        console.error("Error en la solicitud AJAX:", error);
        // Puedes mostrar el mensaje de error en la pantalla si lo prefieres
        alert("Error en la solicitud AJAX: " + error);
      },
    });
  });
});
