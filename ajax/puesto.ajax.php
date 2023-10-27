<?php

require_once "../controladores/puesto.controlador.php";
require_once "../modelos/puesto.modelo.php";

class AjaxPuesto
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE PUESTOS
        ============================================*/

    public $validarPuesto;

    public function ajaxValidarPuesto()
    {

        $item = "puesto";
        $valor = $this->validarPuesto;

        $respuesta = ControladorPuestos::ctrMostrarPuestos($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR PUESTO
        ============================================*/

    public $idPuesto;

    public function ajaxEditarPuesto()
    {

        $item = "id_puesto";
        $valor = $this->idPuesto;

        $respuesta = ControladorPuestos::ctrMostrarPuestos($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LOS PUESTOS
        ============================================*/

/* ===========================================
            REVISAR PUESTOS REPETIDOS 
============================================*/

if (isset($_POST["validarPuesto"])) {

    $valPuesto = new AjaxPuesto();
    $valPuesto->validarPuesto = $_POST["validarPuesto"];
    $valPuesto->ajaxValidarPuesto();
}

/* ===========================================
              EDITAR MARCAS
============================================*/

if (isset($_POST["idPuesto"])) {

    $puesto = new AjaxPuesto();
    $puesto->idPuesto = $_POST["idPuesto"];
    $puesto->ajaxEditarPuesto();
}
