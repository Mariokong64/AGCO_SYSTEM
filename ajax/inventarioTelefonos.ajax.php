<?php

require_once "../controladores/inventarioTelefonos.controlador.php";
require_once "../modelos/inventarioTelefonos.modelo.php";

class AjaxInventarioTelefonos
{

    /* ==================================================
            MÉTODO PARA EDITAR LOS TELEFONOS
    ===================================================*/

    public $idInventario;

    public function ajaxEditarTelefonos()
    {

        $item = "serie";
        $valor = $this->idInventario;

        $respuesta = ControladorInventarioTelefonos::ctrMostrarTelefonos($item, $valor);

        echo json_encode($respuesta);
    }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ==================================================
            OBJETO PARA EDITAR LOS TELEFONOS
    ===================================================*/

if (isset($_POST["idInventario"])) {

    $editarTelefonos = new AjaxInventarioTelefonos();
    $editarTelefonos->idInventario = $_POST["idInventario"];
    $editarTelefonos->ajaxEditarTelefonos();
}
