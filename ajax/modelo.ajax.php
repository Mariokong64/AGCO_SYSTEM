<?php

require_once "../controladores/modelo.controlador.php";
require_once "../modelos/modelo.modelo.php";

class AjaxModelo
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE MODELOS
        ============================================*/

    public $validarModelo;

    public function ajaxValidarModelo()
    {

        $item = "modelo";
        $valor = $this->validarModelo;

        $respuesta = ControladorModelos::ctrMostrarModelos($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR MODELOS
        ============================================*/

    public $idModelo;

    public function ajaxEditarModelo()
    {

        $item = "id_modelo";
        $valor = $this->idModelo;

        $respuesta = ControladorModelos::ctrMostrarModelos($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LOS MODELOS
        ============================================*/

/* ===========================================
            REVISAR MODELOS REPETIDOS 
============================================*/

if (isset($_POST["validarModelo"])) {

    $valModelo = new AjaxModelo();
    $valModelo->validarModelo = $_POST["validarModelo"];
    $valModelo->ajaxValidarModelo();
}

/* ===========================================
              EDITAR MODELOS
============================================*/

if (isset($_POST["idModelo"])) {

    $modelo = new AjaxModelo();
    $modelo->idModelo = $_POST["idModelo"];
    $modelo->ajaxEditarModelo();
}
