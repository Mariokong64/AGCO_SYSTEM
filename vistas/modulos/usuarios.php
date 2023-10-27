<!-- ESTE ES LA VISTA DEL MODULO DE USUARIOS. EN ESTE MODULO SE MUESTRAN LOS USUARIOS QUE ESTÁN EN LA BASE DE DATOS. SON LOS USUARIOS PARA EL SISTEMA -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Usuarios<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de usuarios</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">
        
        <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas">

                    <thead>

                        <tr>

                            <th style="width:150px">Nombre de usuario</th>
                            <th>Nombre de empleado</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $usuarios = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

                        foreach ($usuarios as $key => $value) {

                            echo '                        
                            <tr>

                                <td>' . $value["usuario"] . '</td>
                                <td>' . $value["nombre_usuario"] . '</td>
                                <td>' . $value["perfil"] . '</td>';

                            if ($value["estado_usuario"] == 1) {
                                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario = "0">Activado</button></td>';
                            } else {
                                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario = "1">Desactivado</button></td>';
                            }

                            echo   '<td>' . $value["ultimo_login"] . '</td>
                                    <td>
                                        <div class="btn-group">
    
                                        <!-- <button class="btn btn-primary"><i class="fa fa-pencil"></i> Consultar</button> -->
                                        <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id_usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                        <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["id_usuario"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>
                                        
                                        </div>
    
                                    </td>

                            </tr>';
                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!-- =======================================================
                   VENTANA MODAL AGREGAR USUARIO
======================================================== -->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Usuario</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE USUARIO -->

                        <div class="form-group">

                            <label>Nombre de usuario</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar nombre de usuario" id="nuevoUsuario" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE EMPLEADO -->

                        <div class="form-group">

                            <label>Nombre de empleado</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre de empleado" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR LA CONTRASEÑA -->

                        <div class="form-group">

                            <label>Contraseña</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL PERFIL DEL USUARIO -->

                        <div class="form-group">

                            <label>Perfil</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="nuevoPerfil" required>

                                    <option value="">Seleccionar Perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Trabajador">Trabajador</option>
                                    <option value="Soporte">Soporte</option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar usuario</button>

                </div>

                <?php

                $crearUsuario = new ControladorUsuarios();
                $crearUsuario->ctrCrearUsuario();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR USUARIO
======================================================== -->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Usuario</h4>

                </div>

                <!-- CUERPO DEL MODAL -->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE USUARIO -->

                        <div class="form-group">

                            <label>Nombre de usuario</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DE USUARIO -->

                        <div class="form-group">

                            <label>Nombre del empleado</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR LA CONTRASEÑA -->

                        <div class="form-group">

                            <label>Contraseña</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Editar contraseña">

                                <input type="hidden" id="passwordActual" name="passwordActual">

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL PERFIL DEL USUARIO -->

                        <div class="form-group">

                            <label>Perfil</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="editarPerfil">

                                    <option value="" id="editarPerfil"></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Trabajador">Trabajador</option>
                                    <option value="Soporte">Soporte</option>

                                </select>

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

                $editarUsuario = new ControladorUsuarios();
                $editarUsuario->ctrEditarUsuario();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>