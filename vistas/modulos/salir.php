<?php

/* AQUI SE DESTRUYE LA SESION AL MOMENTO DE DARLE CLICK AL BOTON DE SALIR QUE ESTÁ EN EL "CABEZOTE" */

session_destroy();

echo '<script>

window.location = "ingreso";

</script>';
