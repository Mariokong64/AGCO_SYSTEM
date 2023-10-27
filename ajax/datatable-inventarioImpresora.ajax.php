<?php

require_once "../controladores/inventarioImpresora.controlador.php";
require_once "../controladores/puesto.controlador.php";
require_once "../controladores/uso-estatus-estado.controlador.php";
require_once "../controladores/categoria.controlador.php";
require_once "../controladores/marca.controlador.php";
require_once "../controladores/modelo.controlador.php";
require_once "../controladores/departamento.controlador.php";
require_once "../controladores/ubicacion.controlador.php";

require_once "../modelos/inventarioImpresora.modelo.php";
require_once "../modelos/puesto.modelo.php";
require_once "../modelos/uso-estatus-estado.modelo.php";
require_once "../modelos/categoria.modelo.php";
require_once "../modelos/marca.modelo.php";
require_once "../modelos/modelo.modelo.php";
require_once "../modelos/departamento.modelo.php";
require_once "../modelos/ubicacion.modelo.php";

class tablaInventarioImpresora
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    public function mostrarTablaInventarioImpresora()
    {
        $item = null;
        $valor = null;
        $itemMarca = "id_marca";
        $itemEstatus = "id_estatus";
        $itemModelo = "id_modelo";
        $itemDepto = "id_departamento";
        $itemUbicacion = "id_ubicacion";

        $AFs = ControladorInventarioImpresora::ctrMostrarImpresora($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($AFs); $i++) {

            //Aquí se guardan los botones para consultar, editar y eliminar en una variable para mandarla al JSON
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' data-toggle='modal' data-target='#modalEditarImpresora' style='margin-left: 3px;'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-danger btnEliminarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' style='margin-left: 3px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>";

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
                    $botones = "<div class='btn-group'><button class='btn btn-github btnEditarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' data-toggle='modal' data-target='#modalEditarImpresora' style='margin-left: 3px;'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-github btnEliminarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' style='margin-left: 3px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>";
                    break;
                default:
                    $AFestado = 'NA';
                    break;
            }


            // AQUÍ SE HACEN LAS CONSULTAS DE LAS TABLAS FORÁNEAS PARA IGUALAR LOS VALORES DE LAS CLAVES FORÁNEAS DE CADA ACTIVO FIJO Y QUE SE MUESTRE EL VALOR DE CADA TABLA FORÁNEA Y NO EL VALOR DE SU ID

            // Aquí hacemos la consulta a la tabla de marcas para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas($itemMarca, $valor);

            if ($AFs[$i]["id_marca"] != null) {
                $AFmarca = $marcas["marca"];
            } else {
                $AFmarca = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de estatus para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_estatus"];
            $estatus = ControladorUsoEstatusEstados::ctrMostrarEstatus($itemEstatus, $valor);

            if ($AFs[$i]["id_estatus"] != null) {
                $AFestatus = $estatus["estatus"];
            } else {
                $AFestatus = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de modelos para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos($itemModelo, $valor);

            if ($AFs[$i]["id_modelo"] != null) {
                $AFmodelo = $modelos["modelo"];
            } else {
                $AFmodelo = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de departamentos para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($itemDepto, $valor);

            if ($AFs[$i]["id_departamento"] != null) {
                $AFdepto = $departamentos["departamento"];
            } else {
                $AFdepto = 'NA';
            }

            // Aquí hacemos la consulta a la tabla de ubicaciones para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($itemUbicacion, $valor);

            if ($AFs[$i]["id_ubicacion"] != null) {
                $AFubicacion = $ubicaciones["ubicacion"];
            } else {
                $AFubicacion = 'NA';
            }



            $datosJson .= '[   
                    "' . $AFs[$i]["serie"] . '",
                    "' . $AFmodelo . '",
                    "' . $AFmarca . '",
                    "' . $AFestado . '",
                    "' . $AFdepto . '",
                    "' . $AFubicacion . '",
                    "' . $AFestatus . '",
                    "' . $AFs[$i]["ip"] . '",
                    "' . $AFs[$i]["fecha_ingreso"] . '",
                    "' . $AFs[$i]["fecha_vencimiento"] . '",
                    "' . $AFs[$i]["detalles"] . '",
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

$activarInventarioImpresora = new tablaInventarioImpresora();
$activarInventarioImpresora->mostrarTablaInventarioImpresora();
