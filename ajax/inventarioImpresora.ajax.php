<?php

require_once "../controladores/inventarioImpresora.controlador.php";
require_once "../modelos/inventarioImpresora.modelo.php";

class AjaxInventarioImpresora
{

    /* ===========================================
        FUNCIÓN PARA VALIDAR NÚMEROS DE SERIE
    ============================================*/

    public $validarSerie;

    public function ajaxValidarSerie()
    {

        $item = "serie";
        $valor = $this->validarSerie;

        $respuesta = ControladorInventarioImpresora::ctrMostrarImpresora($item, $valor);

        echo json_encode($respuesta);
    }

    /* ==================================================
            MÉTODO PARA EDITAR LOS ACTIVOS
    ===================================================*/

    public $idInventario;

    public function ajaxEditarImpresora()
    {

        $item = "serie";
        $valor = $this->idInventario;

        $respuesta = ControladorInventarioImpresora::ctrMostrarImpresora($item, $valor);

        echo json_encode($respuesta);
    }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ==================================================
            OBJETO PARA EDITAR LOS ACTIVOS
    ===================================================*/

if (isset($_POST["idInventario"])) {

    $editarImpresora = new AjaxInventarioImpresora();
    $editarImpresora->idInventario = $_POST["idInventario"];
    $editarImpresora->ajaxEditarImpresora();
}
