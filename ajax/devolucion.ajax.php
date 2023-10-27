<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxDevolucion
{

    /* ==================================================
            MÉTODO PARA DESASIGNAR LOS ACTIVOS
    ===================================================*/

    public $idActivo;

    public function ajaxDesasignarActivo()
    {

        $item = "id_inventario";
        $valor = $this->idActivo;

        $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

        echo json_encode($respuesta);
    }

}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ==================================================
            OBJETO PARA DESASIGNAR LOS ACTIVOS
    ===================================================*/

if (isset($_POST['idActivo'])) {

    $devolverActivo = new AjaxDevolucion();
    $devolverActivo->idActivo = $_POST['idActivo'];
    $devolverActivo->ajaxDesasignarActivo();
}


