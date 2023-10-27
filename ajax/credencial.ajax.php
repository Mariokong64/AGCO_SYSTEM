<?php

require_once "../controladores/credenciales.controlador.php";
require_once "../modelos/credenciales.modelo.php";

class AjaxCredencial
{

    /* ===========================================
           FUNCIÓN PARA EDITAR CREDENCIALES
        ============================================*/

    public $idCredencial;

    public function ajaxEditarCredencial()
    {

        $item = "id_credencial";
        $valor = $this->idCredencial;

        $respuesta = ControladorCredenciales::ctrMostrarCredenciales($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LAS CATEGORIAS
        ============================================*/

/* ===========================================
              EDITAR CREDENCIALES
============================================*/

if (isset($_POST["idCredencial"])) {

    $credencial = new AjaxCredencial();
    $credencial->idCredencial = $_POST["idCredencial"];
    $credencial->ajaxEditarCredencial();
}
