<?php

require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";

class AjaxDepartamento
{
    /* ===========================================
           FUNCIÓN PARA VALIDAR NOMBRES DE DEPARTAMENTOS
        ============================================*/

    public $validarDepartamento;

    public function ajaxValidarDepartamento()
    {

        $item = "departamento";
        $valor = $this->validarDepartamento;

        $respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

        echo json_encode($respuesta);
    }

    /* ===========================================
           FUNCIÓN PARA EDITAR DEPARTAMENTOS
        ============================================*/

    public $idDepartamento;

    public function ajaxEditarDepartamento()
    {

        $item = "id_departamento";
        $valor = $this->idDepartamento;

        $respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

        echo json_encode($respuesta);
    }
}


/* ===========================================
           OBJETOS DE LOS DEPARTAMENTOS
        ============================================*/

/* ===========================================
            REVISAR DEPARTAMENTOS REPETIDOS 
============================================*/

if (isset($_POST["validarDepartamento"])) {

    $valDepartamento = new AjaxDepartamento();
    $valDepartamento->validarDepartamento = $_POST["validarDepartamento"];
    $valDepartamento->ajaxValidarDepartamento();
}

/* ===========================================
              EDITAR DEPARTAMENTOS
============================================*/

if (isset($_POST["idDepartamento"])) {

    $editar = new AjaxDepartamento();
    $editar->idDepartamento = $_POST["idDepartamento"];
    $editar->ajaxEditarDepartamento();
}
