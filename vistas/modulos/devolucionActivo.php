<!-- EN ESTE HTML SE MUESTRA LA VISTA DE SE SECCIÓN EN DONDE SE MUESTRAN LOS ACTIVOS FIJOS DE UN USUARIO EN ESPECÍFICO -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Activos Asignados<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de activos Asignados</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <!-- En este PHP hacemos la consulta de la tabla de empleados para ver como se llama el que tiene el id que se le pasa por la URL -->
                <?php

                $item = "id_empleado";
                $valor = $_GET["idEmpleado"];

                $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

                echo '<h1>' . $empleado["nombre"] . '</h1>
                
                <div class="box-header with-border botonImprimirActivos">

                    <div class="input-group">
                        <div class="input-group-btn">
                        <button type="submit" class="btn btn-info btnImprimirActivos" idImprimirReporteActivos="' . $empleado["id_empleado"] . '" style="width: 160px"><i class="fa fa-print"></i>Imprimir Activos</button>
                        </div>
                        <input type="text" class="form-control" id="nombreReporte" name="nombreReporte" placeholder="Ingresa el título del PDF" style="width: 500px">
                    </div>
                
                </div>

                <div class="box-header with-border botonImprimirDevolucion">

                <div class="input-group">
                    <div class="input-group-btn">
                    <button type="submit" class="btn btn-danger btnImprimirDevolucion" idImprimirReporteActivos="' . $empleado["id_empleado"] . '" style="width: 160px"><i class="fa fa-print"></i>Imprimir devolución</button>
                    </div>
                    <input type="text" class="form-control" id="nombreDevolucionReporte" name="nombreDevolucionReporte" placeholder="Ingresa el título del PDF" style="width: 500px">
                </div>
            
                </div>';

                ?>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas tablaActivosDeEmpleado">

                    <thead>

                        <tr>

                            <th style="width:20px">No</th>
                            <th style="width:150px">Serie</th>
                            <th style="width:150px">Tipo</th>
                            <th style="width:150px">Marca</th>
                            <th style="width:150px">Modelo</th>
                            <th style="width:150px">Ubicación</th>
                            <th style="width:200px">Estado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <!------------------------------------------------------------------------------------------------------- 
                            No quería hacer esto pero voy a tener que meter todo este chorizote de PHP aquí para que funcione 
                            ya que en la tabla dinámica no me toma la variable que paso por la URL con la variable $_GET 
                        -------------------------------------------------------------------------------------------------------->

                        <?php

                        $item = "id_empleado";
                        $itemTipo = "id_tipo";
                        $itemMarca = "id_marca";
                        $itemModelo = "id_modelo";
                        $itemUbicacion = "id_ubicacion";
                        $valor = $_GET["idEmpleado"];
                        $idEmpleado = $_GET["idEmpleado"];

                        $AFs = ControladorInventario::ctrMostrarInventarioDeEmpleado($item, $valor);

                        for ($i = 0; $i < count($AFs); $i++) {

                            //Aqui hacemos la consulta de la tabla de tipos para ver como se llama el tipo de este activo

                            $valor = $AFs[$i]["id_tipo"];
                            $tipos = ControladorCategorias::ctrMostrarCategorias($itemTipo, $valor);

                            if ($AFs[$i]["id_tipo"] != null) {
                                $AFtipo = $tipos["tipo"];
                            } else {
                                $AFtipo = 'NA';
                            }

                            //Aqui hacemos la consulta de la tabla de marcas para ver como se llama la marca de este activo

                            $valor = $AFs[$i]["id_marca"];
                            $marcas = ControladorMarcas::ctrMostrarMarcas($itemMarca, $valor);

                            if ($AFs[$i]["id_marca"] != null) {
                                $AFmarca = $marcas["marca"];
                            } else {
                                $AFmarca = 'NA';
                            }

                            //Aqui hacemos la consulta de la tabla de modelos para ver como se llama el modelo de este activo

                            $valor = $AFs[$i]["id_modelo"];
                            $modelos = ControladorModelos::ctrMostrarModelos($itemModelo, $valor);

                            if ($AFs[$i]["id_modelo"] != null) {
                                $AFmodelo = $modelos["modelo"];
                            } else {
                                $AFmodelo = 'NA';
                            }

                            //Aqui hacemos la consulta de las ubicaciones para ver en donde esta este activo

                            $valor = $AFs[$i]["id_ubicacion"];
                            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($itemUbicacion, $valor);

                            if ($AFs[$i]["id_ubicacion"] != null) {
                                $AFubicacion = $ubicaciones["ubicacion"];
                            } else {
                                $AFubicacion = 'NA';
                            }

                            //Aqui consultamos el estado del activo fijo y coloreamos el botón que se muestra en la tabla dependiendo de su estado

                            switch ($AFs[$i]["id_estado"]) {
                                case 1:
                                    $AFestado = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i> ACTIVO </button></div>";
                                    break;
                                case 2:
                                    $AFestado = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>  INACTIVO  </button></div>";
                                    break;
                                case 3:
                                    $AFestado = "<div class='btn-group'><button class='btn btn-warning btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";
                                    break;
                                case 4:
                                    $AFestado = "<div class='btn-group'><button class='btn btn-info btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>DONACIÓN</button></div>";
                                    break;
                                case 5:
                                    $AFestado = "<div class='btn-group'><button class='btn btn-github btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>SCRAP</button></div>";
                                    break;
                                default:
                                    $AFestado = 'NA';
                                    break;
                            }

                            //Aqui imprimimos los datos de este activo en la tabla dependiendo de las credenciales del usuario en sesión

                            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                                echo '  <tr>

                                        <td>' . ($i + 1) . '</td>
                                        <td class="text-uppercase">' . $AFs[$i]["serie"] . '</td>
                                        <td class="text-uppercase">' . $AFtipo . '</td>
                                        <td class="text-uppercase">' . $AFmarca . '</td>
                                        <td class="text-uppercase">' . $AFmodelo . '</td>
                                        <td class="text-uppercase">' . $AFubicacion . '</td>
                                        <td class="text-uppercase">' . $AFestado . '</td>
                                        <td>

                                            <div class="btn-group">              
                                                
                                                <button class="btn btn-danger btnDesasignar" data-toggle="modal" data-target="#modalDesasignarActivo" idActivo="' . $AFs[$i]["id_inventario"] . '" idEmpleado="' . $idEmpleado . '"><i class="fa fa-book" style="margin-right:6px"></i>Desasignar</button>
                                                <button class="btn btn-warning btnEditarActivoEmpleado" idActivoEmpleado="' . $AFs[$i]["serie"] . '" data-toggle="modal" data-target="#modalEditarActivo" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                       
                                            </div>

                                        </td>

                                    </tr>';
                            } else {

                                echo '  <tr>

                                <td>' . ($i + 1) . '</td>
                                <td class="text-uppercase">' . $AFs[$i]["serie"] . '</td>
                                <td class="text-uppercase">' . $AFtipo . '</td>
                                <td class="text-uppercase">' . $AFmarca . '</td>
                                <td class="text-uppercase">' . $AFmodelo . '</td>
                                <td class="text-uppercase">' . $AFubicacion . '</td>
                                <td class="text-uppercase">' . $AFestado . '</td>
                                <td>

                                    <div class="btn-group">              
                               
                                    </div>

                                </td>

                            </tr>';
                            }
                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
        VENTANA MODAL PARA DESASIGNAR UN ACTIVO
======================================================== -->

<div id="modalDesasignarActivo" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Criterios de devolución</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL MOTIVO DE LA DEVOLUCIÓN -->

                        <div class="form-group">

                            <label>Motivo de devolución del activo fijo</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-question"></i></span>

                                <select class="form-control input-lg" name="motivoDevolucion" required>

                                    <option value="">Seleccionar motivo de devolucion</option>
                                    <option value="1">REMPLAZO</option>
                                    <option value="2">ACTIVO DAÑADO</option>
                                    <option value="3">BAJA DE EMPLEADO</option>

                                </select>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO ESTADO EN EL QUE QUEDARÁ EL ACTIVO FIJO -->

                        <div class="form-group">

                            <label>Estado en el que quedará el activo fijo</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-refresh"></i></span>

                                <select class="form-control input-lg" name="estadoDevolucion" id="estadoDevolucion" required>

                                    <option value="">Seleccionar el estado posterior</option>
                                    <option value="1">ACTIVO</option>
                                    <option value="2">INACTIVO</option>
                                    <option value="3">MANTENIMIENTO</option>
                                    <option value="4">DONACION</option>
                                    <option value="5">SCRAP</option>

                                </select>

                            </div>

                        </div>

                        <!-- INPUT PARA EL ESTADO ANTERIOR -->

                        <div class="hidden">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-wrench"></i></span>

                                <select class="form-control input-lg" id="estadoAnteriorDevolucion" name="estadoAnteriorDevolucion">

                                    <option value="">Seleccionar el estado del AF</option>
                                    <option value="1">ACTIVO</option>
                                    <option value="2">INACTIVO</option>
                                    <option value="3">EN MANTENIMIENTO</option>
                                    <option value="4">PARA DONACIÓN</option>
                                    <option value="5">SCRAP</option>

                                </select>

                            </div>

                        </div>

                        <!-- ESPACIO OCULTO PARA PONER EL ID DEL ACTIVO -->

                        <div class="form-group">

                            <div class="input-group">

                                <input type="hidden" id="idDelActivo" name="idDelActivo">

                            </div>

                        </div>

                        <!-- ESPACIO OCULTO PARA PONER EL ID DEL EMPLEADO -->

                        <div class="form-group">

                            <div class="input-group">

                                <input type="hidden" id="idDelEmpleado" name="idDelEmpleado">

                            </div>

                        </div>

                        <!-- ETIQUETA DE ADVERTENCIA -->

                        <h3 class="text-center" style="color:red"><strong>¡ATENCIÓN!</strong></h3>

                        <label>Al dar click en el botón "Desasignar" significa que ha recibido el activo fijo por parte del empleado</label>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Desasignar</button>

                </div>

                <?php

                $desasignarActivo = new ControladorDevolucionActivos();
                $desasignarActivo->ctrDesasignarActivo();

                ?>

            </form>

        </div>

    </div>

</div>


<!-- ===========================================================
         VENTANA MODAL EDITAR ACTIVO FIJO DE UN EMPLEADO
============================================================ -->

<div id="modalEditarActivo" class="modal fade" role="dialog">

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

                                    <input type="date" class="form-control input-lg" id="editarFechaVencimiento" name="editarFechaVencimiento" placeholder="Ingresa la fecha de vencimiento (AF arrendados)">

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

                            <!-- SELECT PARA INGRESAR LA POSICIÓN EN LA QUE ESTARÁ EL ACTIVO FIJO -->

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

                                    <input type="text" class="form-control input-lg" id="editarNumero" name="editarNumero" placeholder="Ingresa el número de teléfono (celulares/teléfonos)" data-inputmask="'mask':'(99) 9999-9999'" data-mask>

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

                            <!-- ESPACIO OCULTO PARA PONER EL ID DEL EMPLEADO -->

                            <div class="form-group">

                                <div class="input-group">

                                    <input type="hidden" id="idEmpleado" name="idEmpleado">

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

            $editarAF = new ControladorInventario();
            $editarAF->ctrEditarActivos();

            ?>

        </div>

    </div>

</div>