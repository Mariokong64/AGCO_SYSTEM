<!-- ESTE HTML ES PARA HACER LA VISTA DEL MODULO DEL HISTORIAL DE MOVIMIENTOS, OSEA DE LAS ASIGNACIONES Y DEVOLUCIONES QUE SE HAN HECHO. EL CONTENIDO DE LA TABLA QUE SE MUESTRA
     AQUI VIENE DESDE UN AJAX QUE SE LLAMA DESDE UN JAVASCRIPT QUE SE ENCUENTRA EN "vistas/JS/hostorialmovimientos.js"  -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Historial de movimientos de activos fijos<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Historial de movimientos de activos fijos</li>
        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <!-- inicio de los botones (Por ahora no los voy a poner porque no me los pidieron)

                <div class="row">

                    <div class="col-sm-1">

                        <button class="btn btn-success" style="margin-left: 15px" id="reporteHistorialMovimientos">Exportar a excel</button>

                    </div>

                    <div class="col-sm-4">

                        <div class="input-group">

                            <div class="input-group-btn">
                                <button class="btn btn-danger btnImprimirReporteHistorialMovimientos" id="btnImprimirReporteHistorialMovimientos" style="width: 120px; margin-left: 15px">Exportar a PDF</button>
                            </div>
                            <input type="text" class="form-control" id="NombreReporteDeHistorialMovimientos" name="NombreReporteDeHistorialMovimientos" placeholder="Ingresa el título del reporte" style="width: 400px">

                        </div>

                    </div>

                </div>

              final de los botones -->

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaHistorialMovimientos" id="tablaHistorialMovimientos" width="100%">

                    <thead>

                        <tr>

                            <th style="width:150px">Movimiento</th>
                            <th>Serie del AF</th>
                            <th>Tipo del AF</th>
                            <th style="width:300px">Empleado</th>
                            <th>Realizó</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                            

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>