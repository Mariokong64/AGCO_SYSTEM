<?php

require_once "../controladores/ubicacion.controlador.php";
require_once "../modelos/ubicacion.modelo.php";

class AjaxUbicacion
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE UBICACIONES
        ============================================*/

    public $validarUbicacion;

    public function ajaxValidarUbicacion()
    {

        $item = "ubicacion";
        $valor = $this->validarUbicacion;

        $respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR UBICACIONES
        ============================================*/

    public $idUbicacion;

    public function ajaxEditarUbicacion()
    {

        $item = "id_ubicacion";
        $valor = $this->idUbicacion;

        $respuesta = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LAS UBICACIONES
        ============================================*/

/* ===========================================
            REVISAR UBICACIONES REPETIDAS 
============================================*/

if (isset($_POST["validarUbicacion"])) {

    $valUbicacion = new AjaxUbicacion();
    $valUbicacion->validarUbicacion = $_POST["validarUbicacion"];
    $valUbicacion->ajaxValidarUbicacion();
}

/* ===========================================
              EDITAR UBICACIONES
============================================*/

if (isset($_POST["idUbicacion"])) {

    $ubicacion = new AjaxUbicacion();
    $ubicacion->idUbicacion = $_POST["idUbicacion"];
    $ubicacion->ajaxEditarUbicacion();
}
