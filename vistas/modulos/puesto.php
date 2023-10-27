<!-- ESTA ES LA VISTA DE LA SECCIÓN DE LOS PUESTOS DE ACTIVOS FIJOS -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de puestos de trabajo<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de puestos de trabajo</li>
        </ol>
        
    </section>

    <section class="content">

        <div class="box">

         <!-- Aquí van los botones para agregar puestos de trabajo y para exportar a un excel. Se muestran dependiendo del perfil del usuario  -->

            <div class="box-header with-border">

            <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                echo '

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPuesto">Agregar puesto de trabajo</button>
                <button class="btn btn-success" id="reportePuestos" style="margin-left: 15px">Exportar a excel</button>';

            }
            ?>

            </div>

            <div class="box-body">

            <!-- Esta es la tabla que muestra los puestos de trabajo que se encuentran en la base de datos  -->

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaPuestos">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Puesto de Trabajo</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $puestos = ControladorPuestos::ctrMostrarPuestos($item, $valor);

                         /*Aqui vamos a colocar el contenido de la tabla dependiendo de que tipo de usuario esta logeado. Si no tiene permisos para editar o eliminar entonces le ocultamos ese botón*/ 

                        switch($_SESSION["perfil"]) {

                            case "Administrador":

                            foreach ($puestos as $key => $value) {

                                echo '  <tr>

                                <td>' . ($key + 1) . '</td>
                                <td class="text-uppercase">' . $value["puesto"] . '</td>
                                <td>

                                    <div class="btn-group">

                                    <button class="btn btn-warning btnEditarPuesto" idPuesto="' . $value["id_puesto"] . '" data-toggle="modal" data-target="#modalEditarPuesto" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>    
                                     <button class="btn btn-danger btnEliminarPuesto" idPuesto="' . $value["id_puesto"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>
                               
                            
                                </div>

                                </td>

                                </tr>';
                            }
                        
                            break;

                            case "Soporte":

                            foreach ($puestos as $key => $value) {

                                echo '  <tr>

                                <td>' . ($key + 1) . '</td>
                                <td class="text-uppercase">' . $value["puesto"] . '</td>
                                <td>

                                    <div class="btn-group">

                                    <button class="btn btn-warning btnEditarPuesto" idPuesto="' . $value["id_puesto"] . '" data-toggle="modal" data-target="#modalEditarPuesto" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>    
                                                           
                                </div>

                                </td>

                                </tr>';
                            }

                            break;

                            default:

                            foreach ($puestos as $key => $value) {

                                echo '  <tr>

                                <td>' . ($key + 1) . '</td>
                                <td class="text-uppercase">' . $value["puesto"] . '</td>
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
                   VENTANA MODAL AGREGAR PUESTO
======================================================== -->

<div id="modalAgregarPuesto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar puesto de trabajo</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO PUESTO DE TRABAJO -->

                        <div class="form-group">

                            <label>Puesto</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoPuesto" placeholder="Ingresa el nuevo puesto de trabajo" id="nuevoPuesto" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar puesto</button>

                </div>

                <?php

                $crearPuesto = new ControladorPuestos();
                $crearPuesto->ctrCrearPuesto();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR PUESTOS
======================================================== -->

<div id="modalEditarPuesto" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar puesto de trabajo</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL PUESTO -->

                        <div class="form-group">

                            <label>Puesto</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input-lg" name="editarPuesto" id="editarPuesto" required>

                                <input type="hidden" name="idPuesto" id="idPuesto" required>

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

                $editarPuesto = new ControladorPuestos();
                $editarPuesto->ctrEditarPuesto();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarPuesto = new ControladorPuestos();
$borrarPuesto->ctrBorrarPuesto();

?>