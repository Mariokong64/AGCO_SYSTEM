<?php

require_once "../controladores/inventario.controlador.php";
require_once "../controladores/uso-estatus-estado.controlador.php";
require_once "../controladores/categoria.controlador.php";
require_once "../controladores/marca.controlador.php";
require_once "../controladores/modelo.controlador.php";

require_once "../modelos/inventario.modelo.php";
require_once "../modelos/uso-estatus-estado.modelo.php";
require_once "../modelos/categoria.modelo.php";
require_once "../modelos/marca.modelo.php";
require_once "../modelos/modelo.modelo.php";

class tablaRenovaciones
{

    public $SumarAños;
    public $tipoRenovacion;
    public $añosMaximos;
    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    public function mostrarTablaRenovaciones()
    {
        $años = $this->SumarAños;
        $tipoRenovacion = $this->tipoRenovacion;
        $añosMaximos = $this->añosMaximos;
        $item = null;
        $valor = null;
        $itemTipo = "id_tipo";
        $itemMarca = "id_marca";
        $itemModelo = "id_modelo";
        $itemEstatus = "id_estatus";
        $fechaActual = date('Y-m-d');

        //Convertimos las variables a números enteros
        if($años != null && $años != ""){
            $años = intval($this->SumarAños);
        }

        if($añosMaximos != null && $añosMaximos != ""){
            $añosMaximos = intval($this->añosMaximos);
        }

        //Aquí sumamos a la fecha actual el valor de la variable $añosMaximos
        if ($añosMaximos != null && $añosMaximos != "") {
            $fechaMaxima = date('Y-m-d', strtotime('+' . $añosMaximos . 'years', strtotime($fechaActual)));
        } else {
            $fechaMaxima = null;
        }

        $AFs = ControladorInventario::ctrMostrarAF($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($AFs); $i++) {

            //Aquí verificamos si el tipo del activo es el deseado
            if ($tipoRenovacion != null && $tipoRenovacion != "") {
                if ($AFs[$i]["id_tipo"] != $tipoRenovacion) {
                    continue;
                }
            }

            //Aquí sumamos los años ingresados por el usuario a la fecha de compra del activo fijo
            $fechaCompra = $AFs[$i]["fecha_ingreso"];
            if ($fechaCompra != null && $fechaCompra != "0000-00-00") {
                $nuevaFechaRenovacion = strtotime('+' . $años . ' years', strtotime($fechaCompra));
                $AFrenovacion = date('Y-m-d', $nuevaFechaRenovacion);
            } else {
                $AFrenovacion = "NA";
            }

            //Aqui verificamos si el año de renovación entra dentro del rango que el usuario quiere incluir
            if ($fechaMaxima != null) {
                if (strtotime($AFrenovacion) > strtotime($fechaMaxima)) {
                    continue;
                }
            }


            //Aquí vamos a poner el estado del activo fijo en un botón coloreado dependiendo de su estado

            switch ($AFs[$i]["id_estado"]) {
                case 1:
                    $AFestado = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>ACTIVO</button></div>";
                    break;
                case 2:
                    $AFestado = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' idEstadoAF='" . $AFs[$i]["id_estado"] . "' style='width: 125px;'><i></i>INACTIVO</button></div>";
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

            //Aquí vamos a poner si el activo fijo está asignado o no en un botón coloreado dependiendo del resultado

            switch ($AFs[$i]["asignado"]) {
                case 0:
                    $AFasignado = "<div class='btn-group'><button class='btn bg-gray btnEstadoAF' style='width: 45px;'><i></i>NO</button></div>";
                    break;
                case 1:
                    $AFasignado = "<div class='btn-group'><button class='btn btn-success btnEstadoAF' style='width: 45px;'><i></i>SI</button></div>";
                    break;
                default:
                    $AFasignado = 'NA';
                    break;
            }

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

            //Obtenemos el estatus del activo fijo
            $valor = $AFs[$i]["id_estatus"];
            $estatus = ControladorUsoEstatusEstados::ctrMostrarEstatus($itemEstatus, $valor);

            if ($AFs[$i]["id_estatus"] != null) {
                $AFestatus = $estatus["estatus"];
            } else {
                $AFestatus = 'NA';
            }

            //Aquí ponemos todo en un JSON
            $datosJson .= '[
                    "' . $AFs[$i]["serie"] . '",
                    "' . $AFtipo . '",
                    "' . $AFmarca . '",
                    "' . $AFmodelo . '",
                    "' . $AFasignado . '",
                    "' . $AFestado . '",
                    "' . $AFestatus . '",
                    "' . $AFs[$i]["fecha_ingreso"] . '",
                    "' . $AFs[$i]["fecha_vencimiento"] . '",
                    "' . $AFrenovacion . '"
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

if (isset($_POST["añosSumar"])) {

    $activarRenovaciones = new tablaRenovaciones();
    $activarRenovaciones->SumarAños = $_POST["añosSumar"];
    $activarRenovaciones->tipoRenovacion = $_POST["tipoRenovacion"];
    $activarRenovaciones->añosMaximos = $_POST["añosMaximos"];
    $activarRenovaciones->mostrarTablaRenovaciones();
}
