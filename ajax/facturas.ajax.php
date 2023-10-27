<?php

require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";

class AjaxFacturas
{

    /* ===========================================
           FUNCIÓN PARA EDITAR UBICACIONES
        ============================================*/

    public $idFactura;

    public function ajaxEditarFactura()
    {

        $item = "id_factura";
        $valor = $this->idFactura;

        $respuesta = ControladorFacturas::ctrMostrarFacturas($item, $valor);

        echo json_encode($respuesta);
    }
}

/* ===========================================
        OBJETO PARA EDITAR FACTURAS
============================================*/

if (isset($_POST["idFactura"])) {

    $editarFactura = new AjaxFacturas();
    $editarFactura->idFactura = $_POST["idFactura"];
    $editarFactura->ajaxEditarFactura();
}
