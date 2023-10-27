<!-- ESTA ES LA PÁGINA DE INICIO, ES EN DONDE SALE LA FOTO DEL TRACTOR Y LOS ICONOS QUE TE ENLAZAN DIRECTAMENTE AL MENÚ -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Inicio<small>Panel de control</small></h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Panel de control</li>

        </ol>

    </section>

    <!-- Esta es la parte en donde sale el tractor y el mensaje de bienvenida -->

    <section class="content" style="height: 400px;">

        <div class="welcome-message" style="background-image: url('vistas/img/plantilla/factory-queretaro.jpg'); height: 480px; border-radius: 15px;">

            <h1 style="margin-left: 10px; padding-top: 10px; color:ghostwhite">Bienvenido/a <?php echo $_SESSION["nombre_usuario"]; ?></h1>

        </div>

        <!-- Esta es la parte en donde se imprimen los iconos de los accesos directos al inventario, empleados, etc. Estos primeros dos se imprimen para todos los usuarios -->

        <div class="row">

            <div class="col-sm-3">

                <a href="inventarioRapido">

                    <img src="vistas/img/plantilla/inventory.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                    <h3 style="margin:auto; width:min-content; margin-top: 5px;">Inventario</h3>
                    <p style="margin:auto; margin-top: 5px; width:fit-content;">Consulta y administra el inventario de activos fijos</p>

                </a>

            </div>

            <div class="col-sm-3">

                <a href="empleado">

                    <img src="vistas/img/plantilla/human_resources.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                    <h3 style="margin:auto; width:min-content; margin-top: 5px;">Empleados</h3>
                    <p style="margin:auto; margin-top: 5px; width:fit-content;">Consulta y administra el registro de los empleados</p>

                </a>

            </div>

            <!-- Aqui vamos a evaluar si imprimimos las demás opciones del menú en el inicio dependiendo de que perfil tenga el usuario logeado -->

            <?php if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                echo
                '<div class="col-sm-3">

            <a href="asignacion">

                <img src="vistas/img/plantilla/outsource.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                <h3 style="margin:auto; width:min-content; margin-top: 5px;">Asignaciones</h3>
                <p style="margin:auto; margin-top: 5px; width:fit-content;">Realiza asignaciones de activos fijos a empleados</p>

            </a>

            </div>

            <div class="col-sm-3">

            <a href="devolucion">

                <img src="vistas/img/plantilla/insource.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                <h3 style="margin:auto; width:min-content; margin-top: 5px;">Devoluciones</h3>
                <p style="margin:auto; margin-top: 5px; width:fit-content;">Realiza devoluciones de activos fijos a empleados</p>

            </a>

            </div>';
            }
            ?>

        </div>

        <?php if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

            echo

            '<div class="row">

            <div class="col-sm-4">

            <a href="credenciales">

                <img src="vistas/img/plantilla/password.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                <h3 style="margin:auto; width:min-content; margin-top: 5px;">Credenciales</h3>
                <p style="margin:auto; margin-top: 5px; width:fit-content;">Consulta y administra las credenciales de los empleados</p>

            </a>

            </div>

            <div class="col-sm-4">

            <a href="historial">

                <img src="vistas/img/plantilla/history2.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                <h3 style="margin:auto; width:max-content; margin-top: 5px;">Historial de asignaciones y devoluciones</h3>
                <p style="margin:auto; margin-top: 5px; width:fit-content;">Consulta el historial de todas las asignaciones y devoluciones hechas a empleados</p>

            </a>

            </div>

            <div class="col-sm-4">

            <a href="historial-estado">

                <img src="vistas/img/plantilla/how_it_works.png" class="img-responsive" style="margin:auto; margin-top: 15px">
                <h3 style="margin:auto; width:max-content; margin-top: 5px;">Historial de cambios de estados</h3>
                <p style="margin:auto; margin-top: 5px; width:fit-content;">Consulta el historial de los cambios de estados de los activos fijos</p>

            </a>

            </div>

        </div>';
        }
        ?>

    </section>

</div>