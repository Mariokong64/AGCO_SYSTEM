/* =============================================================================================
  HACER QUE ESTA TABLA DEL INVENTARIO RÁPIDO CARGUE DESDE EL SERVERSIDE Y SEA MUCHO MÁS RÁPIDO
================================================================================================ */

$(document).ready(function () {
  $(".tablaInventarioTelefonos").DataTable({
    processing: true,
    serverSide: true,
    sAjaxSource: "serverside/inventarioTelefonos.serverside.php",

    columnDefs: [

      // Aquí vamos a hacer que en la última columna se pongan los botones de editar y eliminar

     {
        targets: -1,
        data: null,
        defaultContent:
        "<div class='btn-group'><button class='btn btn-warning btnEditarAF' idInventario='' data-toggle='modal' data-target='#modalEditarAF' style='margin-left: 3px;'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarAF' idInventario='' style='margin-left: 3px;'><i class='fa  fa-trash-o'></i></button></div>",

        createdCell: function (cell, cellData, rowData, rowIndex, colIndex) {
          $(cell).addClass("cell-actions"); // Agregamos una clase a la celda para identificarla posteriormente
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

      //Aquí vamos a hacer que en la quinta columna aparezca como "No asignado" en dado caso de que venga un valor nulo.

      {
        targets: 8,
        render: function (data, type, row, meta) {
          return data == null ? "NO ASIGNADO" : data;
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
            url: "ajax/inventarioTelefonos.ajax.php",
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
              $("#editarUbicacion").val(respuesta["id_ubicacion"]);
              $("#editarUbicacion").html(respuesta["ubicacion"]);
              $("#editarPosicion").val(respuesta["posicion"]);
              $("#editarEstado").val(respuesta["id_estado"]);
              $("#estadoAnterior").val(respuesta["id_estado"]);
              $("#editarContrato").val(respuesta["contrato"]);
              $("#editarNumero").val(respuesta["numero_tel"]);
              $("#editarImei").val(respuesta["imei"]);
              $("#editarCelEmail").val(respuesta["email_cel"]);
              $("#editarMac").val(respuesta["mac_tel"]);
              $("#editarDetalle").val(respuesta["detalles"]);
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
              "index.php?ruta=inventarioTelefonos&idInventario=" + idInventario;
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

$("#filtroSerieTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el tipo de activo fijo

$("#filtroTipoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la marca del activo fijo

$("#filtroMarcaTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para el modelo del activo fijo

$("#filtroModeloTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el estado del activo fijo

$("#filtroEstadoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
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

$("#filtroAsignadoTelefono").on("keyup", function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  var searchValue = this.value.toLowerCase();

  if (searchValue === "si") {
    searchValue = "1";
  } else if (searchValue === "no") {
    searchValue = "0";
  }

  table.column($(this).data("index")).search(searchValue).draw();
});

//Filtro para el departamento del activo fijo

$("#filtroDepartamentoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la ubicación del activo fijo

$("#filtroUbicacionTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber que empleado tiene asignado el activo fijo

$("#filtroEmpleadoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el número de teléfono del activo fijo

$("#filtroTelefonoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el IMEI del activo fijo

$("#filtroImeiTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el correo electrónico del activo fijo

$("#filtroEmailTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para saber el número de contrato del activo fijo

$("#filtroContratoTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

//Filtro para la MAC del activo fijo

$("#filtroMacTelefono").keyup(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  table.column($(this).data("index")).search(this.value).draw();
});

/* ============================================================
        MÉTODO PARA PASAR LOS REGISTROS A EXCEL CON SheetJS
============================================================== */

document.addEventListener("DOMContentLoaded", function () {
  
  var botonReporteTelefonos = document.getElementById("reporteTelefonos");

  if (botonReporteTelefonos) {
    botonReporteTelefonos.addEventListener("click", function () {
      var table = $("#tablaInventarioTelefonos").DataTable();

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
          { wch: 20 }, // Serie
          { wch: 15 }, // Tipo
          { wch: 15 }, // Marca
          { wch: 15 }, // Modelo
          { wch: 10 }, // Estado
          { wch: 10 }, // Asignado
          { wch: 30 }, // Departamento
          { wch: 10 }, // Ubicación
          { wch: 40 }, // Empleado
          { wch: 15 }, // Teléfono
          { wch: 15 }, // IMEI
          { wch: 20 }, // Email
          { wch: 15 }, // Contrato
          { wch: 15 }, // MAC
        ];

        // Exportamos el libro de Excel con un nombre de archivo específico
        XLSX.writeFile(wb, "Reporte-Teléfonos.xlsx");
      }, 2000);
    });
  }
});






/* =======================================================
                IMPRIMIR ACTIVOS EN PDF
======================================================== */

$("#btnImprimirReporteTel").click(function () {
  var table = $("#tablaInventarioTelefonos").DataTable();
  var nombreReporte = $("#NombreReporteDeTelefonos").val();
  var series = [];

  table.on("draw.dt", function () {
    var allData = table.rows({ search: "applied" }).data();

    allData.each(function (value) {
      series.push(value[0]);
    });

    setTimeout(function () {

      window.open("extensiones/TCPDF-main/reportes/inventarioTel-reporte.php?nombreReporte="+nombreReporte+"&series="+series, "_blank");
      
    }, 2000); // Esperamos 2 segundos antes de redirigir la información al excel

    table.off("draw.dt"); // Desactivamos este evento draw.dt para evitar que se ejecute varias veces
  });

  table.page.len(-1).draw(); // Mostrar todos los registros en una sola página para que podamos mandar todas las series de todos los registros
});