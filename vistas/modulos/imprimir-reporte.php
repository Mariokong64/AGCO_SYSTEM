<?php

/* ---------------------------------------------------------------------------------------
EN ESTE ARCHIVO ES EN DONDE SE LLAMAN LOS MÉTODOS DE LA CLASE DE "ControladorReportes" LA 
CUAL ESTÁ EN: controladores/reportes-excel.controlador.php y dependiendo del tipo de reporte
que venga en la variable GET "reporte" de la URL, será el método que va a ejecutar.
--------------------------------------------------------------------------------------- */

require_once "../../controladores/reportes-excel.controlador.php";
require_once "../../controladores/inventario.controlador.php";
require_once "../../modelos/inventario.modelo.php";
require_once "../../controladores/inventarioTelefonos.controlador.php";
require_once "../../modelos/inventarioTelefonos.modelo.php";
require_once "../../controladores/inventarioImpresora.controlador.php";
require_once "../../modelos/inventarioImpresora.modelo.php";
require_once "../../controladores/inventarioPC.controlador.php";
require_once "../../modelos/inventarioPC.modelo.php";
require_once "../../controladores/categoria.controlador.php";
require_once "../../modelos/categoria.modelo.php";
require_once "../../controladores/marca.controlador.php";
require_once "../../modelos/marca.modelo.php";
require_once "../../controladores/modelo.controlador.php";
require_once "../../modelos/modelo.modelo.php";
require_once "../../controladores/uso-estatus-estado.controlador.php";
require_once "../../modelos/uso-estatus-estado.modelo.php";
require_once "../../controladores/departamento.controlador.php";
require_once "../../modelos/departamento.modelo.php";
require_once "../../controladores/ubicacion.controlador.php";
require_once "../../modelos/ubicacion.modelo.php";
require_once "../../controladores/empleado.controlador.php";
require_once "../../modelos/empleado.modelo.php";
require_once "../../controladores/puesto.controlador.php";
require_once "../../modelos/puesto.modelo.php";
require_once "../../controladores/historial.controlador.php";
require_once "../../modelos/historial.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/lineas.controlador.php";
require_once "../../modelos/lineas.modelo.php";

$reporte = new ControladorReportes();

$tipoReporte = $_GET["reporte"];

switch ($tipoReporte) {

    case "telefonos":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteTelefonos();
        break;

    case "impresoras":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteImpresoras();
        break;

    case "computadoras":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteComputadoras();
        break;

    case "activosFijos":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteGeneral();
        break;

    case "activosFijosCompleto":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteCompleto();
        break;

    case "empleados":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteEmpleados();
        break;

    case "puestos":
        $reporte->ctrDescargarReportePuestos();
        break;

    case "categorias":
        $reporte->ctrDescargarReporteCategorias();
        break;

    case "marcas":
        $reporte->ctrDescargarReporteMarcas();
        break;

    case "modelos":
        $reporte->ctrDescargarReporteModelos();
        break;

    case "departamentos":
        $reporte->ctrDescargarReporteDepartamentos();
        break;

    case "ubicaciones":
        $reporte->ctrDescargarReporteUbicaciones();
        break;

    case "historialMovimeintos":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteHistorial();
        break;

    case "historialEstados":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteHistorialEstados();
        break;

    case "lineas":
        $reporte->AFseries = $_GET["series"];
        $reporte->ctrDescargarReporteLineas();
        break;

    case "renovaciones":
        $reporte->AFseries = $_GET["series"];
        $reporte->añosSumar = $_GET["añosSumar"];
        $reporte->ctrDescargarReporteRenovaciones();
        break;
}
