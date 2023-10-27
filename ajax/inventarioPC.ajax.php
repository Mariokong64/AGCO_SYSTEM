<?php

require_once "../controladores/inventarioPC.controlador.php";
require_once "../modelos/inventarioPC.modelo.php";

class AjaxInventarioPC
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

    public function ajaxEditarPC()
    {

        $item = "serie";
        $valor = $this->idInventario;

        $respuesta = ControladorInventarioPC::ctrMostrarPC($item, $valor);

        echo json_encode($respuesta);
    }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ===========================================
    OBJETO PARA REVISAR NÚMEROS DE SERIE REPETIDOS 
============================================*/

if (isset($_POST["validarSerie"])) {

    $valSerie = new AjaxInventario();
    $valSerie->validarSerie = $_POST["validarSerie"];
    $valSerie->ajaxValidarSerie();
}

/* ==================================================
            OBJETO PARA EDITAR LOS ACTIVOS
    ===================================================*/

if (isset($_POST["idInventario"])) {

    $editarPC = new AjaxInventarioPC();
    $editarPC->idInventario = $_POST["idInventario"];
    $editarPC->ajaxEditarPC();
}
