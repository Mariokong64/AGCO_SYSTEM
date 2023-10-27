/* ========================================================================================
HACER LA TABLA DE EMPLEADOS DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
=========================================================================================== */

$(".tablaEmpleados").DataTable({
  ajax: "ajax/datatable-empleados.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  columnDefs: [
    {
      targets: [0, 1, 2, 3, 4],
      render: function (data, type, row) {
        if (type === "display") {
          return data.toUpperCase();
        }
        return data;
      },
    },
  ],
});


/* =======================================================
                REVISAR NÚMEROS DE NÓMINA REPETIDOS
======================================================== */

$("#nuevaNomina, #editarNomina").change(function () {
  $(".alert").remove();

  var nomina = $(this).val();
  var datos = new FormData();
  datos.append("validarNomina", nomina);

  $.ajax({
    url: "ajax/empleado.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaNomina, #editarNomina")
          .parent()
          .after('<div class="alert alert-warning">Esa nómina ya existe</div>');
        $("#nuevaNomina, #editarNomina").val("");
      }
    },
  });
});

/* ========================================================
                      EDITAR EMPLEADOS
=========================================================== */

$(".tablaEmpleados tbody").on("click", "button.btnEditarEmpleado", function () {
  var idEmpleado = $(this).attr("idEmpleado");

  console.log("idEmpleado", idEmpleado);

  var datos = new FormData();
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "ajax/empleado.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#idDelEmpleado").val(respuesta["id_empleado"]);
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarApellidoP").val(respuesta["apellido_paterno"]);
      $("#editarApellidoM").val(respuesta["apellido_materno"]);
      $("#editarNomina").val(respuesta["nomina"]);
      $("#editarEmail").val(respuesta["email"]);
      $("#editarEmpleadoDepartamento").val(respuesta["id_departamento"]);
      $("#editarEmpleadoDepartamento").html(respuesta["departamento"]);
      $("#editarEmpleadoPuesto").val(respuesta["id_puesto"]);
      $("#editarEmpleadoPuesto").html(respuesta["puesto"]);
    },
  });
});

/* ========================================================
                      ELIMINAR PRODUCTOS
=========================================================== */

$(".tablaEmpleados tbody").on(
  "click",
  "button.btnEliminarEmpleado",
  function () {
    var idEmpleado = $(this).attr("idEmpleado");

    swal({
      title: "¿Está seguro que quiere eliminar a este empleado?",
      text: "Esta acción no se puede deshacer",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, eliminar",
    }).then(function (result) {
      if (result.value) {
        window.location = "index.php?ruta=empleado&idEmpleado=" + idEmpleado;
      }
    });
  }
);

/* =======================================================
                    FILTROS DEL ENCABEZADO
    ======================================================== */

//Filtro para el nombre del empleado

$("#filtroNombreEmpleado").keyup(function () {
  var table = $("#tablaEmpleados").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el puesto del empleado

$("#filtroPuesto").keyup(function () {
  var table = $("#tablaEmpleados").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el departamento del empleado

$("#filtroDepartamentoEmpleado").keyup(function () {
  var table = $("#tablaEmpleados").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el email del empleado

$("#filtroEmailEmpleado").keyup(function () {
  var table = $("#tablaEmpleados").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el número de nómina del empleado

$("#filtroNomina").keyup(function () {
  var table = $("#tablaEmpleados").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

/* ============================================================
        MÉTODO PARA PASAR LOS REGISTROS A EXCEL CON SheetJS
============================================================== */

document.addEventListener("DOMContentLoaded", function () {
 
  var botonReporteEmpleados = document.getElementById("reporteEmpelados");

  if (botonReporteEmpleados) {
    
    botonReporteEmpleados.addEventListener("click", function () {
      
      var table = $("#tablaEmpleados").DataTable(); 

      // Obtenemos todos los datos de la DataTable
      table.page.len(-1).draw(); // Mostramos todos los registros en una sola página

      // Le ponemos este timer para dejar que los datos de la tabla se muestren en una sola página antes de mandarlos al excel
      setTimeout(function () {
        var allData = table.rows({ search: "applied" }).data();
        var data = [];

        var headerRow = table.table().header().querySelectorAll("th"); 
        var headers = [];
        headerRow.forEach(function (th) {
          // AgregaMOS encabezados excepto "Acciones"
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
          { wch: 25 }, // Nombre
          { wch: 20 }, // Apellido Paterno
          { wch: 20 }, // Apellido Materno
          { wch: 40 }, // Puesto
          { wch: 30 }, // Departamento
          { wch: 30 }, // Email
          { wch: 10 }, // Nomina
          { wch: 15 }, // Activos
    
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Empleados.xlsx");
      }, 2000);
    });
  }
});


/* =======================================================
MÉTODO PARA IMPRIMIR EL REPORTE EN PDF
======================================================= */

$("#btnImprimirReporteEmpleados").click(function () {
  var table = $("#tablaEmpleados").DataTable();
  var data = table.rows({ search: "applied" }).data();
  var series = [];

  for (var i = 0; i < data.length; i++) {
    series.push(data[i][6]);
  }

  var nombreReporte = $("#NombreReporteDeEmpleados").val();

  window.open(
    "extensiones/TCPDF-main/reportes/Empleados-reporte.php?nombreReporte=" +
      nombreReporte +
      "&series=" +
      series,
    "_blank"
  );
});
