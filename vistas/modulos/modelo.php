<!-- ESTA ES LA VISTA DE LA SECCIÓN DE LOS MODELOS DE ACTIVOS FIJOS   -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de modelos de Activos Fijos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de modelos de AF</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

        <!-- Aquí van los botones para agregar modelos de activos fijos y para exportar a un excel. Se muestran dependiendo del perfil del usuario  -->

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModelo">Agregar modelo de Activo Fijo</button>
                <button class="btn btn-success" id="reporteModelos" style="margin-left: 15px">Exportar a excel</button>';
                }
                ?>

            </div>

            <div class="box-body">

            <!-- Esta es la tabla que muestra los modelos de activos fijos que se encuentran en la base de datos  -->

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaModelos">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Modelo de Activo Fijo</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $modelos = ControladorModelos::ctrMostrarModelos($item, $valor);

                         /*Aqui vamos a colocar el contenido de la tabla dependiendo de que tipo de usuario esta logeado. Si no tiene permisos para editar o eliminar entonces le ocultamos ese botón*/ 

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":

                            foreach ($modelos as $key => $value) {

                                echo '  <tr>

                                <td>' . ($key + 1) . '</td>
                                <td class="text-uppercase">' . $value["modelo"] . '</td>
                                <td>

                                    <div class="btn-group">

                                        <button class="btn btn-warning btnEditarModelo" idModelo="' . $value["id_modelo"] . '" data-toggle="modal" data-target="#modalEditarModelo" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                        <button class="btn btn-danger btnEliminarModelo" idModelo="' . $value["id_modelo"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>

                                    </div>

                                </td>

                                </tr>';
                            }

                            break;

                            case "Soporte":

                                foreach ($modelos as $key => $value) {
    
                                    echo '  <tr>
    
                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["modelo"] . '</td>
                                    <td>
    
                                        <div class="btn-group">
    
                                            <button class="btn btn-warning btnEditarModelo" idModelo="' . $value["id_modelo"] . '" data-toggle="modal" data-target="#modalEditarModelo" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                 
                                        </div>
    
                                    </td>
    
                                    </tr>';
                                }
    
                            break;

                            default:

                                foreach ($modelos as $key => $value) {
    
                                    echo '  <tr>
    
                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["modelo"] . '</td>
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
                   VENTANA MODAL AGREGAR MODELO
======================================================== -->

<div id="modalAgregarModelo" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Modelo de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL MODELO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoModelo" placeholder="Ingresa el nuevo modelo de AF" id="nuevoModelo" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar modelo</button>

                </div>

                <?php

                $crearModelo = new ControladorModelos();
                $crearModelo->ctrCrearModelo();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR MODELOS
======================================================== -->

<div id="modalEditarModelo" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Modelo de AF</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL MODELO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" required>

                                <input type="hidden" name="idModelo" id="idModelo" required>

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

                $editarModelo = new ControladorModelos();
                $editarModelo->ctrEditarModelo();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarModelo = new ControladorModelos();
$borrarModelo->ctrBorrarModelo();

?>