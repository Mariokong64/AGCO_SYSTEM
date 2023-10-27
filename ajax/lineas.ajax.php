<?php

require_once "../controladores/lineas.controlador.php";
require_once "../modelos/lineas.modelo.php";

class AjaxLineas
{

    /* ===========================================================
        FUNCIÓN PARA VALIDAR LOS NÚMEROS DE LÍNEAS TELEFÓNICAS
    =============================================================*/

    public $validarLinea;

    public function ajaxValidarLinea()
    {

        $item = "linea";
        $valor = $this->validarLinea;

        $respuesta = ControladorLineas::ctrMostrarLineas($item, $valor);

        echo json_encode($respuesta);
    }

    /* ==================================================
            MÉTODO PARA EDITAR LOS ACTIVOS
    ===================================================*/

    public $idLinea;

    public function ajaxMostrarLinea()
    {

        $item = "linea";
        $valor = $this->idLinea;

        $respuesta = ControladorLineas::ctrMostrarLineasEditar($item, $valor);

        echo json_encode($respuesta);
    }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ===========================================
        REVISAR NÚMEROS DE SERIE REPETIDOS 
============================================*/

if (isset($_POST["validarLinea"])) {

    $valLinea = new AjaxLineas();
    $valLinea->validarLinea = $_POST["validarLinea"];
    $valLinea->ajaxValidarLinea();
}

/* ==================================================
            OBJETO PARA EDITAR LOS ACTIVOS
    ===================================================*/

if (isset($_POST["idLinea"])) {

    $editarLinea = new AjaxLineas();
    $editarLinea->idLinea = $_POST["idLinea"];
    $editarLinea->ajaxMostrarLinea();
}
