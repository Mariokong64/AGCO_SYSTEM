<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";
require_once "../controladores/categoria.controlador.php";
require_once "../modelos/categoria.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/motivo.controlador.php";
require_once "../modelos/motivo.modelo.php";

class tablaHistorialMovimientos
{

    /* =======================================================================
            MÉTODO PARA MOSTRAR EL HISTORIAL DE ASIGNACIONES Y DEVOLUCIONES
    =========================================================================*/

    public function mostrarHistorialMovimientos()
    {
        $item = null;
        $valor = null;
        $itemI = "id_inventario";
        $itemU = "id_usuario";
        $itemE = "id_empleado";
        $itemT = "id_tipo";
        $itemM = "id_motivo";

        $movimientos = ControladorHistorialMovimientos::ctrMostrarMovimientos($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($movimientos); $i++) {

            //Aquí vamos a poner el tipo de movimiento que es dependiendo del id_tipo_movimiento que obtuvimos de la tabla de movimientos

            switch ($movimientos[$i]["id_tipo_movimiento"]) {
                case 1:
                    $tipoMovimiento = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 135px;'><i></i>ASIGNACIÓN</button></div>";
                    break;
                case 2:
                    $tipoMovimiento = "<div class='btn-group'><button class='btn btn-github btnEstadoAF' style='width: 135px;'><i></i>DEVOLUCIÓN</button></div>";
                    break;
                default:
                    $tipoMovimiento = 'NA';
                    break;
            }

            // Aquí hacemos la consulta a la tabla de inventario para sacar la serie y el tipo de activo fijo que se asignó o se dio de baja

            $valor = $movimientos[$i]["id_inventario"];
            $activo = ControladorInventario::ctrMostrarActivosHistorial($itemI, $valor);

            $serie = $activo["serie"];
            $tipo = $activo["id_tipo"];

            // Aquí hacemos la consulta a la tabla de categorias para sacar el nombre de la categoría del activo fijo que se asignó o se dio de baja
            $valor = $tipo;
            $categorias = ControladorCategorias::ctrMostrarCategorias($itemT, $valor);

            $categoria = $categorias["tipo"];

            // Aquí hacemos la consulta a la tabla de empleados para sacar el nombre del empleado que se le asignó o se le dio de baja el activo fijo
            $valor = $movimientos[$i]["id_empleado"];
            $empleado = ControladorEmpleados::ctrMostrarEmpleados($itemE, $valor);
            $nombre = $empleado["nombre"];
            $apellidoP = $empleado["apellido_paterno"];
            $apellidoM = $empleado["apellido_materno"];
            $nombre = $nombre . " " . $apellidoP . " " . $apellidoM;

            // Aquí hacemos la consulta a la tabla de usuarios para sacar el nombre del usuario que hizo el movimiento
            $valor = $movimientos[$i]["id_usuario"];
            $usuario = ControladorUsuarios::ctrMostrarUsuario($itemU, $valor);
            $user = $usuario["usuario"];

            // Aquí hacemos la consulta a la tabla de motivos para ver el motivo por el cual se hizo el movimiento
            $valor = $movimientos[$i]["id_motivo"];
            $motivos = ControladorMotivos::ctrMostrarMotivos($itemM, $valor);
            $motivo = $motivos["motivo"];

            //Aquí agrupamos todos los datos en el JSON para que salgan en la tabla

            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $tipoMovimiento . '",
                    "' . $serie . '",
                    "' . $categoria . '",
                    "' . $nombre . '",
                    "' . $user . '",
                    "' . $motivo . '",
                    "' . $movimientos[$i]["fecha"] . '"
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
                    ACTIVAR LA TABLA DEL HISTORIAL
    ===================================================*/

$activarTablaHistorialMovimientos = new tablaHistorialMovimientos();
$activarTablaHistorialMovimientos->mostrarHistorialMovimientos();
