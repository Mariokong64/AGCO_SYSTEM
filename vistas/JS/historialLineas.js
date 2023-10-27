/* =============================================================================================
  HACER QUE ESTA TABLA DE LAS LÍNEAS CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDA
================================================================================================ */

$(document).ready(function () {
  $(".tablaHistorialLineas").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/historialLineas.serverside.php",
    columnDefs: [

      //Aquí vamos a hacer que en la séptima columna se forme un botón que nos indique que tipo de cambio se hizo, según el dato que venga en esa columna

      {
        targets: 7,
        render: function (data, type, row, meta) {
          
          //Aqui empieza el switch para poner los botones

          var value = parseInt(data);

          switch (value) {

            case 1: return "<div class='btn-group'><button class='btn bg-maroon' style='width: 125px;'><i></i>DISPOSITIVO</button></div>";

            case 2: return "<div class='btn-group'><button class='btn bg-purple' style='width: 125px;'><i></i>EMPLEADO</button></div>";

            case 3: return "<div class='btn-group'><button class='btn btn-info' style='width: 125px;'><i></i>AMBOS</button></div>";

            default: return "NA";

          }

        },
      },

    ],
  });
});

/* =======================================================
                    FILTROS DEL ENCABEZADO
    ======================================================== */

//Filtro para las líneas

$("#filtroHistorialLinea").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para los dispositivos asignados anteriormente

$("#filtroHistorialDispositivoAnterior").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para los dispositivos asignados posteriormente

$("#filtroHistorialDispositivoPosterior").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para los empleados asignados anteriormente

$("#filtroHistorialEmpleadoAnterior").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para los empleados asignados posteriormente

$("#filtroHistorialEmpleadoPosterior").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para los usuarios que realizaron el cambio

$("#filtroHistorialUsuario").keyup(function () {
  var table = $("#tablaHistorialLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});