<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";
require_once "../controladores/categoria.controlador.php";
require_once "../modelos/categoria.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class tablaHistorialEstado
{

    /* =======================================================================
            MÉTODO PARA MOSTRAR EL HISTORIAL DE ASIGNACIONES Y DEVOLUCIONES
    =========================================================================*/

    public function mostrarHistorialEstado()
    {
        $item = null;
        $valor = null;
        $itemI = "id_inventario";
        $itemU = "id_usuario";
        $itemT = "id_tipo";

        $movimientos = ControladorHistorialMovimientos::ctrMostrarHistorialEstado($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($movimientos); $i++) {

            // Aquí hacemos la consulta a la tabla de inventario para sacar la serie y el tipo de activo fijo que se asignó o se dio de baja

            $valor = $movimientos[$i]["id_inventario"];
            $activo = ControladorInventario::ctrMostrarActivosHistorial($itemI, $valor);

            $serie = $activo["serie"];
            $tipo = $activo["id_tipo"];

            //Aquí vamos a poner el estado del activo fijo en un botón coloreado dependiendo de su estado anterior y actual

            switch ($movimientos[$i]["id_estado_anterior"]) {
                case 1:
                    $estadoAnterior = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 125px;'><i></i> ACTIVO </button></div>";
                    break;
                case 2:
                    $estadoAnterior = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' style='width: 125px;'><i></i>  INACTIVO  </button></div>";
                    break;
                case 3:
                    $estadoAnterior = "<div class='btn-group'><button class='btn btn-warning btnEstadoAF' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";
                    break;
                case 4:
                    $estadoAnterior = "<div class='btn-group'><button class='btn btn-info btnEstadoAF' style='width: 125px;'><i></i>DONACIÓN</button></div>";
                    break;
                case 5:
                    $estadoAnterior = "<div class='btn-group'><button class='btn btn-github btnEstadoAF' style='width: 125px;'><i></i>SCRAP</button></div>";
                    break;
                default:
                    $estadoAnterior = 'NA';
                    break;
            }

            switch ($movimientos[$i]["id_estado_posterior"]) {
                case 1:
                    $estadoPosterior = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 125px;'><i></i> ACTIVO </button></div>";
                    break;
                case 2:
                    $estadoPosterior = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' style='width: 125px;'><i></i>  INACTIVO  </button></div>";
                    break;
                case 3:
                    $estadoPosterior = "<div class='btn-group'><button class='btn btn-warning btnEstadoAF' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";
                    break;
                case 4:
                    $estadoPosterior = "<div class='btn-group'><button class='btn btn-info btnEstadoAF' style='width: 125px;'><i></i>DONACIÓN</button></div>";
                    break;
                case 5:
                    $estadoPosterior = "<div class='btn-group'><button class='btn btn-github btnEstadoAF' style='width: 125px;'><i></i>SCRAP</button></div>";
                    break;
                default:
                    $estadoPosterior = 'NA';
                    break;
            }

            // Aquí hacemos la consulta a la tabla de categorias para sacar el nombre de la categoría del activo fijo que se asignó o se dio de baja

            $valor = $tipo;
            $categorias = ControladorCategorias::ctrMostrarCategorias($itemT, $valor);

            $categoria = $categorias["tipo"];

            // Aquí hacemos la consulta a la tabla de usuarios para sacar el nombre del usuario que hizo el movimiento
            $valor = $movimientos[$i]["id_usuario"];
            $usuario = ControladorUsuarios::ctrMostrarUsuario($itemU, $valor);

            $user = $usuario["usuario"];

            //Aquí agrupamos todos los datos en el JSON para que salgan en la tabla

            $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $serie . '",
                    "' . $categoria . '",
                    "' . $estadoAnterior . '",
                    "' . $estadoPosterior . '",
                    "' . $user . '",
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

$activarTablaHistorialEstatus = new tablaHistorialEstado();
$activarTablaHistorialEstatus->mostrarHistorialEstado();
