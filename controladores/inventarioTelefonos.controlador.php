<?php

class ControladorInventarioTelefonos
{

    /* =====================================================================
            MÉTODO PARA MOSTRAR LOS TELEFONOS (CELULARES Y TELÉFONOS FIJOS)
    ========================================================================*/

    static public function ctrMostrarTelefonos($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventarioTelefonos::mdlMostrarInventarioTelefonos($tabla, $item, $valor);

        return $respuesta;
    }

        /* =====================================================================
            MÉTODO PARA MOSTRAR LOS TELEFONOS (CELULARES Y TELÉFONOS FIJOS)
    ========================================================================*/

    static public function ctrMostrarCelulares()
    {

        $tabla = "inventario";

        $respuesta = ModeloInventarioTelefonos::mdlMostrarInventarioCelulares($tabla);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR TELEFONOS
    ===================================================*/

    static public function ctrRegistrarTelefonos()
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
                "numero_tel" => $_POST["nuevoNumero"],
                "imei" => $_POST["nuevoImei"],
                "email_cel" => $_POST["nuevoCelEmail"],
                "mac_tel" => $_POST["nuevoMac"],
                "detalles" => $_POST["nuevoDetalle"],
                "contrato" => $_POST["nuevoContrato"],
            );

            $respuesta = ModeloInventarioTelefonos::mdlRegistrarTelefonos($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

            swal({

               type: "success",
               title: "El telefono ha sido registrado exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "inventarioTelefonos";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR TELEFONOS
    ===================================================*/

    static public function ctrEditarTelefonos()
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
                    "contrato" => $_POST["editarContrato"],
                    "numero_tel" => $_POST["editarNumero"],
                    "imei" => $_POST["editarImei"],
                    "email_cel" => $_POST["editarCelEmail"],
                    "mac_tel" => $_POST["editarMac"],
                    "detalles" => $_POST["editarDetalle"],
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

                $respuesta = ModeloInventarioTelefonos::mdlEditarTelefonos($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

            swal({

               type: "success",
               title: "El Telefono ha sido editado exitosamente",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "inventarioTelefonos";
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
                        window.location = "inventarioTelefonos";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEliminarTelefonos()
    {

        if (isset($_GET["idInventario"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "inventario";
                $datos = $_GET["idInventario"];

                //Aqui vamos a buscar el activo fijo que queremos eliminar en la base de datos para ver si está asignado o no
                $item = "serie";
                $valor = $_GET["idInventario"];

                $telefono = ModeloInventarioTelefonos::mdlMostrarInventarioTelefonos($tabla, $item, $valor);

                if ($telefono["asignado"] == 1) {

                    echo '<script>

                    swal({
                    
                       type: "error",
                       title: "El teléfono no puede ser eliminado ya que se encuentra asignado a un empleado",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioTelefonos";
                            }
                        });
                    
                    </script>';

                    return;

                } else {

                    $respuesta = ModeloInventarioTelefonos::mdlEliminarTelefonos($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
                    
                       type: "success",
                       title: "El teléfono ha sido eliminado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioTelefonos";
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
                        window.location = "inventarioTelefonos";
                    }
                });
    
        </script>';
            }
        }
    }
}
