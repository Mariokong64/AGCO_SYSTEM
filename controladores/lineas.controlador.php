<?php

class ControladorLineas
{

    /* ==================================================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS QUE ESTÉN VISIBLES (NO ELIMINADOS)
    ===================================================================================*/

    static public function ctrMostrarLineas($item, $valor)
    {

        $tabla = "lineas";

        $respuesta = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS QUE ESTÉN VISIBLES (NO ELIMINADOS)
    ===================================================================================*/

    static public function ctrMostrarLineasEditar($item, $valor)
    {

        $tabla = "lineas";

        $respuesta = ModeloLineas::mdlMostrarLineasEditar($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================================================
            MÉTODO PARA MOSTRAR LOS DISPOSITIVOS QUE SEAN DE TIPO TELÉFONO 
    ===================================================================================*/

    static public function ctrMostrarDispositivosCelulares($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloLineas::mdlMostrarDispositivos($tabla, $item, $valor);

        return $respuesta;
    }



    /* =====================================================
            MÉTODO PARA INGRESAR NUEVAS LÍNEAS TELÉFONICAS
    ========================================================*/

    static public function ctrRegistrarLineas()
    {

        if (isset($_POST["nuevaLinea"])) {

            $tabla = "lineas";

            $datos = array(
                "linea" => $_POST["nuevaLinea"],
                "contrato" => $_POST["nuevoContrato"],
                "centro_costos" => $_POST["nuevoCC"],
                "limite" => $_POST["nuevoLimite"],
                "id_tipo_linea" => $_POST["nuevoTipoLinea"],
                "id_inventario" => 826,
                "id_empleado" => 1,
                "detalles" => $_POST["nuevoDetalle"],

            );

            $respuesta = ModeloLineas::mdlRegistrarLineas($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

            swal({

               type: "success",
               title: "La línea ha sido registrada exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "lineas";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR LINEAS TELEFÓNICAS
    ===================================================*/

    static public function ctrEditarLinea()
    {

        if (isset($_POST["editarLinea"])) {

            $imeiRepetido = false;
            $cambio = 4;

            //Aquí buscamos la línea que se va a editar para comparar si los valores son iguales o se está cambiando el valor del dispositivo a asignar

            $item = "id_linea";
            $valor = $_POST["idLinea"];
            $tabla = "lineas";

            $linea = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);

            //Ahora evaluamos si el valor del dispositivo a asignar es igual al que ya está asignado, si es igual, no hacemos nada, si es diferente, validamos que no esté asignado a otra línea

            if ($_POST["seleccionarDispositivo"] != 826 && $linea["id_inventario"] != $_POST["seleccionarDispositivo"]) {

                //Aquí validamos si la línea que se intenta asignar ya está asignada a otra línea

                $item = "id_inventario";
                $valor = $_POST["seleccionarDispositivo"];

                $respuesta = ModeloLineas::mdlBuscarImeiRepetido($item, $valor);

                if ($respuesta["id_inventario"] == $_POST["seleccionarDispositivo"]) {

                    $imeiRepetido = true;
                }
            }

            if ($imeiRepetido == true) {

                echo '<script>

                swal({
                
                   type: "error",
                   title: "El dispositivo que intentas asignar ya se encuentra asignado a otra línea",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                
                    }).then(function(result){
                        if (result.value) {
                            window.location = "lineas";
                        }
                    });
                
                </script>';
            } else {


                  //Aquí vamos a verificar si se hizo algún cambio en el dispositivo o en el empleado asignado a esa línea

            if ($_POST["seleccionarEmpleado"] != $linea["id_empleado"]) {

                $cambio = 2;

            } if ($linea["id_inventario"] != $_POST["seleccionarDispositivo"]) {

                $cambio = 1;

            } if ($_POST["seleccionarEmpleado"] != $linea["id_empleado"] && $linea["id_inventario"] != $_POST["seleccionarDispositivo"]) {

                $cambio = 3;

            }

            //Aqui vamos a meter los cambios en la tabla del historial de las líneas si es que hubo alguno

            if($cambio != 4){

                $tabla = "historial_lineas";

                $datos = array(
                    "id_linea" => $_POST["idLinea"],
                    "id_inventario_anterior" => $linea["id_inventario"],
                    "id_inventario_posterior" => $_POST["seleccionarDispositivo"],
                    "id_empleado_anterior" => $linea["id_empleado"],
                    "id_empleado_posterior" => $_POST["seleccionarEmpleado"],
                    "id_usuario" => $_SESSION["id_usuario"],
                    "cambio" => $cambio
                );

                ModeloHisotrialLineas::mdlRegistralHistorialLinea($tabla, $datos);

            }

                $tabla = "lineas";

                $datos = array(
                    "id_linea" => $_POST["idLinea"],
                    "linea" => $_POST["editarLinea"],
                    "contrato" => $_POST["editarContrato"],
                    "centro_costos" => $_POST["editarCC"],
                    "limite" => $_POST["editarLimite"],
                    "id_tipo_linea" => $_POST["editarTipoLinea"],
                    "id_inventario" => $_POST["seleccionarDispositivo"],
                    "id_empleado" => $_POST["seleccionarEmpleado"],
                    "detalles" => $_POST["editarDetalles"],
                );

                $respuesta = ModeloLineas::mdlEditarLineas($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

            swal({

               type: "success",
               title: "La línea ha sido editada exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "lineas";
                    }
                });

        </script>';
                }
            }
        }
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEliminarLinea()
    {

        if (isset($_GET["idLinea"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "lineas";
                $datos = $_GET["idLinea"];

                $respuesta = ModeloLineas::mdlEliminarLineas($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                    
                       type: "success",
                       title: "La linea ha sido eliminada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "lineas";
                            }
                        });
                    
                    </script>';
                }
            } else {

                echo '<script>
    
            swal({
    
               type: "error",
               title: "Actualmente no cuentas con los permisos para eliminar activos fijos",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false
    
                }).then((result)=>{
                    if (result.value) {
                        window.location = "lineas";
                    }
                });
    
        </script>';
            }
        }
    }
}
