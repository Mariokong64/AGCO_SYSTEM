<?php

class ControladorAsignaciones
{

    static public function ctrCrearAsignacion()
    {

        if (isset($_POST["listaActivos"])) {

            $tabla = "inventario";
            $idEmpleado = $_POST["seleccionarEmpleado"];
            $idUsuario = $_POST["id_asignador"];

            $listaActivos = json_decode($_POST["listaActivos"], true);

            $valor = $idEmpleado;
            $item = "id_empleado";

            $empleado = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

            $idDepartamento = $empleado["id_departamento"];

            foreach ($listaActivos as $key => $value) {

                $idActivo = $value["idActivo"];

                $datos = array(
                    "id_empleado" => $idEmpleado,
                    "id_inventario" => $idActivo,
                    "id_departamento" => $idDepartamento,
                    "id_usuario" => $idUsuario,
                    "id_motivo" => 4
                );

                $respuesta = ModeloInventario::mdlEditarActivosAsignados($tabla, $datos);

                $movimiento = 1;

                ModeloHistorial::mdlIngresarMovimiento($movimiento, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                swal({
                        
                   type: "success",
                   title: "La asignación se llevó a cabo exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "asignacion";
                        }
                    });

            </script>';
                }
            }
        }
    }
}
