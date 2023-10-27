<?php

require_once "../controladores/inventario.controlador.php";
require_once "../controladores/puesto.controlador.php";
require_once "../controladores/uso-estatus-estado.controlador.php";
require_once "../controladores/categoria.controlador.php";
require_once "../controladores/marca.controlador.php";
require_once "../controladores/modelo.controlador.php";
require_once "../controladores/departamento.controlador.php";
require_once "../controladores/empleado.controlador.php";
require_once "../controladores/ubicacion.controlador.php";

require_once "../modelos/inventario.modelo.php";
require_once "../modelos/puesto.modelo.php";
require_once "../modelos/uso-estatus-estado.modelo.php";
require_once "../modelos/categoria.modelo.php";
require_once "../modelos/marca.modelo.php";
require_once "../modelos/modelo.modelo.php";
require_once "../modelos/departamento.modelo.php";
require_once "../modelos/empleado.modelo.php";
require_once "../modelos/ubicacion.modelo.php";

class tablaInventario
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    public function mostrarTablaInventario()
    {
        $item = null;
        $valor = null;
        $itemUso = "id_uso";
        $itemTipo = "id_tipo";
        $itemMarca = "id_marca";
        $itemEstatus = "id_estatus";
        $itemModelo = "id_modelo";
        $itemDepto = "id_departamento";
        $itemUbicacion = "id_ubicacion";
        $itemEmpleado = "id_empleado";

        $AFs = ControladorInventario::ctrMostrarAF($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($AFs); $i++) {

            //Aquí se guardan los botones para consultar, editar y eliminar en una variable para mandarla al JSON
            $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' data-toggle='modal' data-target='#modalEditarAF' style='margin-left: 10px;'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-danger btnEliminarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' style='margin-left: 5px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>";

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
                    $botones = "<div class='btn-group'><button class='btn btn-github btnEditarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' data-toggle='modal' data-target='#modalEditarAF' style='margin-left: 10px;'><i class='fa fa-pencil'></i> Editar</button><button class='btn btn-github btnEliminarAF' idInventario='" . $AFs[$i]["id_inventario"] . "' style='margin-left: 5px;'><i class='fa fa-trash-o'></i> Eliminar</button></div>";
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

            //Aqui vamos a poner la descripción de la posición dependiendo del valor que tenga

            switch ($AFs[$i]["posicion"]) {
                case 0:
                    $AFposicion = "NA";
                    break;

                default:
                    $AFposicion = $AFs[$i]["posicion"];
                    break;
            }

            // AQUÍ SE HACEN LAS CONSULTAS DE LAS TABLAS FORÁNEAS PARA IGUALAR LOS VALORES DE LAS CLAVES FORÁNEAS DE CADA ACTIVO FIJO Y QUE SE MUESTRE EL VALOR DE CADA TABLA FORÁNEA Y NO EL VALOR DE SU ID

            // Aquí hacemos la consulta a la tabla de usos para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_uso"];
            $usos = ControladorUsoEstatusEstados::ctrMostrarUsos($itemUso, $valor);

            if ($AFs[$i]["id_uso"] != null) {
                $AFuso = $usos["uso"];
            } else {
                $AFuso = 'NA';
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

            // Aquí hacemos la consulta a la tabla de empleados para ver cual coincide con el de este activo fijo. Si el resultado es NULL (que no debería) se le da el valor "NA" para que no de error
            $valor = $AFs[$i]["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados($itemEmpleado, $valor);

            if ($AFs[$i]["id_empleado"] != null) {
                $AFnombre = $empleados["nombre"];
                $AFapellidoP = $empleados["apellido_paterno"];
                $AFapellidoM = $empleados["apellido_materno"];
                $empleado = $AFnombre . " " . $AFapellidoP . " " . $AFapellidoM;
            } else {
                $empleado = 'NA';
            }

            $datosJson .= '[
                    "' . $AFs[$i]["serie"] . '",
                    "' . $AFmodelo . '",
                    "' . $AFmarca . '",
                    "' . $AFtipo . '",
                    "' . $AFestado . '",
                    "' . $AFasignado . '",
                    "' . $AFdepto . '",
                    "' . $AFubicacion . '",
                    "' . $AFposicion . '",
                    "' . $empleado . '",
                    "' . $AFuso . '",
                    "' . $AFestatus . '",
                    "' . $AFs[$i]["factura"] . '",
                    "' . $AFs[$i]["host_name"] . '",
                    "' . $AFs[$i]["numero_tel"] . '",
                    "' . $AFs[$i]["imei"] . '",
                    "' . $AFs[$i]["email_cel"] . '",
                    "' . $AFs[$i]["contrato"] . '",
                    "' . $AFs[$i]["mac_tel"] . '",
                    "' . $AFs[$i]["ip"] . '",
                    "' . $AFs[$i]["fecha_ingreso"] . '",
                    "' . $AFs[$i]["fecha_vencimiento"] . '",
                    "' . $AFs[$i]["fecha_registro"] . '",
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

$activarInventario = new tablaInventario();
$activarInventario->mostrarTablaInventario();
