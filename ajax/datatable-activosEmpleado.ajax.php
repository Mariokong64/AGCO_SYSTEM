<?php

require_once "../controladores/inventario.controlador.php";
require_once "../controladores/puesto.controlador.php";
require_once "../controladores/categoria.controlador.php";
require_once "../controladores/marca.controlador.php";
require_once "../controladores/modelo.controlador.php";
require_once "../controladores/departamento.controlador.php";
require_once "../controladores/empleado.controlador.php";
require_once "../controladores/ubicacion.controlador.php";
require_once "../controladores/uso-estatus-estado.controlador.php";

require_once "../modelos/inventario.modelo.php";
require_once "../modelos/puesto.modelo.php";
require_once "../modelos/categoria.modelo.php";
require_once "../modelos/marca.modelo.php";
require_once "../modelos/modelo.modelo.php";
require_once "../modelos/departamento.modelo.php";
require_once "../modelos/empleado.modelo.php";
require_once "../modelos/ubicacion.modelo.php";
require_once "../modelos/uso-estatus-estado.modelo.php";

class tablaActivosEmpleado
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/


    public function mostrarTablaActivosEmpleado()
    {


     //Por alguna razón no me toma el valor de la variable "idEmpleado" que se para por la URL así que voy a tener que poner todo esto en el HTML"
        $valor = $_GET["idEmpleado"];
        $item = "id_empleado";
        $itemTipo = "id_tipo";
        $itemMarca = "id_marca";
        $itemModelo = "id_modelo";

        $AFs = ControladorInventario::ctrMostrarInventarioDeEmpleado($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($AFs); $i++) {

            //Aquí se guardan los botones para consultar, editar y eliminar en una variable para mandarla al JSON
            $botones = "<div class='btn-group'><a href='index.php?ruta=desasignar&idActivo=" . $AFs[$i]["id_inventario"] . "'><button class='btn btn-danger btnDesasignar' idActivo='" . $AFs[$i]["id_inventario"] . "'><i class='fa fa-book' style='margin-right:6px'></i>Desasignar</button></div></a>";
            //Aquí vamos a poner el estado del activo fijo en un botón coloreado dependiendo de su estado

            switch ($AFs[$i]["id_estado"]) {
                case 1:
                    $AFestado = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i> ACTIVO </button></div>";
                    break;
                case 2:
                    $AFestado = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>  INACTIVO  </button></div>";
                    break;
                case 3:
                    $AFestado = "<div class='btn-group'><button class='btn btn-warning btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>MANTENIMIENTO</button></div>";
                    break;
                case 4:
                    $AFestado = "<div class='btn-group'><button class='btn btn-info btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>DONACIÓN</button></div>";
                    break;
                case 5:
                    $AFestado = "<div class='btn-group'><button class='btn btn-github btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>SCRAP</button></div>";
                    break;
                default:
                    $AFestado = 'NA';
                    break;
            }

            // AQUÍ SE HACEN LAS CONSULTAS DE LAS TABLAS FORÁNEAS PARA IGUALAR LOS VALORES DE LAS CLAVES FORÁNEAS DE CADA ACTIVO FIJO Y QUE SE MUESTRE EL VALOR DE CADA TABLA FORÁNEA Y NO EL VALOR DE SU ID

            // Aquí hacemos la consulta a la tabla de tipos o categorías para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias($itemTipo, $valor);

            if ($AFs[$i]["id_tipo"] != null) {
                $AFtipo = $tipos["tipo"];
            } else {
                $AFtipo = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de marcas para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas($itemMarca, $valor);

            if ($AFs[$i]["id_marca"] != null) {
                $AFmarca = $marcas["marca"];
            } else {
                $AFmarca = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de modelos para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos($itemModelo, $valor);

            if ($AFs[$i]["id_modelo"] != null) {
                $AFmodelo = $modelos["modelo"];
            } else {
                $AFmodelo = 'NA';
            }



            $datosJson .= '[
                    "' . ($i + 1) . '",    
                    "' . $AFs[$i]["serie"] . '",
                    "' . $AFtipo . '",
                    "' . $AFmarca . '",
                    "' . $AFmodelo . '",
                    "' . $AFestado . '",
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
             ACTIVAR LA TABLA DE ACTIVOS FIJOS
    ===================================================*/


$activarActivosAsignados = new tablaActivosEmpleado();
$activarActivosAsignados->mostrarTablaActivosEmpleado();