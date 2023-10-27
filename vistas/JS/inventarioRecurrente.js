/* =============================================================================================
  HACER QUE ESTA TABLA DEL INVENTARIO RÁPIDO CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDO
================================================================================================ */

$(document).ready(function () {
  $(".tablaInventarioRecurrente").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/inventarioRecurrente.serverside.php",
    columnDefs: [
      //Aquí vamos a hacer que en la cuarta columna se coloque "SI" en caso de que el valor de la BD sea 1 y "NO" en caso de que sea 0
      {
        targets: 4,
        render: function (data, type, row, meta) {
          if (data == 1) {
            return "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 45px;'><i></i>SI</button></div>";
          } else {
            return "<div class='btn-group'><button class='btn bg-gray btnEstadoAF'style='width: 45px;'><i></i>NO</button></div>";
          }
        },
      },
    ],
  });
});


/* =======================================================
                    FILTROS DEL ENCABEZADO
    ======================================================== */

//Filtro para el número de serie

$("#filtroSerieRecurrente").keyup(function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    table.column($(this).data("index")).search(this.value).draw();
  });
  
  //Filtro para el tipo
  
  $("#filtroTipoRecurrente").keyup(function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    table.column($(this).data("index")).search(this.value).draw();
  });
  
  //Filtro para la marca
  
  $("#filtroMarcaRecurrente").keyup(function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    table.column($(this).data("index")).search(this.value).draw();
  });
  
  //Filtro para el modelo
  
  $("#filtroModeloRecurrente").keyup(function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    table.column($(this).data("index")).search(this.value).draw();
  });
  
  //Filtro para si esta asignado o no
  
  $("#filtroAsignadoRecurrente").on("keyup", function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    var searchValue = this.value.toLowerCase();
  
    if (searchValue === "si" || searchValue === "SI") {
      searchValue = "1";
    } else if (searchValue === "no" || searchValue === "NO") {
      searchValue = "0";
    }
  
    table.column($(this).data("index")).search(searchValue).draw();
  });
  
  //Filtro para el empleado asignado
  
  $("#filtroEmpleadoRecurrente").keyup(function () {
    var table = $("#tablaInventarioRecurrente").DataTable();
    table.column($(this).data("index")).search(this.value).draw();
  });


/* ============================================================
        MÉTODO PARA PASAR LOS REGISTROS A EXCEL CON SheetJS
============================================================== */

document.addEventListener("DOMContentLoaded", function () {
 
    var botonReporte = document.getElementById("reporteRecurrente");
  
    if (botonReporte) {
      botonReporte.addEventListener("click", function () {
        var table = $("#tablaInventarioRecurrente").DataTable();
  
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
  
            // Reemplazamos 1 con "SI" y 0 con "NO" en la columna "Asignado"
            var asignadoIndex = headers.indexOf("Asignado");
            if (asignadoIndex !== -1) {
              rowData[asignadoIndex] = rowData[asignadoIndex] == "1" ? "SI" : "NO";
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
            { wch: 20 }, // Tipo
            { wch: 20 }, // Marca
            { wch: 20 }, // Modelo
            { wch: 10 }, // Asignado
            { wch: 45 }, // Empleado
            { wch: 45 }, // Detalles
          ];
  
          // Exportamos el libro de Excel con un nombre de archivo específico
          XLSX.writeFile(wb, "Reporte de activos.xlsx");
        }, 2000);
      });
    }
  });  
