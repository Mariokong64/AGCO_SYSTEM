<!-- ESTA ES LA VISTA DE LA SECCIÓN DE LAS MARCAS DE ACTIVOS FIJOS   -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de marcas de Activos Fijos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de marcas de AF</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

        <!-- Aquí van los botones para agregar marcas de activos fijos y para exportar a un excel las marcas. Se muestran dependiendo del perfil del usuario  -->

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMarca">Agregar marca de Activo Fijo</button>
                <button class="btn btn-success" id="reporteMarcas" style="margin-left: 15px">Exportar a excel</button>';
                }
                ?>

            </div>
            
            <div class="box-body">

            <!-- Esta es la tabla que muestra las marcas de activos fijos que se encuentran en la base de datos  -->

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaMarcas">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Marca de Activo Fijo</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

                        /*Aqui vamos a colocar el contenido de la tabla dependiendo de que tipo de usuario esta logeado. Si no tiene permisos para editar o eliminar entonces le ocultamos ese botón*/ 

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":

                                foreach ($marcas as $key => $value) {

                                    echo '  <tr>

                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["marca"] . '</td>
                                    <td>

                                        <div class="btn-group">

                                            <button class="btn btn-warning btnEditarMarca" idMarca="' . $value["id_marca"] . '" data-toggle="modal" data-target="#modalEditarMarca" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                            <button class="btn btn-danger btnEliminarMarca" idMarca="' . $value["id_marca"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>

                                        </div>

                                    </td>

                                    </tr>';
                                }

                            break;

                            case "Soporte":

                                foreach ($marcas as $key => $value) {

                                    echo '  <tr>

                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["marca"] . '</td>
                                    <td>

                                        <div class="btn-group">

                                            <button class="btn btn-warning btnEditarMarca" idMarca="' . $value["id_marca"] . '" data-toggle="modal" data-target="#modalEditarMarca" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                         
                                        </div>

                                    </td>

                                    </tr>';
                                }

                            break;

                            default:

                                foreach ($marcas as $key => $value) {

                                    echo '  <tr>

                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["marca"] . '</td>
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
                   VENTANA MODAL AGREGAR MARCA
======================================================== -->

<div id="modalAgregarMarca" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Marca de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA MARCA -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresa la nueva marca de AF" id="nuevaMarca" required>

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

                $crearMarca = new ControladorMarcas();
                $crearMarca->ctrCrearMarca();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR MARCAS
======================================================== -->

<div id="modalEditarMarca" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Marca de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE LA MARCA -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" required>

                                <input type="hidden" name="idMarca" id="idMarca" required>

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

                $editarMarca = new ControladorMarcas();
                $editarMarca->ctrEditarMarca();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarMarca = new ControladorMarcas();
$borrarMarca->ctrBorrarMarca();

?>