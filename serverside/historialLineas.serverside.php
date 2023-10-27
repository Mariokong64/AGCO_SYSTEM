<?php
require 'serverside.php';
$table_data->get('vista_historial_lineas', 'linea', array('linea', 'serie_anterior', 'serie_posterior', 'empleado_anterior', 'empleado_posterior', 'usuario', 'fecha', 'cambio'));

?>