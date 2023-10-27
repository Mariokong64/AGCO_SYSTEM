<?php
require 'serverside.php';
$table_data->get('vista_inventario_recurrente', 'id_inventario', array('serie', 'tipo', 'marca', 'modelo', 'asignado', 'empleado', 'detalles'));
?>