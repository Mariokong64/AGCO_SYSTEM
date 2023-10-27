<!-- EN ESTE HTML SE PONE TODA LA VISTA DEL MODULO DE LOS EMPLEADOS -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Empleados<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de empleados</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

             <!-- En este div se muestran los botones para agregar un empleado, exportar los registros de la tabla a excel o a pdf, pero solo se muestran si el perfil del
             usuario logeado es "administrador o soporte" -->

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                    <div class="row">

                        <div class="col-sm-1">

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">Agregar Empleado</button>

                        </div>

                    <div class="col-sm-1">

                        <button class="btn btn-success" style="margin-left: 15px" id="reporteEmpelados">Exportar a excel</button>

                    </div>

                    <div class="col-sm-4">                

                        <div class="input-group"> 

                            <div class="input-group-btn">

                                <button class="btn btn-danger btnImprimirReporteEmpleados" id="btnImprimirReporteEmpleados" style="width: 120px; margin-left: 15px">Exportar a PDF</button>
                            
                            </div>    
                       
                           <input type="text" class="form-control" id="NombreReporteDeEmpleados" name="NombreReporteDeEmpleados" placeholder="Ingresa el título del reporte" style="width: 400px">
                        
                        </div>

                    </div>

                </div>

                    ';
                }

                ?>
            </div>

            <div class="box-body">

                <!-- SECCIÓN PARA LOS CRITERIOS DE BÚSQUEDA. Aqui puse los filtros para cada una de las columnas -->

                <div class="box box-default">

                    <div class="box-header with-border">

                        <h3 class="box-title"><strong>Filtros</strong></h3>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="form-group row">

                                <div class="col-lg-12 d-lg-flex">

                                    <!--Espacio para filtrar el nombre del empleado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Nombre</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <input type="text" class="form-control input" id="filtroNombreEmpleado" placeholder="Nombre" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el puesto del empleado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Puesto</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-dot-circle-o"></i></span>

                                            <input type="text" class="form-control input" id="filtroPuesto" placeholder="Puesto" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el departamento materno del empleado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Departamento</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                            <input type="text" class="form-control input" id="filtroDepartamentoEmpleado" placeholder="Departamento" data-index="4">

                                        </div>

                                    </div>
                                    <!--Espacio para filtrar el email del empleado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Email</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                            <input type="text" class="form-control input" id="filtroEmailEmpleado" placeholder="Email" data-index="5">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la nómina del empleado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Nómina</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                            <input type="text" class="form-control input" id="filtroNomina" placeholder="Nómina" data-index="6">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA. Aquí se muestran los datos de los empleados. Estos datos vienen de un ajax que se llama desde un javascript ubicado en "vistas/JS/empleado.js" -->

                <table class="table table-bordered table-striped dt-responsive tablaEmpleados" id="tablaEmpleados" width="100%">

                    <thead>

                        <tr>

                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th style="width:200px">Puesto</th>
                            <th style="width:200px">Departamento</th>
                            <th style="width:130px">Email</th>
                            <th style="width:30px">Nómina</th>
                            <th style="width:30px">Activos Asignados</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

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

                                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresa el nombre del empleado" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO APELLIDO PATERNO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Apellido paterno</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="apellidoP" placeholder="Ingresa el apellido paterno" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO APELLIDO MATERNO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Apellido Materno</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="apellidoM" placeholder="Ingresa el apellido materno">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE NÓMINA -->

                        <div class="form-group">

                            <label>Nómina</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaNomina" id="nuevaNomina" placeholder="Ingresa el número de nómina" required>

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

<!-- =======================================================
                   VENTANA MODAL EDITAR EMPLEADO
======================================================== -->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Empleado</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA EDITAR EL NOMBRE DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Nombre de empleado</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Ingresa el nombre del empleado" required>
                                <input type="hidden" name="idDelEmpleado" id="idDelEmpleado">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO APELLIDO PATERNO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Apellido paterno</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="editarApellidoP" id="editarApellidoP" placeholder="Ingresa el apellido paterno" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO APELLIDO MATERNO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Apellido Materno</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="editarApellidoM" id="editarApellidoM" placeholder="Ingresa el apellido materno" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR EL NÚMERO DE NÓMINA -->

                        <div class="form-group">

                            <label>Nómina</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNomina" name="editarNomina" placeholder="Ingresa el número de nómina" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR EL EMAIL -->

                        <div class="form-group">

                            <label>Email</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="text" class="form-control input-lg" id="editarEmail" name="editarEmail" placeholder="Ingresa el email del empleado">

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR EL DEPARTAMENTO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Departamento</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" id="editarEmpleadoDepartamento" name="editarEmpleadoDepartamento" required>

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

                        <!-- ESPACIO PARA EDITAR EL PUESTO DEL EMPLEADO -->

                        <div class="form-group">

                            <label>Puesto</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" id="editarEmpleadoPuesto" name="editarEmpleadoPuesto" required>

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

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

            </form>

            <?php

            $editarEmpleado = new ControladorEmpleados();
            $editarEmpleado->ctrEditarEmpleados();

            ?>


        </div>

    </div>

</div>

<?php

$eliminarEmpleado = new ControladorEmpleados();
$eliminarEmpleado->ctrEliminarEmpleado();

?>