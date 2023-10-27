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

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAFrecurrente">Agregar Activo Fijo</button>
                            
                            </div>
                            
                            <div class="col-sm-1">

                            <!-- Boton para exportar la tabla a un excel -->

                            <button class="btn btn-success" style="margin-left: 15px" id="reporteRecurrente">Exportar a excel</button>
                            
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

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Serie</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                                            <input type="text" class="form-control input" id="filtroSerieRecurrente" placeholder="Serie" data-index="0">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el tipo del af -->

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Tipo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-tv"></i></span>

                                            <input type="text" class="form-control input" id="filtroTipoRecurrente" placeholder="Tipo" data-index="1">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar la marca del af -->

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Marca</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-windows"></i></span>

                                            <input type="text" class="form-control input" id="filtroMarcaRecurrente" placeholder="Marca" data-index="2">

                                        </div>

                                    </div>
                                    <!--Espacio para filtrar el modelo del af -->

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Modelo</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-medium"></i></span>

                                            <input type="text" class="form-control input" id="filtroModeloRecurrente" placeholder="Modelo" data-index="3">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar si esta asignado o no el af -->

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Asignado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check-square"></i></span>

                                            <input type="text" class="form-control input" id="filtroAsignadoRecurrente" placeholder="Asignado" data-index="4">

                                        </div>

                                    </div>

                                    <!--Espacio para filtrar el nombre de quien lo tiene asignado -->

                                    <div class="col-sm-1" style="width: 16.5%">

                                        <label>Empleado asignado</label>

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user-secret"></i></span>

                                            <input type="text" class="form-control input" id="filtroEmpleadoRecurrente" placeholder="Empleado asignado" data-index="5">

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table class="table table-bordered table-striped dt-responsive tablaInventarioRecurrente" id="tablaInventarioRecurrente" style="width:100%">

                    <thead>

                        <tr>

                            <th style="width:150px">Serie</th>
                            <th style="width:150px">Tipo</th>
                            <th style="width:150px">Marca</th>
                            <th style="width:250px">Modelo</th>
                            <th style="width:40px">Asignado</th>
                            <th style="width:400px">Empleado</th>
                            <th>Detalles</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>