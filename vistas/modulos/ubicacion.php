<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de ubicaciones<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de ubicaciones</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUbicacion">Agregar ubicación</button>
                          <button class="btn btn-success" id="reporteUbicaciones" style="margin-left: 15px">Exportar a excel</button>';
                }
                ?>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaUbicaciones">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":


                                foreach ($ubicaciones as $key => $value) {

                                    echo '  <tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["ubicacion"] . '</td>
                                        <td>

                                            <div class="btn-group">

                                                <button class="btn btn-warning btnEditarUbicacion" idUbicacion="' . $value["id_ubicacion"] . '" data-toggle="modal" data-target="#modalEditarUbicacion" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                                <button class="btn btn-danger btnEliminarUbicacion" idUbicacion="' . $value["id_ubicacion"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>

                                            </div>

                                        </td>

                                    </tr>';
                                }
                            break;

                            case "Soporte":

                                foreach ($ubicaciones as $key => $value) {

                                    echo '  <tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["ubicacion"] . '</td>
                                        <td>

                                            <div class="btn-group">

                                                <button class="btn btn-warning btnEditarUbicacion" idUbicacion="' . $value["id_ubicacion"] . '" data-toggle="modal" data-target="#modalEditarUbicacion" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                               
                                            </div>

                                        </td>

                                    </tr>';
                                }
                            break;

                            default:

                                foreach ($ubicaciones as $key => $value) {

                                    echo '  <tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["ubicacion"] . '</td>
                                        <td></td>

                                    </tr>';
                                }
                            break;

                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
                   VENTANA MODAL AGREGAR UBICACION
======================================================== -->

<div id="modalAgregarUbicacion" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar ubicación</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA UBICACION -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaUbicacion" placeholder="Ingresa la nueva ubicacion" id="nuevaUbicacion" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar marca</button>

                </div>

                <?php

                $crearUbicacion = new ControladorUbicaciones();
                $crearUbicacion->ctrCrearUbicacion();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR UBICACIONES
======================================================== -->

<div id="modalEditarUbicacion" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Ubicacion</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA UBICACION -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarUbicacion" id="editarUbicacion" required>

                                <input type="hidden" name="idUbicacion" id="idUbicacion" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

                <?php

                $editarUbicacion = new ControladorUbicaciones();
                $editarUbicacion->ctrEditarUbicacion();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarUbicacion = new ControladorUbicaciones();
$borrarUbicacion->ctrBorrarUbicacion();

?>