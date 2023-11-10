document.getElementById('realizarPagoBtn').addEventListener('click', function () {
    // Oculta el modal actual (modal_cart)
    var modalCart = new bootstrap.Modal(document.getElementById('modal_cart'));
    modalCart.hide();

    // Muestra el nuevo modal (modal_pago)
    var modalPago = new bootstrap.Modal(document.getElementById('modal_pago'));
    modalPago.show();
});