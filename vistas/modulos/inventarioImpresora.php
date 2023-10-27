<!-- ESTA ES LA VISTA DEL MODULO DE "INVENTARIO IMPRESORA". EL CONTENIDO DE LA TABLA DE ESTE MODULO SE GENERA EN UN AJAX QUE ES LLAMADO DESDE UN JAVASCRIPT QUE
     ESTA EN "vistas/JS/inventarioImpresora.js"-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de impresoras<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de impresoras</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <!-- Aquí van los botones para agregar activos fijos, para exportar el contenido de la tabla a un excel o para exportarlo a un PDF junto con el título  -->

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                    <div class="row">

                        <div class="col-sm-1">
                            
                            <!-- Boton para agregar un activo fijo general -->

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarImpresora">Agregar Activo Fijo</button>

                        </div>

                        <div class="col-sm-1">

                            <!-- Boton para exportar la tabla a un excel -->

                            <button class="btn btn-success" style="margin-left: 15px" id="reporteInventarioImpresoras">Exportar a excel</button>
                    
                        </div>
                                
                        <div class="col-sm-4"> 
                    
                        <!-- Boton para exportar la tabla a un PDF -->

                             <div class="input-group"> 

                                <div class="input-group-btn">
                                    
                                    <button class="btn btn-danger btnImprimirReporteImpresora" id="btnImprimirReporteImpresora" style="width: 120px; margin-left: 15px">Exportar a PDF</button>
                        
                                </div>    
                            
                                <input type="text" class="form-control" id="NombreReporteDeImpresoras" name="NombreReporteDeImpresoras" placeholder="Ingresa el título del reporte" style="width: 400px">
                    
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

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Serie</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                            <input type="text" class="form-control input" id="filtroSerieImpresora" placeholder="Serie" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el modelo del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Modelo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                            <input type="text" class="form-control input" id="filtroModeloImpresora" placeholder="Modelo" data-index="1">

                                        </div>

                                    </div>


                                    <!--Espacio para filtrar la marca del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Marca</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                            <input type="text" class="form-control input" id="filtroMarcaImpresora" placeholder="Marca" data-index="2">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el estado del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Estado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                            <input type="text" class="form-control input" id="filtroEstadoImpresora" placeholder="Estado" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el departamento del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Departamento</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                            <input type="text" class="form-control input" id="filtroDepartamentoImpresora" placeholder="Departamento" data-index="4">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la ubicación del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Ubicación</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrows"></i></span>

                                            <input type="text" class="form-control input" id="filtroUbicacionImpresora" placeholder="Ubicación" data-index="5">

                                        </div>

                                    </div>

                                </div>

                                <!-- FILA DE FILTROS 2 -->

                                <div class="col-lg-12 d-lg-flex" style="margin-top: 15px;">

                                    <!--Espacio para filtrar el estatus del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Estatus</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-inr"></i></span>

                                            <input type="text" class="form-control input" id="filtroEstatusImpresora" placeholder="Estatus" data-index="6">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la IP del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>IP</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-print"></i></span>

                                            <input type="text" class="form-control input" id="filtroIpImpresora" placeholder="IP" data-index="7">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar detalles del af -->

                                    <div class="col-sm-1" style="width: 16.6%">

                                        <label>Detalles</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa  fa-list-alt"></i></span>

                                            <input type="text" class="form-control input" id="filtroDetallesImpresora" placeholder="Detalles" data-index="8">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table class="table table-bordered table-striped dt-responsive tablaInventarioImpresora" id="tablaInventarioImpresora" style="width:100%">

                    <thead>

                        <tr>

                            <th>Serie</th>
                            <th style="width:70px">Modelo</th>
                            <th>Marca</th>
                            <th style="width:50px">Estado</th>
                            <th>Departamento</th>
                            <th>Ubicación</th>
                            <th>Estatus</th>
                            <th>IP</th>
                            <th>Detalles</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<!-- =======================================================
         VENTANA MODAL AGREGAR IMPRESORA
======================================================== -->

<div id="modalAgregarImpresora" class="modal fade" role="dialog">

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

                                    <input type="text" class="form-control input-lg" name="nuevoTipo" value="IMPRESORA" readonly>

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

                        <!-- ESPACIO PARA INGRESAR EL IP -->

                        <div class="form-group row">

                            <div class="col-xs-6">

                                <label>IP</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoIP" placeholder="Ingresa la IP (Impresoras)">

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR DETALLES-->

                            <div class="col-xs-6">

                                <label>Detalles</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                    <input type="text" class="form-control input-lg" name="nuevoDetalle" placeholder="Espacio para agregar detalles referentes al Activo Fijo">

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

            $registrarImpresora = new ControladorInventarioImpresora();
            $registrarImpresora->ctrRegistrarImpresora();

            ?>

        </div>

    </div>

</div>


<!-- =======================================================
         VENTANA MODAL EDITAR IMPRESORA
======================================================== -->

<div id="modalEditarImpresora" class="modal fade" role="dialog">

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

                                    <input type="text" class="form-control input-lg" name="editarTipo" value="IMPRESORA" readonly>

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

                            <div class="col-xs-6">

                                <label>IP</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-print"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarIP" name="editarIP" placeholder="Ingresa la IP (Impresoras)">

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

                            <div class="col-xs-6">

                                <label>Detalles</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                                    <input type="text" class="form-control input-lg" id="editarDetalle" name="editarDetalle" placeholder="Espacio para agregar detalles referentes al Activo Fijo">

                                </div>

                            </div>

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

            $editarImpresora = new ControladorInventarioImpresora();
            $editarImpresora->ctrEditarImpresora();

            ?>

        </div>

    </div>

</div>

<?php

$eliminarImpresora = new ControladorInventarioImpresora();
$eliminarImpresora->ctrEliminarImpresora();

?>