/* =======================================================
                REVISAR MODELOS REPETIDOS
======================================================== */

$("#nuevoModelo, #editarModelo").change(function () {
  $(".alert").remove();

  var modelo = $(this).val();
  var datos = new FormData();
  datos.append("validarModelo", modelo);

  $.ajax({
    url: "ajax/modelo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoModelo, #editarModelo")
          .parent()
          .after('<div class="alert alert-warning">Ese modelo ya existe</div>');
        $("#nuevoModelo, #editarModelo").val("");
      }
    },
  });
});

/* =======================================================
                      EDITAR MODELOS
  ======================================================== */

$(document).on("click", ".btnEditarModelo", function () {
  var idModelo = $(this).attr("idModelo");

  var datos = new FormData();

  datos.append("idModelo", idModelo);

  $.ajax({
    url: "ajax/modelo.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarModelo").val(respuesta["modelo"]);
      $("#idModelo").val(respuesta["id_modelo"]);
    },
  });
});

/* =======================================================
                  ELIMINAR MODELOS
  ======================================================== */

$(document).on("click", ".btnEliminarModelo", function () {
  var idModelo = $(this).attr("idModelo");

  swal({
    title: "¿Está seguro que quiere eliminar este modelo?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=modelo&idModelo=" + idModelo;
    }
  });
});

/*---------------------------------------------------
    FUNCIÓN CREAR EL REPORTE DE EXCEL SON SheetJS
----------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {
  
  var botonReporteModelos = document.getElementById("reporteModelos");

  if (botonReporteModelos) {
   
    botonReporteModelos.addEventListener("click", function () {
     
      var table = $("#tablaModelos").DataTable(); 

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
          { wch: 5 }, // Número
          { wch: 45 }, // Puesto
        ];

        // Exporta el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Modelos.xlsx");
      }, 2000); 
    });
  }
});