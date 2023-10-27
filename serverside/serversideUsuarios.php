<?php
require 'serverside.php';
$table_data->get('vista_inventario_rapido', 'id_inventario', array('serie', 'tipo', 'marca', 'modelo', 'asignado', 'estado', 'departamento', 'ubicacion', 'empleado'));

?>