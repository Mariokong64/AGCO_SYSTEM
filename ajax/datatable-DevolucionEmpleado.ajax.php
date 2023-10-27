<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";
require_once "../controladores/puesto.controlador.php";
require_once "../modelos/puesto.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class tablaEmpleadosDevolucion
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS EMPLEADOS
    ===================================================*/

    public function mostrarTablaEmpleadosDevolucion()
    {
        $item = null;
        $valor = null;
        $itemP = "id_puesto";
        $itemE = "id_empleado";

        $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($empleados); $i++) {

            $valor = $empleados[$i]["id_empleado"];

            $botones = "<div class='btn-group'><a href='index.php?ruta=devolucionActivo&idEmpleado=" . $valor . "'><button class='btn btn-facebook btnConsultarEmpleado' idEmpleado='" . $empleados[$i]["id_empleado"] . "'><i class='fa fa-book' style='margin-right:6px'></i> Consultar Activos</button></a></div>";

            //Aquí obtenemos el nombre y los apellidos del empleado y los concatenamos para que se muestren juntos
            $nombre = $empleados[$i]["nombre"];
            $apellidoP = $empleados[$i]["apellido_paterno"];
            $apellidoM = $empleados[$i]["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;
           
            // Aquí hacemos la consulta a la tabla de puestos para ver cual coincide con el puesto de cada empleado que obtuvimos de la tabla de empleados. Si el resultado viene vacío lo igualamos a otro valor para que no nos de error.
            $valor = $empleados[$i]["id_puesto"];
            $puestos = ControladorPuestos::ctrMostrarPuestos($itemP, $valor);

            if ($empleados[$i]["id_puesto"] != null) {
                $P = $puestos["puesto"];
            } else {
                $P = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de inventario para ver cuantos activos salen asignados a este empleado
            $valor = $empleados[$i]["id_empleado"];
            $activos = ControladorInventario::ctrMostrarAFdeEmpleado($itemE, $valor);
            
            if($activos == 0){
                $AFsEmpleado = "<div class='btn-group'><button class='btn btn-github NoActivos' style='width: 50px;'><i></i>".$activos."</button></div>";
            } elseif($activos > 0 && $activos <= 5){
                $AFsEmpleado = "<div class='btn-group'><button class='btn btn-info NoActivos' style='width: 50px;'><i></i>".$activos."</button></div>";
            } elseif($activos > 5 && $activos <=10){
                $AFsEmpleado = "<div class='btn-group'><button class='btn bg-purple NoActivos' style='width: 50px;'><i></i>".$activos."</button></div>";
            } else{
                $AFsEmpleado = "<div class='btn-group'><button class='btn bg-maroon NoActivos' style='width: 50px;'><i></i>".$activos."</button></div>";
            }



            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $empleado . '",
                    "' . $P . '",
                    "' . $AFsEmpleado . '",
                    "' . $botones . '"
            ],';
        }

        $datosJson = substr($datosJson, 0, -1);
        $datosJson .=   '] 

        }';

        echo $datosJson;
    } 
}

/* ==================================================
                    OBJETOS DE LAS CLASES
    ===================================================*/

/* ==================================================
                    ACTIVAR LA TABLA DE EMPLEADOS
    ===================================================*/

$activarEmpleadosDevolucion = new tablaEmpleadosDevolucion();
$activarEmpleadosDevolucion->mostrarTablaEmpleadosDevolucion();
