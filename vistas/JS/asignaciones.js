/* ========================================================================================
HACER LA TABLA DE EMPLEADOS DINÁMICA PARA QUE CARGUE LA INFO POR BLOQUES Y NO SE HAGA LENTA
=========================================================================================== */

$(".tablaAsignaciones").DataTable({
  ajax: "ajax/datatable-asignaciones.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  columnDefs: [
    {
      targets: [0, 1, 2, 3],
      render: function (data, type, row) {
        if (type === "display") {
          return data.toUpperCase();
        }
        return data;
      },
    },
  ],
});

/* ========================================================================================
  HACER QUE LOS ACTIVOS VAYAN APARECIENDO A UN LADO DE LA TABLA CONFORME SE VAN ESCOGIENDO
=========================================================================================== */

$(".tablaAsignaciones tbody").on("click", "button.agregarActivo", function () {
  var idActivo = $(this).attr("idAF");
  /* console.log("idAF", idActivo); */

  $(this).removeClass("btn-primary agregarActivo");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idInventarioAsignar", idActivo);

  $.ajax({
    url: "ajax/inventario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
       console.log("respuesta", respuesta);

      var serie = respuesta["serie"];
      var idTipo = respuesta["id_tipo"];
      var idModelo = respuesta["id_modelo"];

      var datos = new FormData();
      datos.append("idCategoria", idTipo);

      $.ajax({
        url: "ajax/categoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",

        success: function (respuesta) {
          var tipo = respuesta["tipo"];

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
              var modelo = respuesta["modelo"];

              $(".nuevoActivo").append(

                '<div class="row" style="padding: 5px 15px ">' +

                  '<div class="col-sm-4">' +

                    '<div class="input-group">' +

                      '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarActivo" idActivo="' +idActivo+'"><i class="fa fa-times"></i></button></span>' +
                  
                      '<input type="text" class="form-control nuevaSerieActivo" idNuevoActivo="' +idActivo +'" name="agregarActivo" value="' +serie+'" readonly required>' +
                  
                    "</div>" +
                  
                  "</div>" +
                  
                  '<div class="col-sm-4">' +
                  
                    '<div class="input-group">' +
                  
                      '<input type="text" class="form-control nuevoTipoActivo" name="nuevoTipoActivo" idTipo="' +idTipo +'" value="'+tipo+'" readonly required>' +
                  
                    "</div>" +
                  
                  "</div>" +
                  
                  '<div class="col-sm-4">' +
                  
                    '<div class="input-group">' +
                  
                      '<input type="text" class="form-control nuevoModeloActivo" idModelo="' +idModelo +'" name="nuevoModeloActivo" value="' +modelo +'" readonly required>' +
                  
                    "</div>" +
                  
                  "</div>" +
                  
                "</div>"
              );

              //Llamamos a la función para agrupar los activos
              listarActivos();

            }, 
          });
        },
      });
    },    
  });
});

/* ========================================================================================
        CON ESTA FUNCION VAMOS A CARGAR LA TABLA CADA VEZ QUE INTERACTUAMOS CON ELLA
=========================================================================================== */

$(".tablaAsignaciones").on("draw.dt", function () {
  if (localStorage.getItem("quitarActivo") != null) {
    var listaIdActivos = JSON.parse(localStorage.getItem("quitarActivo"));

    for (var i = 0; i < listaIdActivos.length; i++) {
      $(
        "button.recuperarBoton[idAF='" + listaIdActivos[i]["idActivo"] + "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idAF='" + listaIdActivos[i]["idActivo"] + "']"
      ).addClass("btn-primary agregarActivo");
    }
  }
});

/* ========================================================================================
              ELIMINAR ACTIVOS QUE FUERON ESCOGIDOS EN LA ZONA DE ASIGNACIONES
=========================================================================================== */

var idQuitarActivo = [];

localStorage.removeItem("quitarActivo");

$(".formularioAsignacion").on("click", "button.quitarActivo", function () {
  $(this).parent().parent().parent().parent().remove();

  var idActivo = $(this).attr("idActivo");

  //Aqui almacenamos el id del activo en el localstorage para que se puedan volver a agregar aunque cambiemos de página.

  if (localStorage.getItem("quitarActivo") == null) {
    idQuitarActivo = [];
  } else {
    idQuitarActivo.concat(localStorage.getItem("quitarActivo"));
  }

  idQuitarActivo.push({ idActivo: idActivo });

  localStorage.setItem("quitarActivo", JSON.stringify(idQuitarActivo));

  //Aqui le quitamos las claases que hacen que el botón se vea gris y le ponemos las que hacen que se vea azul para que se pueda volver a utilizar
  $("button.recuperarBoton[idAF='" + idActivo + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idAF='" + idActivo + "']").addClass(
    "btn-primary agregarActivo"
  );

  //Llamamos a la función para agrupar los activos
  listarActivos();
});

/* ========================================================================================
        JUNTAR TODOS LOS PRODUCTOS EN UN JSON PARA METERLOS EN UNA MISMA CELDA DE LA DB
=========================================================================================== */

function listarActivos() {
  
  var listaActivos = [];

  $(".nuevoActivo").find(".nuevaSerieActivo").each(function () {
    var idActivo = $(this).attr("idNuevoActivo");
    var serie = $(this).val();
    var idTipo = $(this).parent().parent().parent().find(".nuevoTipoActivo").attr("idTipo");
    var idModelo = $(this).parent().parent().parent().find(".nuevoModeloActivo").attr("idModelo");

    listaActivos.push({ idActivo: idActivo, serie: serie, idTipo: idTipo, idModelo: idModelo });
  }
  );

 /*  console.log("listaActivos", listaActivos); */

  console.log("listaActivos", JSON.stringify(listaActivos));

  $("#listaActivos").val(JSON.stringify(listaActivos));


}
