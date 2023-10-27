<?php

class ControladorHistorialMovimientos{
    /* ==================================================
       MÉTODO PARA MOSTRAR EL HISTORIAL DE MOVIMIENTOS
    ===================================================*/

    static public function ctrMostrarMovimientos($item, $valor)
    {

        $tabla = "movimiento";

        $respuesta = ModeloHistorial::mdlMostrarMovimientos($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarHistorialEstado($item, $valor)
    {

        $tabla = "historial_estado";

        $respuesta = ModeloHistorial::mdlMostrarMovimientos($tabla, $item, $valor);

        return $respuesta;
    }


}