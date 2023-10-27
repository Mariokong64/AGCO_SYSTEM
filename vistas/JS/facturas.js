/*=============================================
      MÉTODO PARA ELIMINAR LAS FACTURAS
=============================================*/

$(document).on("click", ".btnEliminarFactura", function () {
  var idFactura = $(this).attr("idFactura");

  swal({
    title: "¿Está seguro que quiere eliminar esta factura?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=facturas&idFactura=" + idFactura;
    }
  });
});

/* =======================================================
                          EDITAR FACTURAS
      ======================================================== */

$(document).on("click", ".btnEditarFactura", function () {
  var idFactura = $(this).attr("idFactura");

  var datos = new FormData();

  datos.append("idFactura", idFactura);

  $.ajax({
    url: "ajax/facturas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      
      $("#editarNumeroDeFactura").val(respuesta["numero_factura"]);
      $("#idFacturaEditar").val(respuesta["id_factura"]);
      $("#facturaUnlinkear").val(respuesta["ruta_factura"]);
    
    },
  });
});
