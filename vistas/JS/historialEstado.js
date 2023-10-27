/* ========================================================================================
          HACER LA TABLA DE MOVIMIENTOS PARA QUE CARGUE DESDE EL SERVERSIDE
=========================================================================================== */

$(document).ready(function () {
  $(".tablaHistorialEstado").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/historialEstados.serverside.php",

    //Definimos los elementos que se verán en cada columna

    columnDefs: [

      //Aquí vamos a hacer que en la primer columna se coloque el botón de ASIGNACIÓN o DEVOLUCIÓN

      {
        targets: 2,
        render: function (data, type, row, meta) {
          
          //Aqui empiezan los if y else if para poner los botones (no utilicé un switch porque por alguna razón no funcionan en el servidor, pero en mi computadora si)

          var value = parseInt(data);

          switch (value) {

            case 1: return "<div class='btn-group'><button class='btn btn-success' style='width: 125px;'><i></i>ACTIVO</button></div>";

            case 2: return "<div class='btn-group'><button class='btn bg-gray' style='width: 125px;'><i></i>INACTIVO</button></div>";

            case 3: return "<div class='btn-group'><button class='btn btn-warning' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";

            case 4: return "<div class='btn-group'><button class='btn btn-info' style='width: 125px;'><i></i>DONACIÓN</button></div>";

            case 5: return "<div class='btn-group'><button class='btn btn-github' style='width: 125px;'><i></i>SCRAP</button></div>";

            default: return "NA";

          }

          //Aqui terminan los if y else if
        },
      },

      {
        targets: 3,
        render: function (data, type, row, meta) {
          
          var value = parseInt(data);

          switch (value) {

            case 1: return "<div class='btn-group'><button class='btn btn-success' style='width: 125px;'><i></i>ACTIVO</button></div>";

            case 2: return "<div class='btn-group'><button class='btn bg-gray' style='width: 125px;'><i></i>INACTIVO</button></div>";

            case 3: return "<div class='btn-group'><button class='btn btn-warning' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";

            case 4: return "<div class='btn-group'><button class='btn btn-info' style='width: 125px;'><i></i>DONACIÓN</button></div>";

            case 5: return "<div class='btn-group'><button class='btn btn-github' style='width: 125px;'><i></i>SCRAP</button></div>";

            default: return "NA";

          }
        },
      },
    ],
  });
});



/* =====================================================================================
MÉTODO PARA IMPRIMIR SOLO LAS LÍNEAS QUE SE MUESTRAN EN LA DATATABLE EN EL EXCEL
===================================================================================== */
/*
$("#reporteHistorialEstados").click(function () {
  var table = $("#tablaHistorialEstado").DataTable();
  var data = table.rows({ search: "applied" }).data();
  var series = [];

  for (var i = 0; i < data.length; i++) {
    series.push(data[i][6]);
  }

  window.location.href = "vistas/modulos/imprimir-reporte.php?reporte=historialEstados&series=" + series;

});
*/
/* =======================================================
                IMPRIMIR ACTIVOS EN PDF
======================================================== */
/*
$("#btnImprimirReporteHistorialEstados").click(function () {
  var table = $("#tablaHistorialEstado").DataTable();
  var data = table.rows({ search: "applied" }).data();
  var series = [];

  for (var i = 0; i < data.length; i++) {
    series.push(data[i][6]);
  }

  var nombreReporte = $("#NombreReporteDeHistorialEstados").val();

  window.open("extensiones/TCPDF-main/reportes/historialEstados-reporte.php?nombreReporte="+nombreReporte+"&series="+series, "_blank");

});
*/