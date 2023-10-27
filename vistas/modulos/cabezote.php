<!-- ESTE ES EL CABEZOTE O ENCABEZADO DEL SISTEMA. ES EN DONDE SE MUESTRA EL LOGO DE AGCO, LAS RAYITAS PARA EXTENDER EL MENÚ LATERAL Y EL NOMBRE DEL USUARIO Y LA OPCIÓN DE SALIR
     EN RESUMEN ES TODA LA LÍNEA TOJA QUE ESTÁ ARRIBA -->

<header class="main-header">

  <!-- =======================================================
                   LOGOTIPO
======================================================== -->

  <a href="inicio" class="logo">

    <!-- LOGO MINI -->
    <span class="logo-mini">

      <img src="vistas/img/plantilla/agco_logo.png" class="img-responsive" style="padding:10px">

    </span>
    <!-- LOGO NORMAL -->
    <span class="logo-lg">

      <img src="vistas/img/plantilla/agco_large_logo2.png" class="img-responsive" style="padding:10px; margin:0px">

    </span>

  </a>

  <!-- =======================================================
                   SIDEBAR
======================================================== -->

  <nav class="navbar navbar-static-top" role="navigation">

    <!-- Botón de navegación -->

    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

      <span class="sr-only">Toggle navigation</span>

    </a>

    <!-- Perfil de usuario -->

    <div class="navbar-custom-menu">

      <ul class="nav navbar-nav">

        <li class="dropdown user user-menu">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <img src="vistas/img/usuarios/anonymousboth.png" class="user-image">

            <span class="hidden-xs"><?php echo $_SESSION["usuario"]; ?></span>

          </a>

          <!-- Dropdown toggle -->

          <ul class="dropdown-menu">

            <li class="user-body">

              <div class="pull-right">

                <a href="salir" class="btn btn-default btn-flat">Salir</a>

              </div>

            </li>

          </ul>

        </li>

      </ul>

    </div>

  </nav>

</header>