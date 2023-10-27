<?php
require 'serverside.php';
$table_data->get('vista_inventario_telefonos', 'id_inventario', array('serie', 'tipo', 'marca', 'modelo', 'id_estado', 'asignado', 'departamento', 'ubicacion', 'empleado', 'numero_tel', 'imei', 'email_cel', 'contrato', 'mac_tel'));

?>