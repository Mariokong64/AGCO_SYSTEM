/* =======================================================
                   EDITAR USUARIOS
======================================================== */

$(document).on("click", ".btnEditarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");

  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarNombre").val(respuesta["nombre_usuario"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#passwordActual").val(respuesta["contrasena"]);
    },
  });
});

/* =======================================================
                ACTIVAR O DESACTIVAR USUARIOS
======================================================== */
$(document).on("click", ".btnActivar", function () {
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          title: "El usuario ha sido actualizado",
          type: "success",
          confirmButtonText: "Cerrar",
        }).then(function (result) {
          if (result.value) {
            window.location = "usuarios";
          }
        });
      }
    },
  });

  if (estadoUsuario == 0) {
    $(this).removeClass("btn-success");
    $(this).addClass("btn-danger");
    $(this).html("Desactivado");
    $(this).attr("estadoUsuario", 1);
  } else {
    $(this).removeClass("btn-danger");
    $(this).addClass("btn-success");
    $(this).html("Activado");
    $(this).attr("estadoUsuario", 0);
  }
});

/* =======================================================
                REVISAR USUARIOS REPETIDOS
======================================================== */

$("#nuevoUsuario").change(function () {
  $(".alert").remove();

  var usuario = $(this).val();
  var datos = new FormData();
  datos.append("validarUsuario", usuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      if (respuesta) {
        $("#nuevoUsuario")
          .parent()
          .after('<div class="alert alert-warning">El usuario ya existe</div>');
        $("#nuevoUsuario").val("");
      }
    },
  });
});

/* =======================================================
                ELIMINAR USUARIOS
======================================================== */

$(document).on("click", ".btnEliminarUsuario", function () {
  idUsuario = $(this).attr("idUsuario");

  swal({
    title: "¿Está seguro que quiere eliminar este usuario?",
    text: "Esta acción no se puede deshacer",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.value) {
      window.location = "index.php?ruta=usuarios&idUsuario=" + idUsuario + "";
    }
  });
});
