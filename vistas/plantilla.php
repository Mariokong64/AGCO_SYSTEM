<!-- ESTE ES LA PLANTILLA. EN ESTE HTML AGREGAMOS TODOS LOS PLUGINS Y EXTENSIONES QUE UTILIZAMOS, COMO EL BOOTSTRAP 4, ASÍ MISMO, AGREGAMOS EL ENCABEZADO
     EL MENÚ LATERAL Y DEPENDIENDO DE QUE OPCIÓN SE SELECCIONE SE INCLUYE EN LA VENTANA DEL CENTRO EL CONTENIDO DE ESA OPCIÓN. AL FINAL SE INCLUYE EL JAVASCRIPT -->


<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>AGCO AF Administrator</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- =======================================================
                   PLUGINS DE CSS
======================================================== -->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

  <!-- =======================================================
                   PLUGINS DE JAVASCRIPT
======================================================== -->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- SlimScroll -->
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- SheetJS -->
  <!-- use version 0.20.0 -->
  <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>


  <!-- librería XLSX,JS (es la que viene del internet) -->

  <!-- Biblioteca xlsx.js (Es la que tengo importada en mi proyecto) 
  <script src="extensiones/sheetjs/dist/xlsx.full.min.js"></script>  -->




  <!-- =======================================================
                   CUERPO DEL DOCUMENTO
======================================================== -->
</head>

<body class="hold-transition skin-red sidebar-collapse sidebar-mini login-page">

  <!-- Site wrapper -->


  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div class="wrapper">';

    /* =======================================================
                         CABEZOTE
    ======================================================== */

    include "modulos/cabezote.php";

    /* =======================================================
                           MENU
    ======================================================== */

    include "modulos/menu.php";

    /* =======================================================
                           CONTENIDO
    ======================================================== */

    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "inventario" ||
        $_GET["ruta"] == "inventarioImpresora" ||
        $_GET["ruta"] == "inventarioTelefonos" ||
        $_GET["ruta"] == "inventarioPC" ||
        $_GET["ruta"] == "inventarioRapido" ||
        $_GET["ruta"] == "inventarioRecurrente" ||
        $_GET["ruta"] == "categoria" ||
        $_GET["ruta"] == "modelo" ||
        $_GET["ruta"] == "ubicacion" ||
        $_GET["ruta"] == "marca" ||
        $_GET["ruta"] == "empleado" ||
        $_GET["ruta"] == "puesto" ||
        $_GET["ruta"] == "departamento" ||
        $_GET["ruta"] == "asignacion" ||
        $_GET["ruta"] == "devolucion" ||
        $_GET["ruta"] == "devolucionActivo" ||
        $_GET["ruta"] == "historial" ||
        $_GET["ruta"] == "historial-estado" ||
        $_GET["ruta"] == "solicitudes" ||
        $_GET["ruta"] == "credenciales" ||
        $_GET["ruta"] == "renovaciones" ||
        $_GET["ruta"] == "lineas" ||
        $_GET["ruta"] == "facturas" ||
        $_GET["ruta"] == "historialLineas" ||
        $_GET["ruta"] == "credencialesEmpleado" ||
        $_GET["ruta"] == "imprimir-reporte" ||
        $_GET["ruta"] == "salir"

      ) {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {
        include "modulos/404.php";
      }
    }


    /* =======================================================
                           PIE DE PÁGINA
    ======================================================== */

    include "modulos/footer.php";

    echo '</div>';
  } else {
    include "modulos/login.php";
  }

  ?>


  </div>
  <!-- ./wrapper -->
  <script>
    var perfil = "<?php echo $_SESSION['perfil']; ?>";
  </script>
  <script src="vistas/JS/plantilla.js"></script>
  <script src="vistas/JS/usuarios.js"></script>
  <script src="vistas/JS/categoria.js"></script>
  <script src="vistas/JS/modelo.js"></script>
  <script src="vistas/JS/ubicacion.js"></script>
  <script src="vistas/JS/marca.js"></script>
  <script src="vistas/JS/departamento.js"></script>
  <script src="vistas/JS/puesto.js"></script>
  <script src="vistas/JS/empleado.js"></script>
  <script src="vistas/JS/inventario.js"></script>
  <script src="vistas/JS/inventarioImpresora.js"></script>
  <script src="vistas/JS/inventarioPC.js"></script>
  <script src="vistas/JS/inventarioTelefonos.js"></script>
  <script src="vistas/JS/inventarioRecurrente.js"></script>
  <script src="vistas/JS/inventarioRapido.js"></script>
  <script src="vistas/JS/asignaciones.js"></script>
  <script src="vistas/JS/devolucionEmpleado.js"></script>
  <script src="vistas/JS/ActivosDeEmpleado.js"></script>
  <script src="vistas/JS/historialMovimientos.js"></script>
  <script src="vistas/JS/historialEstado.js"></script>
  <script src="vistas/JS/historialLineas.js"></script>
  <script src="vistas/JS/credenciales.js"></script>
  <script src="vistas/JS/lineas.js"></script>
  <script src="vistas/JS/renovaciones.js"></script>
  <script src="vistas/JS/facturas.js"></script>
</body>

</html>