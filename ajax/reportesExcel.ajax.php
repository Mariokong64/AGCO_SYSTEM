<?php

/* ---------------------------------------------------------------------------------------
EN ESTE ARCHIVO ES EN DONDE SE GENERAN TODOS LOS REPORTES DE EXCEL
--------------------------------------------------------------------------------------- */

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/inventarioTelefonos.controlador.php";
require_once "../modelos/inventarioTelefonos.modelo.php";
require_once "../controladores/inventarioImpresora.controlador.php";
require_once "../modelos/inventarioImpresora.modelo.php";
require_once "../controladores/inventarioPC.controlador.php";
require_once "../modelos/inventarioPC.modelo.php";
require_once "../controladores/categoria.controlador.php";
require_once "../modelos/categoria.modelo.php";
require_once "../controladores/marca.controlador.php";
require_once "../modelos/marca.modelo.php";
require_once "../controladores/modelo.controlador.php";
require_once "../modelos/modelo.modelo.php";
require_once "../controladores/uso-estatus-estado.controlador.php";
require_once "../modelos/uso-estatus-estado.modelo.php";
require_once "../controladores/departamento.controlador.php";
require_once "../modelos/departamento.modelo.php";
require_once "../controladores/ubicacion.controlador.php";
require_once "../modelos/ubicacion.modelo.php";
require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";
require_once "../controladores/puesto.controlador.php";
require_once "../modelos/puesto.modelo.php";
require_once "../controladores/historial.controlador.php";
require_once "../modelos/historial.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

/* ======================================================================
   GENERACIÓN DE OBJETOS DE LAS CLASES DEPENDIENDO DEL TIPO DE REPORTE
========================================================================*/

if (isset($_POST["tipoReporte"])) {

    $reporte = new reportesExcel();
    $tipoReporte = $_POST["tipoReporte"];

    switch ($tipoReporte) {

        case "inventarioRapido":
            $reporte->AFseries = $_POST["series"];
            $reporte->ctrDescargarReporteRapido();
            break;
    }
}

/* ---------------------------------------------------------------------------------------------------
    CLASE CON LOS MÉTODOS QUE GENERAN LOS REPORTES DE EXCEL DE LOS DIFERENTES TIPOS DE INVENTARIO
--------------------------------------------------------------------------------------------------- */

class reportesExcel
{

    public $AFseries;

    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DEL INVENTARIO GENERAL
    -------------------------------------------------------------------------------*/

    public function ctrDescargarReporteRapido()
    {
        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $data = array();
    
        for ($i = 0; $i < count($series); $i++) {
            $valor = $series[$i];
            $AFs = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);
    
            $marca = "Sin marca";
            $modelo = "Sin modelo";
            $tipo = "";
            $estado = "";
            $departamento = "";
            $ubicacion = "";
            $empleado = "";
            $nomina = "";
            $asignado = "NO";
    
            // Obtenemos los valores de cada propiedad solo si existen
            if ($AFs) {
                $marca = isset($AFs["id_marca"]) ? ControladorMarcas::ctrMostrarMarcas("id_marca", $AFs["id_marca"])["marca"] : "Sin marca";
                $modelo = isset($AFs["id_modelo"]) ? ControladorModelos::ctrMostrarModelos("id_modelo", $AFs["id_modelo"])["modelo"] : "Sin modelo";
                $tipo = isset($AFs["id_tipo"]) ? ControladorCategorias::ctrMostrarCategorias("id_tipo", $AFs["id_tipo"])["tipo"] : "";
                $estado = isset($AFs["id_estado"]) ? ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $AFs["id_estado"])["estado"] : "";
                $departamento = isset($AFs["id_departamento"]) ? ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $AFs["id_departamento"])["departamento"] : "";
                $ubicacion = isset($AFs["id_ubicacion"]) ? ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $AFs["id_ubicacion"])["ubicacion"] : "";
                $empleado = isset($AFs["id_empleado"]) ? ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $AFs["id_empleado"])["nombre"] . " " . ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $AFs["id_empleado"])["apellido_paterno"] . " " . ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $AFs["id_empleado"])["apellido_materno"] : "";
                $nomina = isset($AFs["id_empleado"]) ? ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $AFs["id_empleado"])["nomina"] : "";
                $asignado = $AFs["asignado"] == 1 ? "SI" : "NO";
            }
    
            // Agregamos los valores al array de datos
            $data[] = array(
                "serie" => $AFs["serie"],
                "tipo" => $tipo,
                "marca" => $marca,
                "modelo" => $modelo,
                "estado" => $estado,
                "departamento" => $departamento,
                "ubicacion" => $ubicacion,
                "empleado" => $empleado,
                "nomina" => $nomina,
                "asignado" => $asignado,
                "detalles" => $AFs["detalles"]
            );
        }
    
        // Codificamos el array de datos como JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
