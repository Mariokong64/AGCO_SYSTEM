<?php
require 'serverside.php';
$table_data->get('vista_historial_movimientos', 'id_movimiento', array('movimiento', 'serie', 'tipo', 'empleado', 'usuario', 'motivo', 'fecha'));

?>