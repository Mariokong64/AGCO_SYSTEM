<?php
require 'serverside.php';
$table_data->get('vista_lineas_telefonicas', 'linea', array('linea', 'serie', 'marca', 'modelo', 'empleado', 'contrato', 'centro_costos', 'limite', 'tipo_linea'));

?>