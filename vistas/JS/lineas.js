/* =============================================================================================
  HACER QUE ESTA TABLA DEL INVENTARIO RÁPIDO CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDO
================================================================================================ */

$(document).ready(function () {
  $(".tablaLineas").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/lineas.serverside.php",
    columnDefs: [

      // Aquí vamos a hacer que en la última columna se pongan los botones de editar y eliminar

     {
        targets: -1,
        data: null,
        defaultContent:
        "<div class='btn-group'><button class='btn btn-warning btnEditarAF' idLinea='' data-toggle='modal' data-target='#modalEditarLinea' style='margin-left: 10px;'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-danger btnEliminarAF' idLinea='' style='margin-left: 5px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>",

        createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
          $(cell).addClass("cell-actions"); // Agregamos una clase a la celda para identificarla posteriormente
        },
      },
    ],

   //Aqui hacemos que los botones de editar o eliminar desaparezcan o aparezcan segun el perfil del usuario

    createdRow: function (row, data, dataIndex) {
      //cambios

      if(perfil == "Administrador"){

      } else if (perfil == "Soporte") {

        $(row).find(".btnEliminarAF").remove();

      } else{

        $(row).find(".cell-actions").empty();

      }

       //Aquí hacemos que en los botones de editar y eliminar de la última columna se les ponda el número de serie del activo que está en la misma fila

      var idLinea = data[0]; // Aquí obtenemos el ID del registro
      $(row).find(".btnEditarAF").attr("idLinea", idLinea);
      $(row).find(".btnEliminarAF").attr("idLinea", idLinea);

      //AQUÍ INICIA EL EVENTO PARA EDITAR LOS REGISTROS

      $(row)
        .find(".btnEditarAF")
        .on("click", function () {
          var idLinea = $(this).attr("idLinea");

          var datos = new FormData();
          datos.append("idLinea", idLinea);

          $.ajax({
            url: "ajax/lineas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
              console.log(respuesta);
              $("#editarLinea").val(respuesta["linea"]);
              $("#idLinea").val(respuesta["id_linea"]);
              $("#editarContrato").val(respuesta["contrato"]);
              $("#editarCC").val(respuesta["centro_costos"]);
              $("#editarLimite").val(respuesta["limite"]);
              $("#editarTipoLinea").val(respuesta["id_tipo_linea"]);
              $("#editarTipoLinea").html(respuesta["tipo_linea"]);
              $("#seleccionarEmpleado").val(respuesta["id_empleado"]);
              $("#seleccionarEmpleado").html(respuesta["nombre"]);
              $("#editarDetalles").val(respuesta["detalles"]);
              //Aqui ponemos en el select 2 los valores que vienen
              $("#seleccionarDispositivo").select2();
              $("#seleccionarDispositivo").val(respuesta["id_inventario"]);
              $("#seleccionarDispositivo").trigger("change");

            },
          });
          // AQUÍ TERMINA EL EVENTO PARA EDITAR LOS REGISTROS
        });

      // AQUÍ INICIA EL EVENTO PARA ELIMINAR LOS REGISTROS

      $(row)
        .find(".btnEliminarAF")
        .on("click", function () {
          var idLinea = $(this).attr("idLinea");

          swal({
            title: "¿Está seguro que quiere eliminar a este Activo Fijo?",
            text: "Esta acción no se puede deshacer",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar",
          }).then(function (result) {
            if (result.value) {
              window.location =
              "index.php?ruta=lineas&idLinea=" + idLinea;
            }
          });
        });

      // AQUÍ TERMINA EL EVENTO PARA ELIMINAR LOS REGISTROS
    },
  });
});


/* =======================================================
                    FILTROS DEL ENCABEZADO
    ======================================================== */

//Filtro para el número de serie

$("#filtroLinea").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaSerie").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaMarca").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaModelo").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaEmpleado").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaContrato").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaCC").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaLimite").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de serie

$("#filtroLineaTipo").keyup(function () {
  var table = $("#tablaLineas").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});


/* =========================================================================================================
                             REVISAR NÚMEROS DE LÍNEAS TELEFÓNICAS REPETIDAS
============================================================================================================ */

$("#nuevaLinea").change(function () {
  $(".alert").remove();

  var linea = $(this).val();
  var datos = new FormData();
  datos.append("validarLinea", linea);

  $.ajax({
    url: "ajax/lineas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaLinea")
          .parent()
          .after(
            '<div class="alert alert-warning">Ese número de línea ya existe</div>'
          );
        $("#nuevaLinea").val("");
      }
    },
  });
});


/* =================================================================
    METODO PARA AGREGAR EL BUSCADOR AL SELECT DE LOS DISPOSITIVOS
=================================================================== */

$('#seleccionarDispositivo').select2();

/* ============================================================
        MÉTODO PARA PASAR LOS REGISTROS A EXCEL CON SheetJS
============================================================== */

document.addEventListener("DOMContentLoaded", function () {
  var botonReporte = document.getElementById("reporteLineas");

  if (botonReporte) {
    botonReporte.addEventListener("click", function () {
      var table = $("#tablaLineas").DataTable();

      // Obtenemos todos los datos de la DataTable
      table.page.len(-1).draw(); // Mostramos todos los registros en una sola página

      // Le ponemos este timer para dejar que los datos de la tabla se muestren en una sola página antes de mandarlos al excel
      setTimeout(function () {
        var allData = table.rows({ search: "applied" }).data();
        var data = [];
        var headerRow = table.table().header().querySelectorAll("th");
        var headers = [];

        headerRow.forEach(function (th) {
          // Agregamos encabezados excepto "Acciones"
          if (th.textContent !== "Acciones") {
            headers.push(th.textContent);
          }
        });
        data.push(headers);

        allData.each(function (value) {
          // Filtramos los datos para omitir la columna "Acciones"
          var rowData = value.filter(function (cellData, index) {
            return index !== headers.indexOf("Acciones");
          });

          data.push(rowData);
        });

        var tableElement = document.createElement("table");
        tableElement.id = "exportTable";

        data.forEach(function (rowData) {
          var row = tableElement.insertRow();
          rowData.forEach(function (cellData) {
            var cell = row.insertCell();
            cell.textContent = cellData;
          });
        });

        // Creamos un libro de Excel y exportamos los datos con formato
        var ws = XLSX.utils.aoa_to_sheet(data);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, "Reporte");

        // Esto es para evitar la notación científica
        ws["!ref"] =
          "A1:" + String.fromCharCode(64 + headers.length) + (data.length + 1);

        // Esto es para ajustar el ancho de las columnas individualmente
        ws["!cols"] = [
          { wch: 15 }, // Linea
          { wch: 20 }, // Serie
          { wch: 15 }, // Marca
          { wch: 15 }, // Modelo
          { wch: 35 }, // Empleado
          { wch: 15 }, // Contrato
          { wch: 15 }, // Centro de costos
          { wch: 15 }, // Límite
          { wch: 15 }, // Tipo de línea
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Líenas-telefónicas.xlsx");
      }, 2000);
    });
  }
});


/* =======================================================
                IMPRIMIR ACTIVOS EN PDF
======================================================== */

$("#btnImprimirReporteLineas").click(function () {
  var table = $("#tablaLineas").DataTable();
  var nombreReporte = $("#NombreReporteDeLineas").val();
  var series = [];

  table.on("draw.dt", function () {
    var allData = table.rows({ search: "applied" }).data();

    allData.each(function (value) {
      series.push(value[0]);
    });

    setTimeout(function () {

      window.open("extensiones/TCPDF-main/reportes/lineas-reporte.php?nombreReporte="+nombreReporte+"&series="+series, "_blank");
      
    }, 2000); // Esperamos 2 segundos antes de redirigir la información al excel

    table.off("draw.dt"); // Desactivamos este evento draw.dt para evitar que se ejecute varias veces
  });

  table.page.len(-1).draw(); // Mostramos todos los registros en una sola página para que podamos mandar todas las series de todos los registros
});












/* ==============================================================================================================
MÉTODO PARA IMPRIMIR SOLO LAS LÍNEAS QUE SE MUESTRAN EN LA DATATABLE EN UN ARCHIVO DE EXCEL CON EL MÉTODO POST
=============================================================================================================== */
/*
$("#reporteLineas").click(function () {
  var table = $("#tablaLineas").DataTable();
  var series = [];
  var reporte = "lineas";

  table.on("draw.dt", function () {
    var allData = table.rows({ search: "applied" }).data();

    allData.each(function (value) {
      series.push(value[0]);
    });

    var datos = new FormData();
    datos.append("tipoReporte", reporte);
    datos.append("series", JSON.stringify(series));

    setTimeout(function () {
      
      // Send the array "series" and the variable "reporte" to the file "reportesExcel.php" using POST method

      var prueba = "aquí si llega"
      console.log(prueba);

      $.ajax({
        url: "vistas/modulos/reportesExcel.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          console.log("respuesta", respuesta);
        }
      });

    }, 2000); // Wait for 2 seconds before sending the data to the PHP file

    table.off("draw.dt"); // Deactivate the draw.dt event to prevent multiple executions
  });

  table.page.len(-1).draw(); // Show all records in a single page to send all series of all records
});
*/

