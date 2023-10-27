<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";

class AjaxEmpleados
{

    /* ==================================================
            MÉTODO PARA EDITAR LOS EMPLEADOS
    ===================================================*/

    public $idEmpleado;

    public function ajaxEditarEmpleado()
    {

        $item = "id_empleado";
        $valor = $this->idEmpleado;

        $respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

        echo json_encode($respuesta);
    }

        /* ===========================================
           FUNCIÓN PARA VALIDAR NÚMEROS DE NÓMINA
        ============================================*/

        public $validarNomina;

        public function ajaxValidarNomina()
        {
    
            $item = "nomina";
            $valor = $this->validarNomina;
    
            $respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
    
            echo json_encode($respuesta);
        }
}

/* ==================================================
                         OBJETOS
    ===================================================*/

/* ==================================================
            OBJETO PARA EDITAR LOS EMPLEADOS
    ===================================================*/

if (isset($_POST['idEmpleado'])) {

    $editarEmpleado = new AjaxEmpleados();
    $editarEmpleado->idEmpleado = $_POST['idEmpleado'];
    $editarEmpleado->ajaxEditarEmpleado();
}

/* ===========================================
     REVISAR NÚMEROS DE NÓMINA REPETIDOS
============================================*/

if (isset($_POST["validarNomina"])) {

    $valNomina = new AjaxEmpleados();
    $valNomina-> validarNomina = $_POST["validarNomina"];
    $valNomina->ajaxValidarNomina();
}
