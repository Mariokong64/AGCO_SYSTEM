<?php
require 'serverside.php';
$table_data->get('vista_inventario_renovaciones', 'id_inventario', array('serie', 'tipo', 'marca', 'modelo', 'asignado', 'id_estado', 'estatus', 'fecha_ingreso', 'fecha_vencimiento', 'fecha_renovacion'));
?>