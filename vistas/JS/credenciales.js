/* ========================================================================================
HACER LA TABLA DE EMPLEADOS/CREDENCIALES DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
=========================================================================================== */

  $(".tablaEmpleadosCredencial").DataTable({
    ajax: "ajax/datatable-Credenciales.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    columnDefs: [
      {
        targets: [1, 2, 3],
        render: function (data, type, row) {
          if (type === "display") {
            return data.toUpperCase();
          }
          return data;
        },
      },
    ],
  });

  /* =======================================================
                        EDITAR CREDENCIALES
    ======================================================== */

$(document).on("click", ".btnEditarCredencial", function () {
  var idCredencial = $(this).attr("idCredencial");

  var datos = new FormData();

  datos.append("idCredencial", idCredencial);

  $.ajax({
    url: "ajax/credencial.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarGlobal").val(respuesta["credencial_global"]);
      $("#ctrGlobal").val(respuesta["contr_global"]);
      $("#editarIntelisis").val(respuesta["credencial_intelisis"]);
      $("#ctrIntelisis").val(respuesta["contr_intelisis"]);
      $("#editarCredencialImpresora").val(respuesta["impresora"]);
      $("#ctrImpresora").val(respuesta["contr_impresora"]);
      $("#passcode").val(respuesta["passcode"]);
      $("#ctremail").val(respuesta["contr_email"]);
      $("#idCredencial").val(respuesta["id_credencial"]);
    },
  });
});

/* =======================================================
                ELIMINAR CATEGORIA
======================================================== */

$(document).on("click", ".btnEliminarCredencial", function () {
  var idCredencial = $(this).attr("idEliminarParcialmenteCredencial");
  var idEmpleado = $(this).attr("idEmpleado");

  swal({
    title: "¿Está seguro que quiere borrar estas credenciales?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=credencialesEmpleado&idEliminarParcialmenteCredencial=" + idCredencial + "&idEmpleado=" + idEmpleado;
    }
  });
});

/* =======================================================
                IMPRIMIR CREDENCIALES
======================================================== */

$(".tablas").on("click", ".btnImprimirCredencial", function () {

var idCredencial = $(this).attr("idCredencial");

window.open("extensiones/TCPDF-main/reportes/credenciales-reporte.php?Credencial="+idCredencial, "_blank");

})