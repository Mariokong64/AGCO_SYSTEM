<?php

class ControladorUsoEstatusEstados
{

    /* ==================================================
            MÉTODO PARA MOSTRAR USOS
    ===================================================*/

    static public function ctrMostrarUsos($item, $valor)
    {

        $tabla = "uso";

        $respuesta = ModeloUsoEstatusEstados::mdlMostrarUsosEstatusEstados($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR ESTATUS
    ===================================================*/

    static public function ctrMostrarEstatus($item, $valor)
    {

        $tabla = "estatus";

        $respuesta = ModeloUsoEstatusEstados::mdlMostrarUsosEstatusEstados($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrMostrarEstados($item, $valor)
    {

        $tabla = "estado";

        $respuesta = ModeloUsoEstatusEstados::mdlMostrarUsosEstatusEstados($tabla, $item, $valor);

        return $respuesta;
    }
}
