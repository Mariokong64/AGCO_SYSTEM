<?php

class ControladorInventarioRapido
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    static public function ctrMostrarRapido($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrRegistrarRapido()
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
                "numero_tel" => $_POST["nuevoNumero"],
                "imei" => $_POST["nuevoImei"],
                "email_cel" => $_POST["nuevoCelEmail"],
                "mac_tel" => $_POST["nuevoMac"],
                "contrato" => $_POST["nuevoContrato"],
                "host_name" => $_POST["nuevoHostName"],
                "ip" => $_POST["nuevoIP"]
            );

            var_dump($datos);
            $respuesta = ModeloInventario::mdlRegistrarAF($tabla, $datos);

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
                        window.location = "inventarioRapido";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEditarRapido()
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
                    "detalles" => $_POST["editarDetalle"],
                    "host_name" => $_POST["editarHostName"],
                    "numero_tel" => $_POST["editarNumero"],
                    "imei" => $_POST["editarImei"],
                    "email_cel" => $_POST["editarCelEmail"],
                    "mac_tel" => $_POST["editarMac"],
                    "contrato" => $_POST["editarContrato"],
                    "ip" => $_POST["editarIP"],
                    "id_estado" => $_POST["editarEstado"],
                    "id_ubicacion" => $_POST["editarUbicacion"],
                    "posicion" => $_POST["editarPosicion"],
                    "id_departamento" => $_POST["editarDepartamento"],
                );

                $estadoAnterior = $_POST["estadoAnterior"];
                $estadoActual = $_POST["editarEstado"];

                //Aquí vamos a agregar al historial de los cambios de estado en caso de que se haya hecho un cambio en el estado del AF

                if ($estadoAnterior != $estadoActual) {

                    $datosHistorial = array(
                        "id_inventario" => $_POST["idDelInventario"],
                        "id_usuario" => $_SESSION["id_usuario"],
                        "id_estado_anterior" => $estadoAnterior,
                        "id_estado_posterior" => $estadoActual,
                    );

                    ModeloHistorial::mdlIngresarEstado($datosHistorial);
                }

                $respuesta = ModeloInventario::mdlEditarAF($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

            swal({

               type: "success",
               title: "El Activo Fijo ha sido editado exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConfirm: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "inventarioRapido";
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
                    window.location = "inventarioRapido";
                }
            });

    </script>';
            }
        }
    }


    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEliminarRapido()
    {

        if (isset($_GET["idInventario"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "inventario";
                $datos = $_GET["idInventario"];

                //Aqui vamos a buscar el activo fijo que queremos eliminar en la base de datos para ver si está asignado o no
                $item = "serie";
                $valor = $_GET["idInventario"];

                $activo = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);
        
                if ($activo["asignado"] == 1) {

                    echo '<script>

                    swal({
                    
                       type: "error",
                       title: "El activo no puede ser eliminado ya que se encuentra asignado a un empleado",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioRapido";
                            }
                        });
                    
                    </script>';

                    return;
                } else {

                    $respuesta = ModeloInventario::mdlEliminarAF($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
                    
                       type: "success",
                       title: "El activo ha sido eliminado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioRapido";
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
                    window.location = "inventarioRapido";
                }
            });

    </script>';
            }
        }
    }
}
