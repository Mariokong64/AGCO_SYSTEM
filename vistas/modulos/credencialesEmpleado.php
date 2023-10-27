<!-- ESTE ES LA VISTA DE LA PAGINA EN DONDE SE MUESTRAN LAS CREDENCIALES DE UN EMPLEADO EN ESPECÍFICO EL CUAL SE SELECCIONÓ ANTERIORMENTE EN EL ARCHIVO UBICADO EN
     "vistas/modulos/credenciales.php" LO QUE SE HACE AQUÍ ES OBTENER EL ID DEL EMPLEADO QUE VIENE EN LA URL MEDIANTE UN MÉTODO GET Y LO BUSCA EN LA BASE DE DATOS
     TANTO EN LA TABLA DE CREDENCIALES COMO EN LA TABLA DE EMPLEADOS PARA FINALMENTE MOSTRAR LOS RESULTADOS EN LA TABLA -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Credenciales<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de Credenciales</li>
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

                echo '<h1>' . $empleado["nombre"] . '</h1>';

                ?>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas">

                    <thead>

                        <tr>

                            <th style="width: 300px">Global</th>
                            <th>Intélisis</th>
                            <th style="width: 250px">Impresora</th>
                            <th style="width: 250px">Correo</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $credenciales = ControladorCredenciales::ctrMostrarCredenciales($item, $valor);

                        if($credenciales == false){
                            $credenciales["credencial_global"] = "Sin credencial";
                            $credenciales["credencial_intelisis"] = "Sin credencial";
                            $credenciales["impresora"] = "Sin credencial";
                            $empleado["email"] = "Sin email";
                        }

                        //Aqui imprimimos los datos de este activo en la tabla

                        echo '  <tr>

                                        <td class="text-uppercase">' . $credenciales["credencial_global"] . '</td>
                                        <td class="text-uppercase">' . $credenciales["credencial_intelisis"] . '</td>
                                        <td class="text-uppercase">' . $credenciales["impresora"] . '</td>
                                        <td class="text-uppercase">' . $empleado["email"] . '</td>
                                        <td>

                                            <div class="btn-group">              
                                            
                                            <button class="btn btn-info btnImprimirCredencial btnImprimirCredencial" idCredencial="' . $credenciales["id_credencial"] . '" style="margin-left: 10px;"><i class="fa fa-print"></i>Imprimir</button>
                                            <button class="btn btn-warning btnEditarCredencial" idCredencial="' . $credenciales["id_credencial"] . '" data-toggle="modal" data-target="#modalEditarCredencial" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                            <button class="btn btn-danger btnEliminarCredencial" idEmpleado="' . $valor . '" idEliminarParcialmenteCredencial="' . $credenciales["id_credencial"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>
        

                                            </div>

                                        </td>

                                    </tr>';

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR CREDENCIAL
======================================================== -->

<div id="modalEditarCredencial" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Credenciales</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA EDITAR LA CREDENCIAL GLOBAL -->

                        <div class="form-group">

                            <label>Credencial Global</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-rocket"></i></span>

                                <input type="text" class="form-control input-lg" id="editarGlobal" name="editarGlobal" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CONTRASEÑA GLOBAL -->

                        <div class="form-group">

                            <label>Crontraseña Global</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-rocket"></i></span>

                                <input type="password" class="form-control input-lg" id="ctrGlobal" name="ctrGlobal" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CREDENCIAL DE INTELISIS -->

                        <div class="form-group">

                            <label>Credencial Intélisis</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-space-shuttle"></i></span>

                                <input type="text" class="form-control input-lg" id="editarIntelisis" name="editarIntelisis" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CONTRASEÑA DE INTELISIS -->

                        <div class="form-group">

                            <label>Contraseña Intélisis</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-space-shuttle"></i></span>

                                <input type="password" class="form-control input-lg" id="ctrIntelisis" name="ctrIntelisis" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CREDENCIAL DE LA IMPRESORA -->

                        <div class="form-group">

                            <label>Credencial de Impresora</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-print"></i></span>

                                <input type="text" class="form-control input-lg" id="editarCredencialImpresora" name="editarCredencialImpresora" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CONTRASEÑA DE LA IMPRESORA -->

                        <div class="form-group">

                            <label>Contraseña Impresora</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-print"></i></span>

                                <input type="password" class="form-control input-lg" id="ctrImpresora" name="ctrImpresora" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR EL PASSCODE -->

                        <div class="form-group">

                            <label>Passcode</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-connectdevelop"></i></span>

                                <input type="password" class="form-control input-lg" id="passcode" name="passcode" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO PARA EDITAR LA CONTRASEÑA DEL EMAIL -->

                        <div class="form-group">

                            <label>Contraseña Email</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>

                                <input type="password" class="form-control input-lg" id="ctremail" name="ctremail" value="" >

                            </div>

                        </div>

                        <!-- ESPACIO OCULTO PARA PONER EL ID DE LA CREDENCIAL -->

                        <div class="form-group">

                            <div class="input-group">

                                <input type="hidden" id="idCredencial" name="idCredencial">

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

                $editarCredenciales = new ControladorCredenciales();
                $editarCredenciales->ctrEditarCredenciales();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarParcialmenteCredencial = new ControladorCredenciales();
$borrarParcialmenteCredencial->ctrBorrarParcialmenteCredencial();

?>