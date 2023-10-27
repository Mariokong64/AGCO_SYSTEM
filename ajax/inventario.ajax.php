<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario
{

    /* ===========================================
        FUNCIÓN PARA VALIDAR NÚMEROS DE SERIE
    ============================================*/

    public $validarSerie;

    public function ajaxValidarSerie()
    {

        $item = "serie";
        $valor = $this->validarSerie;

        $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

        echo json_encode($respuesta);
    }

    /* ==================================================
            MÉTODO PARA EDITAR LOS ACTIVOS
    ===================================================*/

    public $idInventario;
    public $traerActivos;

    public function ajaxEditarAF()
    {
        if ($this->traerActivos == "ok") {

            $item = null;
            $valor = null;

            $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

            echo json_encode($respuesta);
        } else {

            $item = "serie";
            $valor = $this->idInventario;

            $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

            echo json_encode($respuesta);
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR LOS ACTIVOS
    ===================================================*/

    public function ajaxEditarAFparaAsignar()
    {
        if ($this->traerActivos == "ok") {

            $item = null;
            $valor = null;

            $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

            echo json_encode($respuesta);
        } else {

            $item = "id_inventario";
            $valor = $this->idInventario;

            $respuesta = ControladorInventario::ctrMostrarAF($item, $valor);

            echo json_encode($respuesta);
        }
    }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ===========================================
        REVISAR NÚMEROS DE SERIE REPETIDOS 
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

    $editarAF = new AjaxInventario();
    $editarAF->idInventario = $_POST["idInventario"];
    $editarAF->ajaxEditarAF();
}

/* =================================================================================================
            OBJETO PARA EDITAR LOS ACTIVOS QUE SE VAN A ASIGNAR DESDE LA VENTANA DE ASIGNACIONES
    ===============================================================================================*/

    if (isset($_POST["idInventarioAsignar"])) {

        $editarAF = new AjaxInventario();
        $editarAF->idInventario = $_POST["idInventarioAsignar"];
        $editarAF->ajaxEditarAFparaAsignar();
    }

/* ==================================================
    OBJETO PARA MOSTRAR LOS PRODUCTOS DESDE UN MÓVIL
===================================================*/

if (isset($_POST["traerActivos"])) {

    $traerAF = new AjaxInventario();
    $traerAF->traerActivos = $_POST["traerActivos"];
    $traerAF->ajaxEditarAF();
}
