<!-- ESTA ES LA VISTA DEL MODULO DE "CONSULTA GENERAL" EN ESTE MODULO SE MUESTRAN TODOS LOS ACTIVOS FIJOS Y SU INFORMACIÓN GENERAL. EL CONTENIDO DE LA TABLA DE 
     ESTE MODULO SE GENERA EN UN AJAX QUE ES LLAMADO DESDE UN JAVASCRIPT QUE ESTA EN "vistas/JS/inventarioRapido.js"-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Activos Fijos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de activos fijos</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                            <div class="row">

                                <div class="col-sm-1">

                                <!-- Boton para agregar un activo fijo general -->

                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAF">Agregar Activo Fijo</button>
                                
                                </div>
                                
                                <div class="col-sm-1">

                                <!-- Boton para exportar la tabla a un excel -->

                                <button class="btn btn-success" style="margin-left: 15px" id="reporteGeneral">Exportar a excel</button>
                                
                                </div>
                                
                                <div class="col-sm-4">                
                                
                                <!-- Boton para exportar la tabla a un PDF -->

                                    <div class="input-group"> 

                                        <div class="input-group-btn">
                                            <button class="btn btn-danger btnImprimirReporteAFs" id="btnImprimirReporteAFs" style="width: 120px; margin-left: 15px">Exportar a PDF</button>
                                        </div>    
                                            <input type="text" class="form-control" id="NombreReporteDeActivosFijos" name="NombreReporteDeActivosFijos" placeholder="Ingresa el título del reporte" style="width: 400px">
                                    
                                    </div>

                                </div>

                            </div>';
                }
                ?>

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

                                    <!--Espacio para filtrar el numero de serie -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Serie</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                            <input type="text" class="form-control input" id="filtroSerieRapido" placeholder="Serie" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el tipo del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Tipo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                            <input type="text" class="form-control input" id="filtroTipoRapido" placeholder="Tipo" data-index="1">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la marca del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Marca</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                            <input type="text" class="form-control input" id="filtroMarcaRapido" placeholder="Marca" data-index="2">

                                        </div>

                                    </div>
                                    <!--Espacio para filtrar el modelo del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Modelo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                            <input type="text" class="form-control input" id="filtroModeloRapido" placeholder="Modelo" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar si esta asignado o no el af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Asignado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>

                                            <input type="text" class="form-control input" id="filtroAsignadoRapido" placeholder="Asignado" data-index="4">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 d-lg-flex" style="margin-top: 15px;">

                                    <!--Espacio para filtrar el estado del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Estado (Colocar el valor completo)</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                            <input type="text" class="form-control input" id="filtroEstadoRapido" placeholder="Estado" data-index="5">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el departamento del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Departamento</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                            <input type="text" class="form-control input" id="filtroDepartamentoRapido" placeholder="Departamento" data-index="6">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la ubicación del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Ubicación</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrows"></i></span>

                                            <input type="text" class="form-control input" id="filtroUbicacionRapido" placeholder="Ubicación" data-index="7">

                                        </div>

                                    </div>
                                    <!--Espacio para filtrar el nombre de quien lo tiene asignado -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Empleado asignado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>

                                            <input type="text" class="form-control input" id="filtroEmpleadoRapido" placeholder="Empleado asignado" data-index="8">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table class="table table-bordered table-striped dt-responsive tablaInventarioRapido" id="tablaInventarioRapido" style="width:100%">

                    <thead>

                        <tr>

                            <th>Serie</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th style="width:40px">Asignado</th>
                            <th style="width:50px">Estado</th>
                            <th>Departamento</th>
                            <th>Ubicación</th>
                            <th>Empleado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
         VENTANA MODAL AGREGAR ACTIVO FIJO GENERAL
======================================================== -->

<div id="modalAgregarAF" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Nuevo Activo Fijo</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4><span class="label label-danger">Datos generales del Activo Fijo</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUMERO DE SERIE -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de serie</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="nuevaSerie" name="nuevaSerie" placeholder="Ingresa el número de serie" required>

                                </div>
                            </div>


                            <!-- ESPACIO PARA INGRESAR LA FACTURA -->

                            <div class="col-xs-6">

                                <label>Número de factura</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevaFactura" placeholder="Ingresa el número de factura" required>

                                </div>
                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL TIPO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Tipo</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                    <select class="form-control input-lg" name="nuevoTipo" required>

                                        <option value="">Seleccionar Tipo</option>

                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                        foreach ($categorias as $key => $value) {

                                            echo '<option value="' . $value["id_tipo"] . '">' . $value["tipo"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO PARA SELECCIONAR LA MARCA -->

                            <div class="col-xs-6">

                                <label>Marca</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                    <select class="form-control input-lg" name="nuevaMarca" required>

                                        <option value="">Seleccionar Marca</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                                        foreach ($marcas as $key => $value) {

                                            echo '<option value="' . $value["id_marca"] . '">' . $value["marca"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>
                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL MODELO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Modelo</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                    <select class="form-control input-lg" name="nuevoModelo" required>

                                        <option value="">Seleccionar Modelo</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $modelos = ControladorModelos::ctrMostrarModelos($item, $valor);

                                        foreach ($modelos as $key => $value) {

                                            echo '<option value="' . $value["id_modelo"] . '">' . $value["modelo"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO PARA SELECCIONAR EL ESTATUS DE ADQUISICIÓN -->

                            <div class="col-xs-6">

                                <label>Tipo de adquisición</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-strikethrough"></i></span>

                                    <select class="form-control input-lg" name="nuevoEstatus" required>

                                        <option value="">Seleccionar tipo de adquisición</option>
                                        <option value="1">COMPRADO</option>
                                        <option value="2">ARRENDADO</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR LA FECHA DE COMPRA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Fecha de compra</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                                    <input type="date" class="form-control input-lg" id="nuevaFechaCompra" name="nuevaFechaCompra" placeholder="Ingresa la fecha de compra/renta" data-inputmask="'alias': '999/99/99'" data-mask>

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR LA FECHA DE VENCIMIENTO -->

                            <div class="col-xs-6">

                                <label>Fecha de vencimiento (AFs arrendados)</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>

                                    <input type="date" class="form-control input-lg" id="nuevaFechaVencimiento" name="nuevaFechaVencimiento" placeholder="Ingresa la fecha de vencimiento (AF arrendados)" data-inputmask="'alias': '999/99/99'" data-mask>

                                </div>
                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR DETALLES-->

                        <div class="form-group">

                            <label>Detalles</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoDetalle" placeholder="Espacio para agregar detalles referentes al Activo Fijo">

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para Laptops y CPU</span></h4>

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Host-Name</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoHostName" placeholder="Ingresa el Host Name">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para celulares y teléfonos</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE TELÉFONO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de teléfono</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoNumero" placeholder="Ingresa el número de teléfono (celulares/teléfonos)">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL IMEI -->

                            <div class="col-xs-6">

                                <label>Imei</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoImei" placeholder="Ingresa el IMEI (celulares)">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL EMAIL DEL CELULAR -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Email</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-at"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoCelEmail" placeholder="Ingresa el email asociado">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL MAC -->

                            <div class="col-xs-6">

                                <label>MAC</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoMac" placeholder="Ingresa el MAC (Teléfonos)">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUMERO DE CONTRATO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de contrato</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoContrato" placeholder="Ingresa el número de contrato">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para impresoras</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL IP -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>IP</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoIP" placeholder="Ingresa la IP (Impresoras)">

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

            $registrarRapido = new ControladorInventarioRapido();
            $registrarRapido->ctrRegistrarRapido();

            ?>

        </div>

    </div>

</div>

<!-- =======================================================
         VENTANA MODAL EDITAR ACTIVO FIJO GENERAL
======================================================== -->

<div id="modalEditarAF" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Activo Fijo</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <h4><span class="label label-danger">Datos generales</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUMERO DE SERIE -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número de Serie</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" placeholder="Ingresa el número de serie" readonly>
                                    <input type="hidden" id="idDelInventario" name="idDelInventario">

                                </div>

                            </div>


                            <!-- ESPACIO PARA INGRESAR LA FACTURA -->

                            <div class="col-xs-6">

                                <label>Número de Factura</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarFactura" name="editarFactura" placeholder="Ingresa el número de factura">

                                </div>
                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL TIPO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Tipo</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                    <select class="form-control input-lg" id="editarTipo" name="editarTipo" required>

                                        <option value="">Seleccionar Tipo</option>

                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                        foreach ($categorias as $key => $value) {

                                            echo '<option value="' . $value["id_tipo"] . '">' . $value["tipo"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO PARA SELECCIONAR LA MARCA -->

                            <div class="col-xs-6">

                                <label>Marca</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                    <select class="form-control input-lg" id="editarMarca" name="editarMarca" required>

                                        <option value="">Seleccionar Marca</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                                        foreach ($marcas as $key => $value) {

                                            echo '<option value="' . $value["id_marca"] . '">' . $value["marca"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>
                            </div>

                        </div>

                        <!-- ESPACIO PARA SELECCIONAR EL MODELO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Modelo</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                    <select class="form-control input-lg" id="editarModelo" name="editarModelo" required>

                                        <option value="">Seleccionar Modelo</option>

                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $modelos = ControladorModelos::ctrMostrarModelos($item, $valor);

                                        foreach ($modelos as $key => $value) {

                                            echo '<option value="' . $value["id_modelo"] . '">' . $value["modelo"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <!-- ESPACIO PARA SELECCIONAR EL ESTATUS DE ADQUISICIÓN -->

                            <div class="col-xs-6">

                                <label>Estatus</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-strikethrough"></i></span>

                                    <select class="form-control input-lg" id="editarEstatus" name="editarEstatus" required>

                                        <option value="">Seleccionar tipo de adquisición</option>
                                        <option value="1">COMPRADO</option>
                                        <option value="2">ARRENDADO</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR LA FECHA DE COMPRA -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Fecha de compra</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                                    <input type="date" class="form-control input-lg" id="editarFechaCompra" name="editarFechaCompra" placeholder="Ingresa la fecha de compra/renta" data-inputmask="'alias': '999/99/99'" data-mask>

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR LA FECHA DE VENCIMIENTO -->

                            <div class="col-xs-6">

                                <label>Fecha de vencimiento (AFs arrendados)</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>

                                    <input type="date" class="form-control input-lg" id="editarFechaVencimiento" name="editarFechaVencimiento" placeholder="Ingresa la fecha de vencimiento (AF arrendados)" data-inputmask="'alias': '999/99/99'" data-mask>

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <!-- ESPACIO PARA SELECCIONAR LA UBICACIÓN DEL ACTIVO FIJO -->

                            <div class="col-xs-6">

                                <label>Ubicación</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                    <select class="form-control input-lg" id="editarUbicacion" name="editarUbicacion">

                                        <option value="">Seleccionar Ubicación</option>

                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

                                        foreach ($ubicaciones as $key => $value) {

                                            echo '<option value="' . $value["id_ubicacion"] . '">' . $value["ubicacion"] . '</option>';
                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <!-- espacio para ingresar la posición del Activo Fijo -->

                            <div class="col-xs-6">

                                <label>Posición</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-map-pin"></i></span>

                                    <select class="form-control input-lg" id="editarPosicion" name="editarPosicion">

                                        <option value="">Seleccionar la posición del AF</option>
                                        <option value="0">NO ASIGNADA</option>
                                        <option value="1">UNO</option>
                                        <option value="2">DOS</option>
                                        <option value="3">TRES</option>
                                        <option value="4">CUATRO</option>
                                        <option value="5">CINCO</option>
                                        <option value="6">SEIS</option>
                                        <option value="7">SIETE</option>
                                        <option value="8">OCHO</option>
                                        <option value="9">NUEVE</option>
                                        <option value="10">DIEZ</option>
                                        <option value="11">ONCE</option>
                                        <option value="12">DOCE</option>
                                        <option value="13">TRECE</option>
                                        <option value="14">CATORCE</option>
                                        <option value="15">QUINCE</option>
                                        <option value="16">DIESCISEIS</option>
                                        <option value="17">DIESCISIETE</option>
                                        <option value="18">DIESCIOCHO</option>
                                        <option value="19">DIESCINUEVE</option>
                                        <option value="20">VEINTE</option>
                                        <option value="21">VEINTIUNO</option>
                                        <option value="22">VEINTIDOS</option>
                                        <option value="23">VEINTITRES</option>
                                        <option value="24">VEINTICUATRO</option>
                                        <option value="25">VEINTICINCO</option>
                                        <option value="26">VEINTISEIS</option>
                                        <option value="27">VEINTISIETE</option>
                                        <option value="28">VEINTIOCHO</option>
                                        <option value="29">VEINTINUEVE</option>
                                        <option value="30">TREINTA</option>
                                        <option value="31">TREINTA Y UNO</option>
                                        <option value="32">TREINTA Y DOS</option>
                                        <option value="33">TREINTA Y TRES</option>
                                        <option value="34">TREINTA Y CUATRO</option>
                                        <option value="35">TREINTA Y CINCO</option>
                                        <option value="36">TREINTA Y SEIS</option>
                                        <option value="37">TREINTA Y SIETE</option>
                                        <option value="38">TREINTA Y OCHO</option>
                                        <option value="39">TREINTA Y NUEVE</option>
                                        <option value="40">CUARENTA</option>
                                        <option value="41">CUARENTA Y UNO</option>
                                        <option value="42">CUARENTA Y DOS</option>
                                        <option value="43">CUARENTA Y TRES</option>
                                        <option value="44">CUARENTA Y CUATRO</option>
                                        <option value="45">CUARENTA Y CINCO</option>
                                        <option value="46">CUARENTA Y SEIS</option>
                                        <option value="47">CUARENTA Y SIETE</option>
                                        <option value="48">CUARENTA Y OCHO</option>
                                        <option value="49">CUARENTA Y NUEVE</option>
                                        <option value="50">CINCUENTA</option>

                                    </select>

                                </div>

                            </div>
                        </div>

                        <!-- ESPACIO PARA INGRESAR EL ESTADO DEL ACTIVO FIJO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Estado</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                                    <select class="form-control input-lg" id="editarEstado" name="editarEstado">

                                        <option value="">Seleccionar el estado del AF</option>
                                        <option value="1">ACTIVO</option>
                                        <option value="2">INACTIVO</option>
                                        <option value="3">EN MANTENIMIENTO</option>
                                        <option value="4">PARA DONACIÓN</option>
                                        <option value="5">SCRAP</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-xs-6">

                                <label>Detalles</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarDetalle" name="editarDetalle" placeholder="Espacio para agregar detalles referentes al Activo Fijo">

                                </div>

                            </div>

                        </div>

                        <!-- Espacio para lo del cambio de departamento -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Departamento</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                    <select class="form-control input-lg" id="editarDepartamento" name="editarDepartamento">

                                        <option value="">Seleccionar Departamento</option>

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

                        </div>

                        <!-- Aquí termina lo del cambio de departamento -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para Laptops y CPU</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL HOST NAME-->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Host-Name</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarHostName" name="editarHostName" placeholder="Ingresa el Host Name">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para celulares y teléfonos</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NÚMERO DE TELÉFONO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Número</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarNumero" name="editarNumero" placeholder="Ingresa el número de teléfono (celulares/teléfonos)">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL IMEI -->

                            <div class="col-xs-6">

                                <label>Imei</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarImei" name="editarImei" placeholder="Ingresa el IMEI (celulares)">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL EMAIL DEL CELULAR -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>Email</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-at"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarCelEmail" name="editarCelEmail" placeholder="Ingresa el email asociado">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL MAC -->

                            <div class="col-xs-6">

                                <label>MAC</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarMac" name="editarMac" placeholder="Ingresa el MAC (Teléfonos)">

                                </div>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUMERO DE CONTRATO -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>No. de Contrato</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarContrato" name="editarContrato" placeholder="Ingresa el número de contrato">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <h4> <span class="label label-danger">Datos para impresoras</span></h4>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL IP -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>IP</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-print"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarIP" name="editarIP" placeholder="Ingresa la IP (Impresoras)">

                                </div>

                            </div>
                            <!-- INPUT PARA EL ESTADO ANTERIOR -->

                            <div class="hidden">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                                    <select class="form-control input-lg" id="estadoAnterior" name="estadoAnterior">

                                        <option value="">Seleccionar el estado del AF</option>
                                        <option value="1">ACTIVO</option>
                                        <option value="2">INACTIVO</option>
                                        <option value="3">EN MANTENIMIENTO</option>
                                        <option value="4">PARA DONACIÓN</option>
                                        <option value="5">SCRAP</option>

                                    </select>

                                </div>

                            </div>

                            <!-- INPUT PARA EL ESTADO ANTERIOR -->

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                </div>

            </form>

            <?php

            $editarAF = new ControladorInventarioRapido();
            $editarAF->ctrEditarRapido();

            ?>

        </div>

    </div>

</div>

<?php

$eliminarRapido = new ControladorInventarioRapido();
$eliminarRapido->ctrEliminarRapido();

?>