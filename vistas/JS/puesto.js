/* =======================================================
                REVISAR PUESTOS REPETIDOS
======================================================== */

$("#nuevoPuesto, #editarPuesto").change(function () {
  $(".alert").remove();

  var puesto = $(this).val();
  var datos = new FormData();
  datos.append("validarPuesto", puesto);

  $.ajax({
    url: "ajax/puesto.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoPuesto, #editarPuesto")
          .parent()
          .after('<div class="alert alert-warning">Ese puesto ya existe</div>');
        $("#nuevoPuesto, #editarPuesto").val("");
      }
    },
  });
});

/* =======================================================
                          EDITAR PUESTO
      ======================================================== */

$(document).on("click", ".btnEditarPuesto", function () {
  var idPuesto = $(this).attr("idPuesto");

  var datos = new FormData();

  datos.append("idPuesto", idPuesto);

  $.ajax({
    url: "ajax/puesto.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarPuesto").val(respuesta["puesto"]);
      $("#idPuesto").val(respuesta["id_puesto"]);
    },
  });
});

/* =======================================================
                      ELIMINAR PUESTO
      ======================================================== */

$(document).on("click", ".btnEliminarPuesto", function () {
  var idPuesto = $(this).attr("idPuesto");

  swal({
    title: "¿Está seguro que quiere eliminar este puesto?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=puesto&idPuesto=" + idPuesto;
    }
  });
});


/*---------------------------------------------------
    FUNCIÓN CREAR EL REPORTE DE EXCEL SON SheetJS
----------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {
  
  var botonReportePuestos = document.getElementById("reportePuestos");

  if (botonReportePuestos) {
   
    botonReportePuestos.addEventListener("click", function () {
     
      var table = $("#tablaPuestos").DataTable(); 

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
          { wch: 60 }, // Puesto
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Puestos.xlsx");
      }, 2000);
    });
  }
});
