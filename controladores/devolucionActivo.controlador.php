<?php

class ControladorDevolucionActivos
{

    /* ==================================================
            MÉTODO PARA DESASIGNAR UN ACTIVO
    ===================================================*/

    static public function ctrDesasignarActivo()
    {

        if (isset($_POST["motivoDevolucion"])) {

            $tabla = "inventario";
            $idUsuario = $_SESSION["id_usuario"];
            $datos = array(
                "id_inventario" => $_POST["idDelActivo"],
                "id_estado" => $_POST["estadoDevolucion"],
            );

            $respuesta = ModeloInventario::mdlDesasignarInventario($tabla, $datos);

            //Aqui metemos en la tabla del historial de movimientos este movimiento de devolución

            $movimiento = 2;
            $datos = array(
                "id_empleado" => $_POST["idDelEmpleado"],
                "id_inventario" => $_POST["idDelActivo"],
                "id_usuario" => $idUsuario,
                "id_motivo" => $_POST["motivoDevolucion"],
            );

            ModeloHistorial::mdlIngresarMovimiento($movimiento, $datos);

            //Aqui vamos a valorar si se hizo alguna modificación al activo y si se hizo, lo vamos a registrar en la tabla del historial de modificaciones

            $estadoAnterior = $_POST["estadoAnteriorDevolucion"];
            $estadoActual = $_POST["estadoDevolucion"];

            if ($estadoAnterior != $estadoActual) {

                $datosHistorial = array(
                    "id_inventario" => $_POST["idDelActivo"],
                    "id_usuario" => $_SESSION["id_usuario"],
                    "id_estado_anterior" => $estadoAnterior,
                    "id_estado_posterior" => $estadoActual,
                );

                ModeloHistorial::mdlIngresarEstado($datosHistorial);
            }

            // Aqui tomamos el id del empleado para mandarlo como variable GET en el próximo if
            $idEmpleado = $_POST["idDelEmpleado"];

            if ($respuesta == "ok") {

                echo '<script>
    
                    swal({
    
                       type: "success",
                       title: "El activo ha sido desasignado correctamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
    
                    
                    }).then((result)=>{
                        if (result.value) {

                            window.location = "index.php?ruta=devolucionActivo&idEmpleado=' . $idEmpleado . '";

                        }
                    });
        
                </script>';
            }
        }
    }
}
