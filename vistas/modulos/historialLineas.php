<!-- ESTA ES LA VISTA DEL MODULO DEL HISTORIAL DE LOS CAMBIOS EN LAS LÍNEAS". 
EL CONTENIDO DE LA TABLA DE ESTE MODULO SE GENERA DESDE UNA VISTA EN SERVERSIDE LLAMADA "historialLineas.serverside.php" -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Historial de Líneas Telefónicas<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Historial de Líneas Telefónicas</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <!-- Aquí van los botones para agregar activos fijos, para exportar el contenido de la tabla a un excel o para exportarlo a un PDF junto con el título,
            pero por ahora no se los voy a poner  -->

            <div class="box-header with-border">

            </div>

            <div class="box-body">

                <!-- SECCIÓN PARA LOS CRITERIOS DE BÚSQUEDA -->

                <div class="box box-default">

                    <div class="box-header with-border">

                        <h3 class="box-title"><strong>Filtros</strong></h3>

                    </div>

                    <div class="box-body">

                        <div class="row">

                            <div class="form-group row">

                                <div class="col-lg-12 d-lg-flex">

                                    <!--Espacio para filtrar el numero de linea -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Linea</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialLinea" placeholder="Línea" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el IMEI del dispositivo anterior -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Dispositivo anterior</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-navicon"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialDispositivoAnterior" placeholder="IMEI del dispositivo" data-index="1">

                                        </div>

                                    </div>


                                    <!--Espacio para filtrar el IMEI del dispositivo posterior -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Dispositivo posterior</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialDispositivoPosterior" placeholder="IMEI del dispositivo" data-index="2">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el empleado anterior -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Empleado anterior</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialEmpleadoAnterior" placeholder="Nombre de empleado" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el empleado posterior -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Empleado posterior</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialEmpleadoPosterior" placeholder="Nombre de empleado" data-index="4">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar quién realizó el cambio -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Realizó</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                            <input type="text" class="form-control input" id="filtroHistorialUsuario" placeholder="Nombre de usuario" data-index="5">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table class="table table-bordered table-striped dt-responsive tablaHistorialLineas" id="tablaHistorialLineas" style="width:100%">

                    <thead>

                        <tr>

                            <th>Línea</th>
                            <th>Dispositivo anterior</th>
                            <th>Dispositivo posterior</th>
                            <th>Empleado anterior</th>
                            <th>Empleado posterior</th>
                            <th>Realizó</th>
                            <th>Fecha</th>
                            <th>Cambio</th>


                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<!-- =======================================================
         VENTANA MODAL AGREGAR LÍNEA TELEFÓNICA
======================================================== -->

<div id="modalAgregarLinea" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Nueva Línea Telefónica</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="nuevaLinea" name="nuevaLinea" placeholder="Ingresa el número de línea" required>

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL NÚMERO DE CONTRATO-->

                            <div class="col-xs-6">

                                <label>Número de contrato</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoContrato" id="nuevoContrato" placeholder="Ingresa el número de contrato">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO INGRESAR EL CENTRO DE COSTOS -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Centro de Costos</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoCC" id="nuevoCC" placeholder="Ingresa el centro de costos">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL LÍMITE CONTRATADO -->

                            <div class="col-xs-6">

                                <label>Límite contratado</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoLimite" id="nuevoLimite" placeholder="Ingresa el límite contratado">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL TIPO DE LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Tipo de línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                    <select class="form-control input-lg" name="nuevoTipoLinea" id="nuevoTipoLinea" required>

                                        <option value="">Seleccionar el tipo de línea</option>
                                        <option value="1">VOZ</option>
                                        <option value="2">DATOS</option>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO EN BLANCO POR SI ACASO -->

                            <div class="col-xs-6">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR DETALLES-->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <label>Detalles</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                    <textarea class="form-control" rows="3" placeholder="Detalles" name="nuevoDetalle" id="nuevoDetalle"></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Activo Fijo</button>

                </div>

            </form>

            <?php

            $registrarLinea = new ControladorLineas();
            $registrarLinea->ctrRegistrarLineas();

            ?>

        </div>

    </div>

</div>


<!-- =======================================================
         VENTANA MODAL EDITAR LÍNEA TELEFÓNICA
======================================================== -->

<div id="modalEditarLinea" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Línea Telefónica</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarLinea" name="editarLinea" placeholder="Ingresa el número de línea" readonly>
                                    <input type="hidden" id="idLinea" name="idLinea">

                                </div>

                            </div>


                            <!-- ESPACIO PARA INGRESAR EL NÚMERO DE CONTRATO-->

                            <div class="col-xs-6">

                                <label>Número de contrato</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="editarContrato" id="editarContrato" placeholder="Ingresa el número de contrato">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO INGRESAR EL CENTRO DE COSTOS -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Centro de Costos</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                    <input type="text" class="form-control input-lg" name="editarCC" id="editarCC" placeholder="Ingresa el centro de costos">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL LÍMITE CONTRATADO -->

                            <div class="col-xs-6">

                                <label>Límite contratado</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                    <input type="text" class="form-control input-lg" name="editarLimite" id="editarLimite" placeholder="Ingresa el límite contratado">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL TIPO DE LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Tipo de línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                    <select class="form-control input-lg" name="editarTipoLinea" id="editarTipoLinea" required>

                                        <option value="">Seleccionar el tipo de línea</option>
                                        <option value="1">VOZ</option>
                                        <option value="2">DATOS</option>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO EN BLANCO POR SI ACASO -->

                            <div class="col-xs-6">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR DETALLES-->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <label>Detalles</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                    <textarea class="form-control" rows="3" placeholder="Detalles" name="editarDetalles" id="editarDetalles"></textarea>

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO DEL TÍTULO EN ROJO PARA IDENTIFICAR OTRA SECCIÓN EN EL MODAL -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Sección para identificar al usuario de la línea</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL EMPLEADO TITULAR DE LA LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <label>Titular de la línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                    <select class="form-control" id="seleccionarEmpleado" name="seleccionarEmpleado" required>

                                        <option value="1">LINEA NO ASIGNADA</option>

                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                                        foreach ($empleados as $key => $value) {

                                            echo '<option value="' . $value["id_empleado"] . '">' . $value["nombre"] . ' ' . $value["apellido_paterno"] . ' ' . $value["apellido_materno"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO DEL TÍTULO EN ROJO PARA IDENTIFICAR OTRA SECCIÓN EN EL MODAL -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Sección para identificar el dispositivo de la línea</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL DISPOSITIVO ASOCIADO DE LA LÍNEA -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <label>Dispositivo de la Línea</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                    <select id="seleccionarDispositivo" name="seleccionarDispositivo" class="form-control input-lg" style="width: 100%;"  required>

                                        <option value="825">LINEA NO ASIGNADA</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $imeis = ControladorLineas::ctrMostrarDispositivosCelulares($item, $valor);

                                        foreach ($imeis as $key => $value) {

                                            echo '<option value="' . $value["id_inventario"] . '">' . $value["serie"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar Activo Fijo</button>

                </div>

            </form>

            <?php

            $editarLinea = new ControladorLineas();
            $editarLinea->ctrEditarLinea();

            ?>

        </div>

    </div>

</div>

<?php

$eliminarLinea = new ControladorLineas();
$eliminarLinea -> ctrEliminarLinea();

?>