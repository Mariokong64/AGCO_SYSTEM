<?php

require_once "../controladores/marca.controlador.php";
require_once "../modelos/marca.modelo.php";

class AjaxMarca
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE MARCAS
        ============================================*/

    public $validarMarca;

    public function ajaxValidarMarca()
    {

        $item = "marca";
        $valor = $this->validarMarca;

        $respuesta = ControladorMarcas::ctrMostrarMarcas($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR MARCAS
        ============================================*/

    public $idMarca;

    public function ajaxEditarMarca()
    {

        $item = "id_marca";
        $valor = $this->idMarca;

        $respuesta = ControladorMarcas::ctrMostrarMarcas($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LAS MARCAS
        ============================================*/

/* ===========================================
            REVISAR MARCAS REPETIDAS 
============================================*/

if (isset($_POST["validarMarca"])) {

    $valMarca = new AjaxMarca();
    $valMarca->validarMarca = $_POST["validarMarca"];
    $valMarca->ajaxValidarMarca();
}

/* ===========================================
              EDITAR MARCAS
============================================*/

if (isset($_POST["idMarca"])) {

    $marca = new AjaxMarca();
    $marca->idMarca = $_POST["idMarca"];
    $marca->ajaxEditarMarca();
}
