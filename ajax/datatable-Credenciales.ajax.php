<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";
require_once "../controladores/puesto.controlador.php";
require_once "../modelos/puesto.modelo.php";
require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";

class tablaEmpleadosCredencial
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS EMPLEADOS
    ===================================================*/

    public function mostrarTablaEmpleadosCredencial()
    {
        $item = null;
        $valor = null;
        $itemP = "id_puesto";
        $itemD = "id_departamento";

        $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($empleados); $i++) {

            $valor = $empleados[$i]["id_empleado"];

            $botones = "<div class='btn-group'><a href='index.php?ruta=credencialesEmpleado&idEmpleado=" . $valor . "'><button class='btn btn-foursquare btnConsultarCredencial'><i class='fa fa-address-card' style='margin-right:6px'></i> Consultar Credenciales</button></a></div>";

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

            // Aquí hacemos la consulta a la tabla de departamentos para ver cual coincide con el departamento de cada empleado que obtuvimos de la tabla de empleados. Aqui también igualamos el resultado vecío para que no nos de error.
            $valor = $empleados[$i]["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemD, $valor);

            if ($empleados[$i]["id_departamento"] != null) {
                $D = $departamentos["departamento"];
            } else {
                $D = 'NA';
            }


            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $empleado . '",
                    "' . $P . '",
                    "' . $D . '",
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

$activarCredenciales = new tablaEmpleadosCredencial();
$activarCredenciales->mostrarTablaEmpleadosCredencial();
