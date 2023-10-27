/* ========================================================================================
HACER LA TABLA DE EMPLEADOS DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
=========================================================================================== */

  $(".tablaEmpleadosDevolucion").DataTable({
    ajax: "ajax/datatable-DevolucionEmpleado.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    columnDefs: [
      {
        targets: [1, 2],
        render: function (data, type, row) {
          if (type === "display") {
            return data.toUpperCase();
          }
          return data;
        },
      },
    ],
  });

  /* ========================================================
                      DESASIGNAR ACTIVOS
=========================================================== */

$(".tablaActivosDeEmpleado tbody").on("click", "button.btnDesasignar", function () {
  var idActivo = $(this).attr("idActivo");
  var idEmpleado = $(this).attr("idEmpleado");
  var datos = new FormData();
  datos.append("idActivo", idActivo);

  $.ajax({
    url: "ajax/devolucion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#idDelActivo").val(respuesta["id_inventario"]);
      $("#estadoDevolucion").val(respuesta["id_estado"]);
      $("#estadoAnteriorDevolucion").val(respuesta["id_estado"]);
      $("#idDelEmpleado").val(idEmpleado);
    },
  });
});

/* ========================================================
                      EDITAR ACTIVOS
=========================================================== */

$(".tablaActivosDeEmpleado tbody").on("click", "button.btnEditarActivoEmpleado", function () {
  var idInventario = $(this).attr("idActivoEmpleado");

  var datos = new FormData();
  datos.append("idInventario", idInventario);

  $.ajax({
    url: "ajax/inventario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $("#editarSerie").val(respuesta["serie"]);
      $("#idDelInventario").val(respuesta["id_inventario"]);
      $("#editarFactura").val(respuesta["factura"]);
      $("#editarTipo").val(respuesta["id_tipo"]);
      $("#editarTipo").html(respuesta["tipo"]);
      $("#editarMarca").val(respuesta["id_marca"]);
      $("#editarMarca").html(respuesta["marca"]);
      $("#editarModelo").val(respuesta["id_modelo"]);
      $("#editarModelo").html(respuesta["modelo"]);
      $("#editarEstatus").val(respuesta["id_estatus"]);
      $("#editarEstatus").html(respuesta["estatus"]);
      $("#editarFechaCompra").val(respuesta["fecha_ingreso"]);
      $("#editarFechaVencimiento").val(respuesta["fecha_vencimiento"]);
      $("#editarDetalle").val(respuesta["detalles"]);
      $("#editarDepartamento").val(respuesta["id_departamento"]);
      $("#editarDepartamento").html(respuesta["departamento"]);
      $("#editarNumero").val(respuesta["numero_tel"]);
      $("#editarImei").val(respuesta["imei"]);
      $("#editarCelEmail").val(respuesta["email_cel"]);
      $("#editarMac").val(respuesta["mac_tel"]);
      $("#editarContrato").val(respuesta["contrato"]);
      $("#editarIP").val(respuesta["ip"]);
      $("#editarHostName").val(respuesta["host_name"]);
      $("#editarEstado").val(respuesta["id_estado"]);
      $("#estadoAnterior").val(respuesta["id_estado"]);
      $("#editarUbicacion").val(respuesta["id_ubicacion"]);
      $("#editarUbicacion").html(respuesta["ubicacion"]);
      $("#editarPosicion").val(respuesta["posicion"]);
      $("#idEmpleado").val(respuesta["id_empleado"]);
    },
  });
});
