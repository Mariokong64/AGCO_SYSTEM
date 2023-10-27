<!-- AQUI SE ENCUENTRA TODA LA VISTA DEL MODULO DE DEPARTAMENTOS. EN ESTE HTML SE MUESTRAN TODOS LOS DEPARTAMENTOS QUE ESTÁN REGISTRADOS EN LA BASE DE DATOS Y CADA REGISTRO TIENE
     LAS OPCIONES DE EDITAR O ELIMINAR DICHO REGISTRO, SIN EMBARGO, ESTAS OPCIONES SE MUESTRAN DEPENDIENDO DEL PERFIL DEL USUARIO, EL CUAL SE TOMA MEDIANTE UNA VARIABLE DE SESIÓN -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Departamentos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de departamentos</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <?php

                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                    echo '

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDepartamento">Agregar Departamento</button>

                <button class="btn btn-success" id="reporteDepartamentos" style="margin-left: 15px">Exportar a excel</button>';
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

                            <!-- ESPACIO PARA INGRESAR EL DEPARTAMENTO -->

                            <div class="form-group row">

                                <div class="col-sm-4" style="margin-left: 15px;">

                                    <label>Departamento</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                        <input type="text" class="form-control input" id="filtroDepartamento" placeholder="Departamento" data-index="1">

                                    </div>

                                </div>


                                <!-- ESPACIO PARA INGRESAR EL CENTRO DE COSTOS -->

                                <div class="col-sm-4">

                                    <label>Centro de costos</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                                        <input type="text" class="form-control input" id="filtroCentroCostos" placeholder="Centro de costos" data-index="2">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- SECCIÓN DE LA TABLA -->

                <table id="tablaDepartamentos" class="table table-bordered table-striped dt-responsive tablas">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Departamento</th>
                            <th>Centro de Costos</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":

                                foreach ($departamentos as $key => $value) {

                                    echo '  <tr>

                                <td>' . ($key + 1) . '</td>
                                <td class="text-uppercase">' . $value["departamento"] . '</td>
                                <td class="text-uppercase">' . $value["centro_costos"] . '</td>
                                <td>

                                    <div class="btn-group">

                                        <button class="btn btn-warning btnEditarDepartamento" idDepartamento="' . $value["id_departamento"] . '" data-toggle="modal" data-target="#modalEditarDepartamento" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                        <button class="btn btn-danger btnEliminarDepartamento" idDepartamento="' . $value["id_departamento"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>

                                    </div>

                                </td>

                                </tr>';
                                }

                                break;

                            case "Soporte":

                                foreach ($departamentos as $key => $value) {

                                    echo '  <tr>
    
                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["departamento"] . '</td>
                                    <td class="text-uppercase">' . $value["centro_costos"] . '</td>
                                    <td>
    
                                        <div class="btn-group">

                                            <button class="btn btn-warning btnEditarDepartamento" idDepartamento="' . $value["id_departamento"] . '" data-toggle="modal" data-target="#modalEditarDepartamento" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
    
                                        </div>
    
                                    </td>
    
                                    </tr>';
                                }

                                break;

                            default:

                                foreach ($departamentos as $key => $value) {

                                    echo '  <tr>
        
                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["departamento"] . '</td>
                                        <td class="text-uppercase">' . $value["centro_costos"] . '</td>
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
                   VENTANA MODAL AGREGAR DEPARTAMENTO
======================================================== -->

<div id="modalAgregarDepartamento" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar Departamento</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL DEPARTAMENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoDepartamento" placeholder="Ingresa el nuevo departamento" id="nuevoDepartamento" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL CENTRO DE COSTOS -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                                <input type="text" class="form-control input-lg" name="nuevoCC" placeholder="Ingresa el nuevo centro de costos" id="nuevoCC" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>

                    <button type="submit" class="btn btn-primary">Guardar departamento</button>

                </div>

                <?php

                $crearDepartamento = new ControladorDepartamentos();
                $crearDepartamento->ctrCrearDepartamento();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
                   VENTANA MODAL EDITAR DEPARTAMENTO
======================================================== -->

<div id="modalEditarDepartamento" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form role="form" method="post">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Departamento</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL NUEVO NOMBRE DEL DEPARTAMENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                <input type="text" class="form-control input-lg" id="editarDepartamento" name="editarDepartamento" value="" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL NUEVO CENTRO DE COSTOS -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                                <input type="text" class="form-control input-lg" id="editarCC" name="editarCC" value="" required>

                            </div>

                        </div>

                        <!-- ESPACIO OCULTO PARA PONER EL ID DEL DEPARTAMENTO -->

                        <div class="form-group">

                            <div class="input-group">

                                <input type="hidden" id="idActual" name="idActual">

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

                $editarDepartamento = new ControladorDepartamentos();
                $editarDepartamento->ctrEditarDepartamento();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarDepartamento = new ControladorDepartamentos();
$borrarDepartamento->ctrBorrarDepartamento();

?>