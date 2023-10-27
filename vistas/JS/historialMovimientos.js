/* =============================================================================================
  HACER QUE ESTA TABLA DEL INVENTARIO RÁPIDO CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDO
================================================================================================ */

$(document).ready(function () {
  $(".tablaHistorialMovimientos").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/historialMovimientos.serverside.php",
    columnDefs: [
      //Aquí vamos a hacer que en la primer columna se coloque el botón de ASIGNACIÓN o DEVOLUCIÓN
      {
        targets: 0,
        render: function (data, type, row, meta) {
          if (data == "ASIGNACION") {
            return "<div class='btn-group'><button class='btn btn-success btnEstadoAF' ><i></i>ASIGNACIÓN</button></div>";
          } else {
            return "<div class='btn-group'><button class='btn btn-github btnEstadoAF'><i></i>DEVOLUCIÓN</button></div>";
          }
        },
      },
    ],
  });
});

/* ===============================================================================
MÉTODO PARA IMPRIMIR SOLO LAS LÍNEAS QUE SE MUESTRAN EN LA DATATABLE EN EL EXCEL
================================================================================= */
/*
$("#reporteHistorialMovimientos").click(function () {
  var table = $("#tablaHistorialMovimientos").DataTable();
  var series = [];

  table.on("draw.dt", function () {
    var allData = table.rows({ search: "applied" }).data();

    allData.each(function (value) {
      series.push(value[6]);
    });

    setTimeout(function () {
     
      window.location.href = "vistas/modulos/imprimir-reporte.php?reporte=historialMovimeintos&series=" + series;

    }, 2000); // Esperamos 2 segundos antes de redirigir la información al excel

    table.off("draw.dt"); // Desactivamos este evento draw.dt para evitar que se ejecute varias veces
  });

  table.page.len(-1).draw(); // Mostrar todos los registros en una sola página para que podamos mandar todas las series de todos los registros
});
*/

/* =======================================================
                IMPRIMIR ACTIVOS EN PDF
======================================================== */
/*
$("#btnImprimirReporteHistorialMovimientos").click(function () {
  var table = $("#tablaHistorialMovimientos").DataTable();
  var data = table.rows({ search: "applied" }).data();
  var series = [];

  for (var i = 0; i < data.length; i++) {
    series.push(data[i][7]);
  }

  var nombreReporte = $("#NombreReporteDeHistorialMovimientos").val();

  window.open("extensiones/TCPDF-main/reportes/historialMovimientos-reporte.php?nombreReporte="+nombreReporte+"&series="+series, "_blank");

});*/