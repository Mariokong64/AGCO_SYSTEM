<!-- ESTA ES LA VISTA DEL MODULO DE LAS CREDENCIALES DE USUARIOS. AQUÍ SOLO SE DIBUJA LA TABLA, PERO TODO EL CONTENIDO DE LA TABLA SE HACE CON UN AJAX QUE SE LLAMA
     DESDE UN JAVASCRIPT QUE ESTÁ EN "vistas/JS/credenciales.js" EN ESTA TABLA SE MUESTRAN LOS USUARIOS REGISTRADOS Y CADA UNO TIENE UN BOTÓN ROSA PARA CONSULTAR 
     LAS CREDENCIALES DE ESE EMPLEADO EN ESPECÍFICO -->

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

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaEmpleadosCredencial" width="100%">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th style="width:400px">Nombre del empleado</th>
                            <th style="width:400px">Puesto</th>
                            <th style="width:400px">Departamento</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>