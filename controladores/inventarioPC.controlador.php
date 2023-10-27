<?php

class ControladorInventarioPC
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    static public function ctrMostrarPC($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventarioPC::mdlMostrarInventarioPC($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrRegistrarPC()
    {

        if (isset($_POST["nuevaSerie"])) {



            $tabla = "inventario";
            $datos = array(
                "serie" => $_POST["nuevaSerie"],
                "factura" => $_POST["nuevaFactura"],
                "id_tipo" => $_POST["nuevoTipo"],
                "id_marca" => $_POST["nuevaMarca"],
                "id_modelo" => $_POST["nuevoModelo"],
                "id_estatus" => $_POST["nuevoEstatus"],
                "fecha_ingreso" => $_POST["nuevaFechaCompra"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "detalles" => $_POST["nuevoDetalle"],
                "host_name" => $_POST["nuevoHostName"]
            );

            var_dump($datos);
            $respuesta = ModeloInventarioPC::mdlRegistrarPC($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

            swal({

               type: "success",
               title: "El Activo Fijo ha sido registrado exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "inventarioPC";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEditarPC()
    {

        if (isset($_POST["editarSerie"])) {

            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                $tabla = "inventario";

                $datos = array(
                    "serie" => $_POST["editarSerie"],
                    "id_inventario" => $_POST["idDelInventario"],
                    "factura" => $_POST["editarFactura"],
                    "id_tipo" => $_POST["editarTipo"],
                    "id_marca" => $_POST["editarMarca"],
                    "id_modelo" => $_POST["editarModelo"],
                    "id_estatus" => $_POST["editarEstatus"],
                    "fecha_ingreso" => $_POST["editarFechaCompra"],
                    "fecha_vencimiento" => $_POST["editarFechaVencimiento"],
                    "id_ubicacion" => $_POST["editarUbicacion"],
                    "posicion" => $_POST["editarPosicion"],
                    "id_estado" => $_POST["editarEstado"],
                    "detalles" => $_POST["editarDetalle"],
                    "host_name" => $_POST["editarHostName"],
                );

                $estadoAnterior = $_POST["estadoAnterior"];
                $estadoActual = $_POST["editarEstado"];

                if ($estadoAnterior != $estadoActual) {

                    $datosHistorial = array(
                        "id_inventario" => $_POST["idDelInventario"],
                        "id_usuario" => $_SESSION["id_usuario"],
                        "id_estado_anterior" => $estadoAnterior,
                        "id_estado_posterior" => $estadoActual,
                    );

                    ModeloHistorial::mdlIngresarEstado($datosHistorial);
                }

                $respuesta = ModeloInventarioPC::mdlEditarPC($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

            swal({

               type: "success",
               title: "El Activo Fijo ha sido editado exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "inventarioPC";
                    }
                });

        </script>';
                }
            } else {

                echo '<script>

        swal({

           type: "error",
           title: "Actualmente no cuentas con los permisos para editar registros de activos fijos",
           showConfirmButton: true,
           confirmButtonText: "Cerrar",
           closeOnConform: false

            }).then((result)=>{
                if (result.value) {
                    window.location = "inventarioPC";
                }
            });

    </script>';
            }
        }
    }


    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEliminarPC()
    {

        if (isset($_GET["idInventario"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "inventario";
                $datos = $_GET["idInventario"];

                //Aqui vamos a buscar el activo fijo que queremos eliminar en la base de datos para ver si está asignado o no
                $item = "serie";
                $valor = $_GET["idInventario"];

                $computadora = ModeloInventarioPC::mdlMostrarInventarioPC($tabla, $item, $valor);

                if ($computadora["asignado"] == 1) {

                    echo '<script>

                    swal({
                    
                       type: "error",
                       title: "La computadora no puede ser eliminada ya que se encuentra asignada a un empleado",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioPC";
                            }
                        });
                    
                    </script>';

                    return;
                } else {

                    $respuesta = ModeloInventarioPC::mdlEliminarPC($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
                    
                       type: "success",
                       title: "El empleado ha sido eliminado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioPC";
                            }
                        });
                    
                    </script>';
                    }
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
                                    window.location = "inventarioPC";
                                }
                            });
                
                    </script>';
            }
        }
    }
}
