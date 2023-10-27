/* ================================================================================================
HACEMOS LA TABLA DE RENOVACIONES DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
================================================================================================= */

document.addEventListener("DOMContentLoaded", function () {
  var guardarActivoFijoBtn = document.getElementById("generarRenovaciones");

  if(!guardarActivoFijoBtn){return;}

  guardarActivoFijoBtn.addEventListener("click", function (e) {
    e.preventDefault();

    //Obtenemos el valor de las variables que puso el usuario en el modal
    var añosSumar = document.getElementById("añosSumar").value;
    var tipoRenovacion = document.getElementById("tipoRenovacion").value;
    var añosMaximos = document.getElementById("añosMaximos").value;

    // Realizamos una solicitud Ajax para obtener los datos con la variable añosSumar
    $.ajax({
      url: "ajax/datatable-renovaciones.ajax.php",
      type: "POST",
      data: { añosSumar: añosSumar, tipoRenovacion: tipoRenovacion, añosMaximos: añosMaximos},
      success: function (respuesta) {
        // Destruimos la tabla existente
        $(".tablaRenovaciones").DataTable().destroy();
      
        // Iniciamos otra tabla con los nuevos datos
        $(".tablaRenovaciones").DataTable({
          ajax: {
            url: "ajax/datatable-renovaciones.ajax.php",
            type: "POST",
            data: { añosSumar: añosSumar, tipoRenovacion: tipoRenovacion, añosMaximos: añosMaximos},
          },
          columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 },
            { data: 7 },
            { data: 8 },
            { data: 9 },
          ],
        });
        console.log(respuesta);
      },
      error: function (error) {
        console.error("Error en la solicitud Ajax:", error);
      },
    });
    $("#modalRenovaciones").modal("hide");
  });
});


/* ================================================
     FILTROS PARA LAS COLUMNAS DE LAS DATATABLES
================================================= */

//Filtro para el número de serie

$("#filtroSerieRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el tipo de activo fijo

$("#filtroTipoRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la marca de activo fijo

$("#filtroMarcaRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el modelo de activo fijo

$("#filtroModeloRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para ver si esta asignado o no el activo fijo

$("#filtroAsignadoRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el estado del activo fijo

$("#filtroEstadoRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  var filtro = "^" + this.value;
  table.column($(this).data("index")).search(filtro, true, false).draw();
});

//Filtro para el estatus del activo fijo

$("#filtroEstatusRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la fecha de compra del activo fijo

$("#filtroFechaCompraRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la fecha de vencimiento del activo fijo

$("#filtroVencimientoRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la fecha de renovación del activo fijo

$("#filtrofechaRenovaciones").keyup(function () {
  var table = $("#tablaRenovaciones").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});


/* ====================================================================
   MÉTODO PARA IMPRIMIR SOLO LOS REGISTROS DEL DATATABLE EN UN EXCEL
==================================================================== */

document.addEventListener("DOMContentLoaded", function () {
  
  var botonReporteCompleto = document.getElementById("reporteRenovacionesExcel");

  if (botonReporteCompleto) {
    
    botonReporteCompleto.addEventListener("click", function () {
      
      var table = $("#tablaRenovaciones").DataTable(); 

      // Obtenemos todos los datos de la DataTable
      table.page.len(-1).draw(); // Mostramos todos los registros en una sola página

      // Le ponemos este timer para dejar que los datos de la tabla se muestren en una sola página antes de mandarlos al excel
      setTimeout(function () {
        var allData = table.rows({ search: "applied" }).data(); 
        var data = []; 

        var headerRow = table.table().header().querySelectorAll("th"); // Obtiene los encabezados de la tabla
        var headers = [];

        headerRow.forEach(function (th) {
          // Agregamos encabezados excepto "Acciones"
          if (th.textContent !== "Acciones") {
            headers.push(th.textContent);
          }
        });
        data.push(headers);

        
        allData.each(function (rowData) {

          // Reemplaza 1 con "SI" y 0 con "NO" en la columna "Asignado"
          var asignadoIndex = headers.indexOf("Asignado");
          if (asignadoIndex !== -1) {
            rowData[asignadoIndex] =
              rowData[asignadoIndex] == "1" ? "SI" : "NO";
          }

          // Cambia los valores numéricos en la columna "Estado"
          var estadoIndex = headers.indexOf("Estado");
          if (estadoIndex !== -1) {
            switch (rowData[estadoIndex]) {
              case "<div class='btn-group'><button class='btn btn-success btnEstadoAF' idEstadoAF='1' style='width: 125px;'><i></i>ACTIVO</button></div>":
                rowData[estadoIndex] = "Activo";
                break;
              case "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' idEstadoAF='2' style='width: 125px;'><i></i>INACTIVO</button></div>":
                rowData[estadoIndex] = "Inactivo";
                break;
              case "<div class='btn-group'><button class='btn btn-warning btnEstadoAF' idEstadoAF='3' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>":
                rowData[estadoIndex] = "Mantenimiento";
                break;
              case "<div class='btn-group'><button class='btn btn-info btnEstadoAF' idEstadoAF='4' style='width: 125px;'><i></i>DONACIÓN</button></div>":
                rowData[estadoIndex] = "Donación";
                break;
              case "<div class='btn-group'><button class='btn btn-github btnEstadoAF' idEstadoAF='5' style='width: 125px;'><i></i>SCRAP</button></div>":
                rowData[estadoIndex] = "Scrap";
                break;
              default:
                rowData[estadoIndex] = ""; // Esto no debería suceder
                break;
            }
          }
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
          { wch: 25 }, // Serie
          { wch: 15 }, // Tipo
          { wch: 15 }, // Marca
          { wch: 18 }, // Modelo
          { wch: 12 }, // Asignado
          { wch: 15 }, // Estado
          { wch: 15 }, // Estatus
          { wch: 15 }, // Fecha de compra
          { wch: 15 }, // Fecha de vencimiento
          { wch: 15 }, // Fecha de renovación
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Renovaciones.xlsx");
      }, 2000); 
    });
  }
});