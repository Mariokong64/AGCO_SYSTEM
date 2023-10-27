<!-- ESTA ES LA VISTA DEL MODULO DE ASIGNACIONES. EN ESTE MODULO ES EN DONDE SE MUESTRA EL FORMULARIO PARA SELECCIONAR EL EMPLEADO AL QUE SE LE VAN A ASIGNAR
     LOS ACTIVOS FIJOS Y A UN LADO SE MUESTRAN TODOS LOS ACTIVOS FIJOS QUE ESTÁN LIBRES EN UNA TABLA PARA AGREGARLOS UNO POR UNO -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Asignaciones a empleados nuevos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Asignaciones a empleados nuevos</li>
        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!-- =======================================================
                   SECCIÓN DEL FORMULARIO
            ======================================================== -->

            <div class="col-lg-5 col-xs-12">

                <div class="box box-danger">

                    <div class="box-header with-border">

                        <form role="form" method="post" class="formularioAsignacion">

                            <div class="box-body">

                                <div class="box">

                                    <!-- =======================================================
                                            SECCIÓN DEL USUARIO QUE HACE LA ASIGNACIÓN
                                    ======================================================== -->

                                    <div class="form-group">

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <input type="text" class="form-control" id="nombreUsuario" value="<?php echo $_SESSION["usuario"]; ?>" readonly>

                                            <input type="hidden" name="id_asignador" value="<?php echo $_SESSION["id_usuario"]; ?>">

                                        </div>

                                    </div>

                                    <!-- =======================================================
                                                     SECCIÓN DEL EMPLEADO
                                    ======================================================== -->

                                    <div class="form-group">

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <select class="form-control" id="seleccionarEmpleado" name="seleccionarEmpleado" required>

                                                <option value="">Seleccionar empleado</option>

                                                <?php
                                                $item = null;
                                                $valor = null;

                                                $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                                                foreach ($empleados as $key => $value) {

                                                    echo '<option value="' . $value["id_empleado"] . '">' . $value["nombre"] . ' ' . $value["apellido_paterno"] . ' ' . $value["apellido_materno"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                            <span class="input-group-addon"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAgregarEmpleado" data-dismiss="modal" style="padding: 3px; width: 180px">Agregar nuevo empleado</button></span>

                                        </div>

                                    </div>

                                    <!-- ===========================================================
                                    ENTRADA OCULTA PARA PONER EL ARREGLO DE PRODUCTOS SELECCIONADOS
                                    ============================================================ -->

                                    <input type="hidden" id="listaActivos" name="listaActivos">

                                    <!-- =======================================================
                                        SECCIÓN DE LOS ACTIVOS FIJOS QUE SE VAN AGREGANDO (este se modifica con JavaScript)
                                    ======================================================== -->

                                    <div class="form-group row nuevoActivo">

                                    </div>

                                </div>

                                <!-- =======================================================
                                             BOTÓN PARA AGREGAR LOS ACTIVOS FIJOS
                                    ======================================================== -->

                                <button type="button" class="btn btn-default hidden-lg btnAgregarActivo">Agregar Activos</button>

                            </div>

                            <div class="box-footer">

                                <button type="submit" class="btn btn-primary pull-right">Realizar asignación</button>

                            </div>

                        </form>

                        <?php

                        $crearAsignacion = new ControladorAsignaciones();
                        $crearAsignacion->ctrCrearAsignacion();

                        ?>

                    </div>

                </div>

            </div>

            <!-- =======================================================
                   TABLA DE LOS ACTIVOS FIJOS
            ======================================================== -->

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

                <div class="box box-danger">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaAsignaciones">

                            <thead>

                                <tr>
                                    <th>Serie</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
                   VENTANA MODAL AGREGAR EMPLEADO
======================================================== -->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Empleado</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Nombre de empleado</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoEmpleado" placeholder="Ingresa el nombre del empleado" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE NÓMINA -->

                        <div class="form-group">

                            <label>Nómina</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaNomina" placeholder="Ingresa el número de nómina">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL EMAIL -->

                        <div class="form-group">

                            <label>Email</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresa el email del empleado">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL DEPARTAMENTO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Departamento</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="nuevoEmpleadoDepartamento" required>

                                    <option value="">Seleccionar departamento</option>

                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                                    foreach ($departamentos as $key => $value) {

                                        echo '<option value="' . $value["id_departamento"] . '">' . $value["departamento"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL PUESTO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Puesto</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="nuevoEmpleadoPuesto" required>

                                    <option value="">Seleccionar puesto</option>

                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $puestos = ControladorPuestos::ctrMostrarPuestos($item, $valor);

                                    foreach ($puestos as $key => $value) {

                                        echo '<option value="' . $value["id_puesto"] . '">' . $value["puesto"] . '</option>';
                                    }

                                    ?>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar empleado</button>

                </div>

            </form>

            <?php

            $crearEmpleado = new ControladorEmpleados();
            $crearEmpleado->ctrIngresarEmpleados();

            ?>

        </div>

    </div>

</div>