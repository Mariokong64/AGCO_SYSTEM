<?php
require 'serverside.php';
$table_data->get('vista_historial_estados', 'id_historial_estado', array('serie', 'tipo', 'id_estado_anterior', 'id_estado_posterior', 'usuario', 'fecha'));

?>