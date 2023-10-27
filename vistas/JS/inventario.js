/* =========================================================================================================
         REVISAR NÚMEROS DE SERIE REPETIDOS (ESTA FUNCIÓN AFECTA A TODOS LOS MÓDULOS DEL INVENTARIO)
============================================================================================================ */

$("#nuevaSerie, #editarSerie").change(function () {
  $(".alert").remove();

  var serie = $(this).val();
  var datos = new FormData();
  datos.append("validarSerie", serie);

  $.ajax({
    url: "ajax/inventario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevaSerie")
          .parent()
          .after(
            '<div class="alert alert-warning">Ese número de serie ya existe</div>'
          );
        $("#nuevaSerie").val("");
      }
    },
  });
});

/* =============================================================================================
  HACER QUE ESTA TABLA DEL INVENTARIO RÁPIDO CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDO
================================================================================================ */

$(document).ready(function () {
  var tablaInventario = $(".tablaInventario").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/inventarioCompleto.serverside.php",
    columnDefs: [

      //Aquí vamos a hacer que en la cuarta columna se coloque "SI" en caso de que el valor de la BD sea 1 y "NO" en caso de que sea 0

      {
        targets: 5,
        render: function (data, type, row, meta) {
          if (data == 1) {
            return "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 45px;'><i></i>SI</button></div>";
          } else {
            return "<div class='btn-group'><button class='btn bg-gray btnEstadoAF'style='width: 45px;'><i></i>NO</button></div>";
          }
        },
      },

      //Aquí vamos a hacer que en la quinta columna se coloque un botón del color dependiendo del estado del activo

      {
        targets: 4,
        render: function (data, type, row, meta) {
          
          //Aqui empiezan los if y else if para poner los botones (no utilicé un switch porque por alguna razón no funcionan en el servidor, pero en mi computadora si)

          var value = parseInt(data);

          switch (value) {

            case 1: return "<div class='btn-group'><button class='btn btn-success' style='width: 125px;'><i></i>ACTIVO</button></div>";

            case 2: return "<div class='btn-group'><button class='btn bg-gray' style='width: 125px;'><i></i>INACTIVO</button></div>";

            case 3: return "<div class='btn-group'><button class='btn btn-warning' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";

            case 4: return "<div class='btn-group'><button class='btn btn-info' style='width: 125px;'><i></i>DONACIÓN</button></div>";

            case 5: return "<div class='btn-group'><button class='btn btn-github' style='width: 125px;'><i></i>SCRAP</button></div>";

            default: return "NA";

          }

          //Aqui terminan los if y else if
        },
      },
    ],

    //Aqui hacemos que los botones de editar o eliminar desaparezcan o aparezcan segun el perfil del usuario

    createdRow: function (row, data, dataIndex) {
      //cambios

      if (perfil == "Administrador") {
       
      } else if (perfil == "Soporte") {
        $(row).find(".btnEliminarAF").remove();
      } else {
        $(row).find(".cell-actions").empty();
      }

      //Aquí hacemos que en los botones de editar y eliminar de la última columna se les ponda el número de serie del activo que está en la misma fila

      var idInventario = data[0]; // Aquí obtenemos el ID del registro
      $(row).find(".btnEditarAF").attr("idInventario", idInventario);
      $(row).find(".btnEliminarAF").attr("idInventario", idInventario);

      //AQUÍ INICIA EL EVENTO PARA EDITAR LOS REGISTROS

      $(row)
        .find(".btnEditarAF")
        .on("click", function () {
          var idInventario = $(this).attr("idInventario");

          var datos = new FormData();
          datos.append("idInventario", idInventario);

          $.ajax({
            url: "ajax/inventario.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
              console.log(respuesta);
              $("#editarSerie").val(respuesta["serie"]);
              $("#idDelInventario").val(respuesta["id_inventario"]);
              $("#editarFactura").val(respuesta["factura"]);
              $("#editarTipo").val(respuesta["id_tipo"]);
              $("#editarTipo").html(respuesta["tipo"]);
              $("#editarMarca").val(respuesta["id_marca"]);
              $("#editarMarca").html(respuesta["marca"]);
              $("#editarModelo").val(respuesta["id_modelo"]);
              $("#editarModelo").html(respuesta["modelo"]);
              $("#editarEstatus").val(respuesta["id_estatus"]);
              $("#editarEstatus").html(respuesta["estatus"]);
              $("#editarFechaCompra").val(respuesta["fecha_ingreso"]);
              $("#editarFechaVencimiento").val(respuesta["fecha_vencimiento"]);
              $("#editarDetalle").val(respuesta["detalles"]);
              $("#editarNumero").val(respuesta["numero_tel"]);
              $("#editarImei").val(respuesta["imei"]);
              $("#editarCelEmail").val(respuesta["email_cel"]);
              $("#editarMac").val(respuesta["mac_tel"]);
              $("#editarContrato").val(respuesta["contrato"]);
              $("#editarIP").val(respuesta["ip"]);
              $("#editarHostName").val(respuesta["host_name"]);
              $("#editarEstado").val(respuesta["id_estado"]);
              $("#estadoAnterior").val(respuesta["id_estado"]);
              $("#editarUbicacion").val(respuesta["id_ubicacion"]);
              $("#editarUbicacion").html(respuesta["ubicacion"]);
              $("#editarPosicion").val(respuesta["posicion"]);
            },
          });
          // AQUÍ TERMINA EL EVENTO PARA EDITAR LOS REGISTROS
        });

      // AQUÍ INICIA EL EVENTO PARA ELIMINAR LOS REGISTROS

      $(row)
        .find(".btnEliminarAF")
        .on("click", function () {
          var idInventario = $(this).attr("idInventario");

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
                "index.php?ruta=inventario&idInventario=" + idInventario;
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

$("#filtroSerieGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el modelo del activo fijo

$("#filtroModeloGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la marca del activo fijo

$("#filtroMarcaGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el tipo de activo fijo

$("#filtroTipoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el estado del activo fijo

$("#filtroEstadoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  var searchValue = this.value.toLowerCase();

  if(searchValue === "activo"){
    searchValue = "1";
  }
  else if(searchValue === "inactivo"){
    searchValue = "2";
  }
  else if(searchValue === "mantenimiento"){
    searchValue = "3";
  }
  else if(searchValue === "donacion"){
    searchValue = "4";
  }
  else if(searchValue === "scrap"){
    searchValue = "5";
  }

  table.column($(this).data("index")).search(searchValue).draw();
});

//Filtro para si esta asignado o no

$("#filtroAsignadoGeneral").on("keyup", function () {
  var table = $("#tablaInventario").DataTable();
  var searchValue = this.value.toLowerCase();

  if (searchValue === "si") {
    searchValue = "1";
  } else if (searchValue === "no") {
    searchValue = "0";
  }

  table.column($(this).data("index")).search(searchValue).draw();
});

//Filtro para el departamento del activo fijo

$("#filtroDepartamentoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la ubicación del activo fijo

$("#filtroUbicacionGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber la posición del activo fijo

$("#filtroPosicionGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber que empleado tiene asignado el activo fijo

$("#filtroEmpleadoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el uso que se le está dando al activo fijo

$("#filtroUsoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el estatus del activo fijo

$("#filtroEstatusGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber la factura del activo fijo

$("#filtroFacturaGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber el host name del activo fijo

$("#filtroHostGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber el número de teléfono del activo fijo

$("#filtroTelefonoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber el IMEI del activo fijo

$("#filtroImeiGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber el email del activo fijo

$("#filtroEmailGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber el número de contrato del activo fijo

$("#filtroContratoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber la MAC del activo fijo

$("#filtroMacGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtros para saber la IP del activo fijo

$("#filtroIpGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber la fecha de adquisición del activo fijo

$("#filtroAdquisicionGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber la fecha de vencimiento del activo fijo (en caso de ser arrendado)

$("#filtroVencimientoGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro de la fecha de registro del activo fijo

$("#filtroRegistroGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber los detalles del activo fijo

$("#filtroDetallesGeneral").keyup(function () {
  var table = $("#tablaInventario").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

/* ============================================================
        MÉTODO PARA PASAR LOS REGISTROS A EXCEL CON SheetJS
============================================================== */

document.addEventListener("DOMContentLoaded", function () {
 
  var botonReporteCompleto = document.getElementById("reporteCompleto");

  if (botonReporteCompleto) {
    botonReporteCompleto.addEventListener("click", function () {
      var table = $("#tablaInventario").DataTable();

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
          // Reemplazamos 1 con "SI" y 0 con "NO" en la columna "Asignado"
          var asignadoIndex = headers.indexOf("Asignado");
          if (asignadoIndex !== -1) {
            rowData[asignadoIndex] = rowData[asignadoIndex] == "1" ? "SI" : "NO";
          }

          // Cambiamos los valores numéricos en la columna "Estado"
          var estadoIndex = headers.indexOf("Estado");
          if (estadoIndex !== -1) {
            switch (rowData[estadoIndex]) {
              case 1:
                rowData[estadoIndex] = "Activo";
                break;
              case 2:
                rowData[estadoIndex] = "Inactivo";
                break;
              case 3:
                rowData[estadoIndex] = "Mantenimiento";
                break;
              case 4:
                rowData[estadoIndex] = "Donación";
                break;
              case 5:
                rowData[estadoIndex] = "Scrap";
                break;
              default:
                rowData[estadoIndex] = ""; 
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
          { wch: 15 }, // Serie
          { wch: 15 }, // Modelo
          { wch: 12 }, // Marca
          { wch: 12 }, // Tipo
          { wch: 10 }, // Estado
          { wch: 10 }, // Asignado
          { wch: 30 }, // Departamento
          { wch: 10 }, // Ubicación
          { wch: 10 }, // Posición
          { wch: 40 }, // Empleado
          { wch: 10 }, // Uso
          { wch: 15 }, // Estatus
          { wch: 10 }, // Factura
          { wch: 18 }, // Hostname
          { wch: 10 }, // Teléfono
          { wch: 15 }, // IMEI
          { wch: 30 }, // Email
          { wch: 15 }, // Contrato
          { wch: 15 }, // MAC
          { wch: 15 }, // IP
          { wch: 15 }, // Adquisición
          { wch: 15 }, // Vencimiento
          { wch: 15 }, // Registro
          { wch: 15 }, // Detalles
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Completo.xlsx");
      }, 2000);
    });
  }
});