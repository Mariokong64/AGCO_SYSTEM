<?php

class ControladorMotivos
{

    /* ==================================================
            MÉTODO PARA MOSTRAR MODELOS
    ===================================================*/

    static public function ctrMostrarMotivos($item, $valor)
    {

        $tabla = "motivo";

        $respuesta = ModeloMotivo::mdlMostrarMotivos($tabla, $item, $valor);

        return $respuesta;
    }

}
