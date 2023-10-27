<?php

/* ESTE ES EL ARCHIVO PRINCIPAL, ESTE ARCHIVO REQUIERE AL CONTROLADOR Y AL MODELO DE TODOS LOS MODULOS DEL SISTEMA Y DESPUES EJECUTA EL MÉTODO
ctrPlantilla() DE LA CLASE ControladorPlantilla() LA CUAL ESTÁ EN "vistas/plantilla.php" */


require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/inventario.controlador.php";
require_once "controladores/inventarioTelefonos.controlador.php";
require_once "controladores/inventarioPC.controlador.php";
require_once "controladores/inventarioImpresora.controlador.php";
require_once "controladores/inventarioRapido.controlador.php";
require_once "controladores/categoria.controlador.php";
require_once "controladores/modelo.controlador.php";
require_once "controladores/marca.controlador.php";
require_once "controladores/motivo.controlador.php";
require_once "controladores/puesto.controlador.php";
require_once "controladores/ubicacion.controlador.php";
require_once "controladores/empleado.controlador.php";
require_once "controladores/departamento.controlador.php";
require_once "controladores/asignacion.controlador.php";
require_once "controladores/devolucionActivo.controlador.php";
require_once "controladores/historial.controlador.php";
require_once "controladores/credenciales.controlador.php";
require_once "controladores/lineas.controlador.php";
require_once "controladores/facturas.controlador.php";
require_once "controladores/uso-estatus-estado.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/inventario.modelo.php";
require_once "modelos/inventarioTelefonos.modelo.php";
require_once "modelos/inventarioPC.modelo.php";
require_once "modelos/inventarioImpresora.modelo.php";
require_once "modelos/categoria.modelo.php";
require_once "modelos/modelo.modelo.php";
require_once "modelos/motivo.modelo.php";
require_once "modelos/marca.modelo.php";
require_once "modelos/puesto.modelo.php";
require_once "modelos/ubicacion.modelo.php";
require_once "modelos/lineas.modelo.php";
require_once "modelos/facturas.modelo.php";
require_once "modelos/empleado.modelo.php";
require_once "modelos/departamento.modelo.php";
require_once "modelos/historial.modelo.php";
require_once "modelos/historialLineas.modelo.php";
require_once "modelos/credenciales.modelo.php";
require_once "modelos/uso-estatus-estado.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
