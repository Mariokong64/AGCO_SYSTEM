<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de facturas<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de facturas</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-danger" style="width: 125px;" data-toggle="modal" data-target="#modalSubirFactura">Subir factura</button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" id="tablaFacturas">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th>Número de factura</th>
                            <th>Nombre del documento</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $facturas = ControladorFacturas::ctrMostrarFacturas($item, $valor);

                        switch ($_SESSION["perfil"]) {

                            case "Administrador":


                                foreach ($facturas as $key => $value) {

                                    $nombre_factura = $value["nombre_factura"];
                                    $nombre_sin_numeros = substr($nombre_factura, 7);

                                    echo '  <tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["numero_factura"] . '</td>
                                        <td class="text-uppercase">' . $nombre_sin_numeros . '</td>
                                        <td>

                                            <div class="btn-group">

                                            <a href="'.$value["ruta_factura"].'" target="_blank" class="btn btn-primary btnConsultarFactura" style="margin-left: 5px;"><i class="fa fa-binoculars"></i> Consultar</a>
                                            <button class="btn btn-warning btnEditarFactura" idFactura="' . $value["id_factura"] . '" data-toggle="modal" data-target="#modalEditarFactura" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                            <button class="btn btn-danger btnEliminarFactura" idFactura="' . $value["id_factura"] . '" style="margin-left: 5px;"><i class="fa fa-trash-o"></i> Eliminar</button>
                                                
                                            </div>

                                        </td>

                                    </tr>';
                                }
                                break;

                            case "Soporte":

                                foreach ($facturas as $key => $value) {

                                    $nombre_factura = $value["nombre_factura"];
                                    $nombre_sin_numeros = substr($nombre_factura, 7);

                                    echo '  <tr>

                                        <td>' . ($key + 1) . '</td>
                                        <td class="text-uppercase">' . $value["numero_factura"] . '</td>
                                        <td class="text-uppercase">' . $nombre_sin_numeros . '</td>
                                        <td>

                                            <div class="btn-group">

                                            <a href="'.$value["ruta_factura"].'" target="_blank" class="btn btn-primary btnConsultarFactura" style="margin-left: 5px;"><i class="fa fa-binoculars"></i> Consultar</a>
                                            <button class="btn btn-warning btnEditarFactura" idFactura="' . $value["id_factura"] . '" data-toggle="modal" data-target="#modalEditarFactura" style="margin-left: 10px;"><i class="fa fa-pencil"></i> Editar</button>
                                             
                                            </div>

                                        </td>

                                    </tr>';
                                }
                                break;

                            default:

                            foreach ($facturas as $key => $value) {

                                $nombre_factura = $value["nombre_factura"];
                                $nombre_sin_numeros = substr($nombre_factura, 7);

                                echo '  <tr>

                                    <td>' . ($key + 1) . '</td>
                                    <td class="text-uppercase">' . $value["numero_factura"] . '</td>
                                    <td class="text-uppercase">' . $nombre_sin_numeros . '</td>
                                    <td>

                                        <div class="btn-group">

                                        <a href="'.$value["ruta_factura"].'" target="_blank" class="btn btn-primary btnConsultarFactura" style="margin-left: 5px;"><i class="fa fa-binoculars"></i> Consultar</a>
                                            
                                        </div>

                                    </td>

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
                VENTANA MODAL SUBIR FACTURAS
======================================================== -->

<div id="modalSubirFactura" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <h4 class="modal-title">Subir factura</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL CONTENIDO DEL MODAL ESTE -->

                        <div class="form-group">

                            <label>Número de factura</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-linux"></i></span>

                                <input type="text" class="form-control input-lg" name="numeroDeFactura" id="numeroDeFactura" placeholder="Número de factura" required>

                            </div>

                            <label style="padding-top: 20px">Archivo en PDF</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>

                                <input type="file" class="form-control input-lg" name="subirFacturaPDF" id="subirFacturaPDF" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL CONTENIDO DEL MODAL ESTE -->

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="submitPDF" value="upload">Subir factura</button>

                </div>

                <?php

                $subirFactura = new ControladorFacturas();
                $subirFactura->ctrSubirFactura();

                ?>

            </form>

        </div>

    </div>

</div>


<!-- =======================================================
                VENTANA MODAL EDITAR FACTURAS
======================================================== -->

<div id="modalEditarFactura" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background:#dd4b39; color:white">

                    <h4 class="modal-title">Editar factura</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ESPACIO PARA INGRESAR EL CONTENIDO DEL MODAL ESTE -->

                        <div class="form-group">

                            <label>Número de factura</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-linux"></i></span>

                                <input type="text" class="form-control input-lg" name="editarNumeroDeFactura" id="editarNumeroDeFactura" placeholder="Número de factura" required>
                                <input type="hidden" class="form-control input-lg" name="idFacturaEditar" id="idFacturaEditar">
                                <input type="hidden" class="form-control input-lg" name="facturaUnlinkear" id="facturaUnlinkear">

                            </div>

                            <label style="padding-top: 20px">Archivo en PDF</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>

                                <input type="file" class="form-control input-lg" name="editarSubirFacturaPDF" id="editarSubirFacturaPDF" required>

                            </div>

                        </div>

                        <!-- ESPACIO PARA INGRESAR EL CONTENIDO DEL MODAL ESTE -->

                    </div>

                </div>

                <!-- Pie de página del modal -->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="submitPDFEdited" value="upload">Editar factura</button>

                </div>

                <?php

                $editarFactura = new ControladorFacturas();
                $editarFactura->ctrEditarFactura();

                ?>

            </form>

        </div>

    </div>

</div>

<!-- =======================================================
            OBJETO PARA ELIMINAR LAS FACTURAS
======================================================== -->

<?php

$eliminarFactura = new ControladorFacturas();
$eliminarFactura->ctrBorrarFactura();

?>