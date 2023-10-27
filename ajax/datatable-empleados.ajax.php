<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";
require_once "../controladores/puesto.controlador.php";
require_once "../modelos/puesto.modelo.php";
require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class tablaEmpleados
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS EMPLEADOS
    ===================================================*/


    public function mostrarTablaEmpleados()
    {
        $item = null;
        $valor = null;
        $itemP = "id_puesto";
        $itemD = "id_departamento";
        $itemE = "id_empleado";
 
        $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($empleados); $i++) {

            if($empleados[$i]["id_empleado"] <3 ){
                continue;
            }

            $botones = "<div class='btn-group'><a href='index.php?ruta=devolucionActivo&idEmpleado=" . $empleados[$i]["id_empleado"] . "'><button class='btn btn-primary btnConsultarEmpleado' style='margin-left: 5px;'><i class='fa fa-pencil'></i> Consultar</button></a><button class='btn btn-warning btnEditarEmpleado' idEmpleado='" . $empleados[$i]["id_empleado"] . "' data-toggle='modal' data-target='#modalEditarEmpleado'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-danger btnEliminarEmpleado' idEmpleado='" . $empleados[$i]["id_empleado"] . "' style='margin-left: 5px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>";

            // Aquí hacemos la consulta a la tabla de puestos para ver cual coincide con el puesto de cada empleado que obtuvimos de la tabla de empleados. Si el resultado viene vacío lo igualamos a otro valor para que no nos de error.
            $valor = $empleados[$i]["id_puesto"];
            $puestos = ControladorPuestos::ctrMostrarPuestos($itemP, $valor);

            if ($empleados[$i]["id_puesto"] != null) {
                $P = $puestos["puesto"];
            } else {
                $P = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de departamentos para ver cual coincide con el departamento de cada empleado que obtuvimos de la tabla de empleados. Aqui también igualamos el resultado vecío para que no nos de error.
            $valor = $empleados[$i]["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemD, $valor);

            if ($empleados[$i]["id_departamento"] != null) {
                $D = $departamentos["departamento"];
            } else {
                $D = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de inventario para ver cuantos activos salen asignados a este empleado
            $valor = $empleados[$i]["id_empleado"];
            $activos = ControladorInventario::ctrMostrarAFdeEmpleado($itemE, $valor);

            $datosJson .= '[
                    "' . $empleados[$i]["nombre"] . '",
                    "' . $empleados[$i]["apellido_paterno"] . '",
                    "' . $empleados[$i]["apellido_materno"] . '",
                    "' . $P . '",
                    "' . $D . '",
                    "' . $empleados[$i]["email"] . '",
                    "' . $empleados[$i]["nomina"] . '",
                    "' . $activos . '",
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

$activarEmpleados = new tablaEmpleados();
$activarEmpleados->mostrarTablaEmpleados();
