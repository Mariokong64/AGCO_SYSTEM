<?php
require 'serverside.php';
$table_data->get('vista_inventario_completo', 'id_inventario', array('serie', 'modelo', 'marca', 'tipo', 'id_estado', 'asignado', 'departamento', 'ubicacion', 'posicion', 'empleado', 'uso', 'estatus', 'factura', 'host_name', 'numero_tel', 'imei', 'email_cel', 'contrato', 'mac_tel', 'ip', 'fecha_ingreso', 'fecha_vencimiento', 'fecha_registro', 'detalles'));

?>