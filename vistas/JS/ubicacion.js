/* =======================================================
                REVISAR UBICACIONES REPETIDAS
======================================================== */

$("#nuevaUbicacion").change(function () {
  $(".alert").remove();

  var marca = $(this).val();
  var datos = new FormData();
  datos.append("validarUbicacion", marca);

  $.ajax({
    url: "ajax/ubicacion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaUbicacion")
          .parent()
          .after(
            '<div class="alert alert-warning">Esa ubicación ya existe</div>'
          );
        $("#nuevaUbicacion").val("");
      }
    },
  });
});

/* =======================================================
                          EDITAR UBICACION
      ======================================================== */

$(document).on("click", ".btnEditarUbicacion", function () {
  var idUbicacion = $(this).attr("idUbicacion");

  var datos = new FormData();

  datos.append("idUbicacion", idUbicacion);

  $.ajax({
    url: "ajax/ubicacion.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarUbicacion").val(respuesta["ubicacion"]);
      $("#idUbicacion").val(respuesta["id_ubicacion"]);
    },
  });
});

/* =======================================================
                      ELIMINAR UBICACIONES
      ======================================================== */

$(document).on("click", ".btnEliminarUbicacion", function () {
  var idUbicacion = $(this).attr("idUbicacion");

  swal({
    title: "¿Está seguro que quiere eliminar esta ubicación?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=ubicacion&idUbicacion=" + idUbicacion;
    }
  });
});

/*---------------------------------------------------
    FUNCIÓN CREAR EL REPORTE DE EXCEL SON SheetJS
----------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {
  
  var botonReporteUbicaciones = document.getElementById("reporteUbicaciones");

  if (botonReporteUbicaciones) {
    
    botonReporteUbicaciones.addEventListener("click", function () {
      
      var table = $("#tablaUbicaciones").DataTable(); // Inicializa una tabla DataTable

      // Obtenemos todos los datos de la DataTable
      table.page.len(-1).draw(); // Mostramos todos los registros en una sola página

      // Le ponemos este timer para dejar que los datos de la tabla se muestren en una sola página antes de mandarlos al excel
      setTimeout(function () {
        var allData = table.rows({ search: "applied" }).data();
        var data = []; 
        var headerRow = table.table().header().querySelectorAll("th");
        var headers = [];

        headerRow.forEach(function (th) {
          // Agregamos los encabezados excepto "Acciones"
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
          { wch: 35 }, // Puesto
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Ubicaciones.xlsx");
      }, 2000); 
    });
  }
});