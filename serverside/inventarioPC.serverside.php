<?php
require 'serverside.php';
$table_data->get('vista_inventario_computadoras', 'id_inventario', array('serie', 'modelo', 'marca', 'tipo', 'id_estado', 'asignado', 'departamento', 'ubicacion', 'empleado', 'estatus', 'host_name', 'detalles'));

?>