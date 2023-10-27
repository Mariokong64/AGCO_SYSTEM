<?php
require 'serverside.php';
$table_data->get('vista_inventario_impresoras', 'id_inventario', array('serie', 'modelo', 'marca', 'id_estado', 'departamento', 'ubicacion', 'estatus', 'ip', 'detalles'));

?>