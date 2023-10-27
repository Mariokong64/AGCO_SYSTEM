/* ====================================================================================================
HACER LA TABLA DE ACTIVOS DE EMPLEADOS DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
==================================================================================================== */

/* $.ajax({
    url: "ajax/datatable-activosEmpleado.ajax.php",
    success: function (respuesta) {
      console.log("respuesta", respuesta);
    },
  });
  
  $(".tablaActivosDeEmpleado").DataTable({
    ajax: "ajax/datatable-activosEmpleado.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    columnDefs: [
      {
        targets: [1, 2, 3, 4],
        render: function (data, type, row) {
          if (type === "display") {
            return data.toUpperCase();
          }
          return data;
        },
      },
    ],
  }); */

  /* =======================================================
                IMPRIMIR ACTIVOS A ASIGNAR O ASIGNADOS
======================================================== */

$(".botonImprimirActivos").on("click", ".btnImprimirActivos", function () {

  var idActivosEmpleado = $(this).attr("idImprimirReporteActivos");

  var nombreReporte = $("#nombreReporte").val();
  
  window.open("extensiones/TCPDF-main/reportes/asignacion-reporte.php?idReporteActivos="+idActivosEmpleado+"&nombreReporte="+nombreReporte, "_blank");
  
  })

  /* =======================================================
                IMPRIMIR ACTIVOS A DEVOLVER
======================================================== */

$(".botonImprimirDevolucion").on("click", ".btnImprimirDevolucion", function () {

  var idActivosEmpleado = $(this).attr("idImprimirReporteActivos");

  var nombreReporte = $("#nombreDevolucionReporte").val();
  
  window.open("extensiones/TCPDF-main/reportes/devolucion-reporte.php?idReporteActivos="+idActivosEmpleado+"&nombreReporte="+nombreReporte, "_blank");
  
  })