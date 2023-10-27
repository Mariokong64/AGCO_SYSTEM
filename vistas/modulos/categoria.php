<!-- ESTA ES LA VISTA DEL MODULO DE CATEGORÍAS DE ACTIVOS FIJOS -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de categorías de Activos Fijos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de categorías de AF</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Agregar categoría de Activo Fijo</button>

                <button class="btn btn-success" id="reporteCategorias" style="margin-left: 15px">Exportar a excel</button>';
                }
                ?>

            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaCategorias">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Categoría de Activo Fijo</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":

                                foreach ($categorias as $key => $value) {

                                    echo '  <tr>

                                                <td>' . ($key + 1) . '</td>
                                                <td class="text-uppercase">' . $value["tipo"] . '</td>
                                                <td>

                                                    <div class="btn-group">

                                                        <!-- <button class="btn btn-primary"><i class="fa fa-pencil"></i> Consultar</button> -->
                                                        <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value["id_tipo"] . '" data-toggle="modal" data-target="#modalEditarCategoria" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                                        <button class="btn btn-danger btnEliminarCategoria" idCategoria="' . $value["id_tipo"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>

                                                    </div>

                                                </td>

                                            </tr>';
                                }

                            break;

                            case "Soporte":

                                foreach ($categorias as $key => $value) {

                                    echo '  <tr>

                                                <td>' . ($key + 1) . '</td>
                                                <td class="text-uppercase">' . $value["tipo"] . '</td>
                                                <td>

                                                    <div class="btn-group">

                                                        <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value["id_tipo"] . '" data-toggle="modal" data-target="#modalEditarCategoria" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>

                                                    </div>

                                                </td>

                                            </tr>';
                                }

                            break;

                            default:

                                foreach ($categorias as $key => $value) {

                                    echo '  <tr>

                                                <td>' . ($key + 1) . '</td>
                                                <td class="text-uppercase">' . $value["tipo"] . '</td>
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
                   VENTANA MODAL AGREGAR CATEGORÍA
======================================================== -->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Categoría de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA CATEGORÍA -->

                        <div class="form-group">

                            <label>Categoría</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaCategoria" placeholder="Ingresa la nueva categoría de AF" id="nuevaCategoria" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar categoría</button>

                </div>

                <?php

                $crearCategoria = new ControladorCategorias();
                $crearCategoria->ctrCrearCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR CATEGORÍA
======================================================== -->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Categoría de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA CATEGORÍA -->

                        <div class="form-group">

                            <label>Categoría</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                                <input type="hidden" name="idCategoria" id="idCategoria" required>

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

                $editarCategoria = new ControladorCategorias();
                $editarCategoria->ctrEditarCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria->ctrBorrarCategoria();

?>