<!-- EN ESTE HTML SE MUESTRA LA VISTA DEL MODULO DE DEVOLUCIONES. AQUI SE PONE EN UNA TABLA TODOS LOS EMPLEADOS JUNTO CON LA CANTIDAD DE ACTIVOS FIJOS QUE TIENE CADA UNO
     ASÍ COMO UN BOTON PARA CONSULTAR QUE ACTIVOS FIJOS TIENE ESE EMPLEADO Y PODER DESASIGNARLOS. EL CONTENIDO DE ESTA TABLA VIENE DE UN AJAX QUE SE LLAMA DESDE UN ARCHIVO
     JAVASCRIPT QUE ESTÁ EN "vistas/JS/devolucionEmpleado.js" -->

<div class="content-wrapper">

    <section class="content-header">

        <h1>Administrador de Activos Asignados<small>Panel de control</small></h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrador de Activos Asignados</li>
        </ol>
        
    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">

                    Agregar Empleado

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaEmpleadosDevolucion" width="100%">

                    <thead>

                        <tr>

                            <th style="width:20px">No.</th>
                            <th style="width:500px">Nombre del empleado</th>
                            <th style="width:500px">Puesto</th>
                            <th style="width:100px">AFs Asignados</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>