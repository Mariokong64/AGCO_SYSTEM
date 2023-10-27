<?php

require_once "../controladores/categoria.controlador.php";
require_once "../modelos/categoria.modelo.php";

class AjaxCategoria
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE CATEGORIAS
        ============================================*/

    public $validarCategoria;

    public function ajaxValidarCategoria()
    {

        $item = "tipo";
        $valor = $this->validarCategoria;

        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR CATEGORIAS
        ============================================*/

    public $idCategoria;

    public function ajaxEditarCategoria()
    {

        $item = "id_tipo";
        $valor = $this->idCategoria;

        $respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LAS CATEGORIAS
        ============================================*/

/* ===========================================
            REVISAR CATEGORIAS REPETIDAS 
============================================*/

if (isset($_POST["validarCategoria"])) {

    $valCategoria = new AjaxCategoria();
    $valCategoria->validarCategoria = $_POST["validarCategoria"];
    $valCategoria->ajaxValidarCategoria();
}

/* ===========================================
              EDITAR CATEGORIAS 
============================================*/

if (isset($_POST["idCategoria"])) {

    $categoria = new AjaxCategoria();
    $categoria->idCategoria = $_POST["idCategoria"];
    $categoria->ajaxEditarCategoria();
}
