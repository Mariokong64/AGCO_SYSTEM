<!-- ESTA ES LA VISTA DEL MODULO DE "RENOVACIONES" EN ESTE MODULO SE MUESTRAN TODOS LOS ACTIVOS FIJOS Y TIENE COMO OBJETIVO PRINCIPAL EL HACER CÁLCULOS 
DE LAS FECHAS DE RENOVACIÓN DE CADA UNO DE LOS ACTIVOS FIJOS-->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de renovaciones<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de renovaciones</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">
            
            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                            <div class="row">

                            <div class="col-sm-1" style="width: 10%">

                            <!-- Boton para generar el reporte de renovaciones -->

                            <button class="btn btn-info" style="margin-left: 15px" data-toggle="modal" data-target="#modalRenovaciones">Establecer años a sumar</button>
                            
                            </div>
                                
                                <div class="col-sm-1">

                                <!-- Boton para exportar la tabla a un excel -->

                                <button class="btn btn-success" style="margin-left: 15px" id="reporteRenovacionesExcel">Exportar a excel</button>
                                
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

                                            <input type="text" class="form-control input" id="filtroSerieRenovaciones" placeholder="Serie" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el tipo del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Tipo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                            <input type="text" class="form-control input" id="filtroTipoRenovaciones" placeholder="Tipo" data-index="1">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la marca del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Marca</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                            <input type="text" class="form-control input" id="filtroMarcaRenovaciones" placeholder="Marca" data-index="2">

                                        </div>

                                    </div>
                                    <!--Espacio para filtrar el modelo del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Modelo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                            <input type="text" class="form-control input" id="filtroModeloRenovaciones" placeholder="Modelo" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar si esta asignado o no el af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Asignado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>

                                            <input type="text" class="form-control input" id="filtroAsignadoRenovaciones" placeholder="Asignado" data-index="4">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-12 d-lg-flex" style="margin-top: 15px;">

                                    <!--Espacio para filtrar el estado del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Estado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-cog"></i></span>

                                            <input type="text" class="form-control input" id="filtroEstadoRenovaciones" placeholder="Estado" data-index="5">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el Estatus de adquisición del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Estatus</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                            <input type="text" class="form-control input" id="filtroEstatusRenovaciones" placeholder="Departamento" data-index="6">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la fecha de compra del af -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Fecha de compra</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrows"></i></span>

                                            <input type="text" class="form-control input" id="filtroFechaCompraRenovaciones" placeholder="Ubicación" data-index="7">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la fecha de vencimiento -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Fecha de vencimiento</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>

                                            <input type="text" class="form-control input" id="filtroVencimientoRenovaciones" placeholder="Empleado asignado" data-index="8">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la fecha de renovación -->

                                    <div class="col-sm-1" style="width: 20%">

                                        <label>Fecha de renovación (colocar solo el año)</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>

                                            <input type="text" class="form-control input" id="filtrofechaRenovaciones" placeholder="Empleado asignado" data-index="9">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table class="table table-bordered table-striped dt-responsive tablaRenovaciones" id="tablaRenovaciones" style="width:100%">

                    <thead>

                        <tr>

                            <th>Serie</th>
                            <th>Tipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Asignado</th>
                            <th>Estado</th>
                            <th>Estatus</th>
                            <th>Fecha de compra</th>
                            <th>Fecha de vencimiento</th>
                            <th>Fecha de renovación</th>

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

<div id="modalRenovaciones" class="modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Establecer criterios</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUMERO A SUMAR A LA FECHA DE COMPRA -->

                        <div class="form-group row">

                            <div class="col-xs-12">

                                <label>¿Cuántos años quiere sumar a la fecha de compra?</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="añosSumar" name="añosSumar" placeholder="Ingresa un número sin espacios" required>

                                </div>

                            </div>

                            <!-- ESPACIO PARA INGRESAR EL TIPO DE ACTIVOS A PONER EN EL REPORTE -->

                            <div class="col-xs-12">

                                <label>¿Qué tipo de activo desea consultar? (Dejar vacío en caso de querer consultar todos)</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                    <select class="form-control input-lg" name="tipoRenovacion" id="tipoRenovacion">

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

                            <!-- ESPACIO PARA INGRESAR EL NUMERO DE AÑÓS A CONSULTAR -->

                            <div class="col-xs-12">

                                <label>¿Qué rango máximo de años desea inlcuir a partir del año actual? (dejar vacío si desea incluir todos)</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                    <input type="text" class="form-control input-lg" id="añosMaximos" name="añosMaximos" placeholder="Ingresa un número sin espacios" required>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Pie de página del modal -->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                        <button type="submit" class="btn btn-primary" id="generarRenovaciones">Generar registros</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>