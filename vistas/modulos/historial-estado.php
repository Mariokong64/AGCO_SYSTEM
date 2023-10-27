<!-- AQUÍ ES EN DONDE ESTÁ LA VISTA DEL MODULO DEL HISTORIAL DE LOS CAMBIOS DE ESTADOS. EL CONTENIDO DE LA TABLA QUE ESTÁ AQUI SE TRAE DESDE UN AJAX LLAMADO DESDE UN ARCHIVO
     JAVASCRIPT QUE SE ENCUENTRA EN "vistas/JS/historialEstado.js" -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>
            Historial de cambios de estado de los activos fijos
            <small>Panel de control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Historial de cambios de estado de los activos fijos</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <!-- inicio de los botones

                <div class="row">

                    <div class="col-sm-1">

                        <button class="btn btn-success" style="margin-left: 15px" id="reporteHistorialEstados">Exportar a excel</button>

                    </div>

                    <div class="col-sm-4">

                        <div class="input-group">

                            <div class="input-group-btn">
                                <button class="btn btn-danger btnImprimirReporteHistorialEstados" id="btnImprimirReporteHistorialEstados" style="width: 120px; margin-left: 15px">Exportar a PDF</button>
                            </div>
                            <input type="text" class="form-control" id="NombreReporteDeHistorialEstados" name="NombreReporteDeHistorialEstados" placeholder="Ingresa el título del reporte" style="width: 400px">

                        </div>

                    </div>

                </div>

                 final de los botones -->

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaHistorialEstado" id="tablaHistorialEstado" width="100%">

                    <thead>

                        <tr>

                            <th>Serie del AF</th>
                            <th>Tipo del AF</th>
                            <th>Estado anterior</th>
                            <th>Estado posterior</th>
                            <th>Realizó</th>
                            <th>Fecha</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>