/* =======================================================
                REVISAR CATEGORIAS REPETIDAS
======================================================== */

$("#nuevaCategoria, #editarCategoria").change(function () {
  $(".alert").remove();

  var categoria = $(this).val();
  var datos = new FormData();
  datos.append("validarCategoria", categoria);

  $.ajax({
    url: "ajax/categoria.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaCategoria, #editarCategoria")
          .parent()
          .after(
            '<div class="alert alert-warning">Esa categoría ya existe</div>'
          );
        $("#nuevaCategoria, #editarCategoria").val("");
      }
    },
  });
});

/* =======================================================
                    EDITAR CATEGORIAS
======================================================== */

$(document).on("click", ".btnEditarCategoria", function () {
  var idCategoria = $(this).attr("idCategoria");

  var datos = new FormData();

  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categoria.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarCategoria").val(respuesta["tipo"]);
      $("#idCategoria").val(respuesta["id_tipo"]);
    },
  });
});

/* =======================================================
                ELIMINAR CATEGORIA
======================================================== */

$(document).on("click", ".btnEliminarCategoria", function () {
  var idCategoria = $(this).attr("idCategoria");

  swal({
    title: "¿Está seguro que quiere eliminar esta categoría?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=categoria&idCategoria=" + idCategoria;
    }
  });
});

/*---------------------------------------------------
    FUNCIÓN CREAR EL REPORTE DE EXCEL SON SheetJS
----------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {

  var botonReporteCategorias = document.getElementById("reporteCategorias");

  if (botonReporteCategorias) {
    
    botonReporteCategorias.addEventListener("click", function () {
      
      var table = $("#tablaCategorias").DataTable(); 

      // Obtenemos todos los datos de la DataTable
      table.page.len(-1).draw(); // Mostramos todos los registros en una sola página

      // Le ponemos este timer para dejar que los datos de la tabla se muestren en una sola página antes de mandarlos al excel
      setTimeout(function () {
        var allData = table.rows({ search: "applied" }).data();
        var data = [];

        // Agrega una fila de encabezado
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
          { wch: 35 }, // Puesto
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Categorias.xlsx");
      }, 2000);
    });
  }
});