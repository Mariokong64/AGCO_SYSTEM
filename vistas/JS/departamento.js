/* =======================================================
                REVISAR DEPARTAMENTOS REPETIDOS
======================================================== */

$("#nuevoDepartamento, #editarDepartamento").change(function () {
  $(".alert").remove();

  var departamento = $(this).val();
  var datos = new FormData();
  datos.append("validarDepartamento", departamento);

  $.ajax({
    url: "ajax/departamento.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoDepartamento, #editarDepartamento")
          .parent()
          .after(
            '<div class="alert alert-warning">Ese departamento ya existe</div>'
          );
        $("#nuevoDepartamento, #editarDepartamento").val("");
      }
    },
  });
});

/* =======================================================
                        EDITAR DEPARTAMENTOS
    ======================================================== */

$(document).on("click", ".btnEditarDepartamento", function () {
  var idDepartamento = $(this).attr("idDepartamento");

  var datos = new FormData();

  datos.append("idDepartamento", idDepartamento);

  $.ajax({
    url: "ajax/departamento.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarDepartamento").val(respuesta["departamento"]);
      $("#editarCC").val(respuesta["centro_costos"]);
      $("#idActual").val(respuesta["id_departamento"]);
    },
  });
});

/* =======================================================
                    ELIMINAR DEPARTAMENTO
    ======================================================== */

$(document).on("click", ".btnEliminarDepartamento", function () {
  var idDepartamento = $(this).attr("idDepartamento");

  swal({
    title: "¿Está seguro que quiere eliminar este departamento?",
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
        "index.php?ruta=departamento&idDepartamento=" + idDepartamento;
    }
  });
});

/* =======================================================
                    FILTROS DEL ENCABEZADO
    ======================================================== */

//Filtro para el nombre del departamento

$("#filtroDepartamento").keyup(function () {
  var table = $("#tablaDepartamentos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el centro de costos

$("#filtroCentroCostos").keyup(function () {
  var table = $("#tablaDepartamentos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});



/*---------------------------------------------------
    FUNCIÓN CREAR EL REPORTE DE EXCEL SON SheetJS
----------------------------------------------------*/

document.addEventListener("DOMContentLoaded", function () {

  var botonReporteDepartamentos = document.getElementById("reporteDepartamentos");

  if (botonReporteDepartamentos) {
  
    botonReporteDepartamentos.addEventListener("click", function () {
      
      var table = $("#tablaDepartamentos").DataTable();

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
          { wch: 40 }, // Puesto
          { wch: 15 }, // Centro Costos
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Departamentos.xlsx");
      }, 2000);
    });
  }
});