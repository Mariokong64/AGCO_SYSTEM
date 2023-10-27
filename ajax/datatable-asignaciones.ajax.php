<?php

require_once "../controladores/inventario.controlador.php";
require_once "../controladores/categoria.controlador.php";
require_once "../controladores/marca.controlador.php";
require_once "../controladores/modelo.controlador.php";

require_once "../modelos/inventario.modelo.php";
require_once "../modelos/categoria.modelo.php";
require_once "../modelos/marca.modelo.php";
require_once "../modelos/modelo.modelo.php";

class tablaInventarioAsignaciones
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    public function mostrarTablaInventarioAsignaciones()
    {
        $item = null;
        $valor = 0;
        $itemTipo = "id_tipo";
        $itemMarca = "id_marca";
        $itemModelo = "id_modelo";

        $AFs = ControladorInventario::ctrMostrarNoAsignado($item, $valor);

        $datosJson = '{
            "data": [';

        for ($i = 0; $i < count($AFs); $i++) {

            //Aquí se guardan los botones para consultar, editar y eliminar en una variable para mandarla al JSON
            $botones = "<div class='btn-group'><button class='btn btn-primary agregarActivo recuperarBoton' idAF='" . $AFs[$i]["id_inventario"] . "'>Agregar</button></div>";



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
                    "' . $AFs[$i]["serie"] . '",
                    "' . $AFtipo . '",
                    "' . $AFmarca . '",
                    "' . $AFmodelo . '",
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

$activarInventarioAsignaciones = new tablaInventarioAsignaciones();
$activarInventarioAsignaciones->mostrarTablaInventarioAsignaciones();
