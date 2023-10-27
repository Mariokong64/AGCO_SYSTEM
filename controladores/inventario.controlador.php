<?php

class ControladorInventario
{

    /* ==================================================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS QUE ESTÉN VISIBLES (NO ELIMINADOS)
    ===================================================================================*/

    static public function ctrMostrarAF($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

        return $respuesta;
    }

    /* ======================================================================================================
            MÉTODO PARA MOSTRAR TODOS LOS ACTIVOS FIJOS VISIBLES O NO (ES PARA QUE SALGA TODO EL HISTORIAL)
    =======================================================================================================*/

    static public function ctrMostrarActivosHistorial($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventarioHistorial($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
     MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS NO ASIGNADOS
    ===================================================*/

    static public function ctrMostrarNoAsignado($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventarionNoAsignado($tabla, $item, $valor);

        return $respuesta;
    }

    /* ====================================================================================
            MÉTODO PARA MOSTRAR LA CANTIDAD DE ACTIVOS FIJOS ASIGNADOS A UN EMPLEADO EN ESPECÍFICO
        =====================================================================================*/

    static public function ctrMostrarAFdeEmpleado($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarInventarioDeEmpleado($tabla, $item, $valor);

        return $respuesta;
    }

    /* ====================================================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS ASIGNADOS A UN EMPLEADO EN ESPECÍFICO
        =====================================================================================*/

    static public function ctrMostrarInventarioDeEmpleado($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventario::mdlMostrarActivosDeEmpleado($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrRegistrarAF()
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
                        window.location = "inventario";
                    }
                });

        </script>';
            }
        }
    }

    /* ================================================================================
            MÉTODO PARA EDITAR ACTIVOS FIJOS DESDE LA SECCIÓN DE INVENTARIO GENERAL
    ==================================================================================*/

    static public function ctrEditarAF()
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

                $respuesta = ModeloInventario::mdlEditarAF($tabla, $datos);

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
                        window.location = "inventario";
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
                    window.location = "inventario";
                }
            });

    </script>';
            }
        }
    }

    /* =====================================================================================================
            MÉTODO PARA EDITAR ACTIVOS FIJOS DESDE LA SECCIÓN DEL INVENTARIO DE UN EMPLEADO EN ESPECÍFICO
    =======================================================================================================*/

    static public function ctrEditarActivos()
    {

        if (isset($_POST["editarSerie"])) {

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

            $idEmpleado = $_POST["idEmpleado"];

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

            $respuesta = ModeloInventario::mdlEditarAF($tabla, $datos);

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
                                window.location = "index.php?ruta=devolucionActivo&idEmpleado=' . $idEmpleado . '";
                            }
                        });
        
                </script>';
            }
        }
    }


    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function ctrEliminarAF()
    {

        if (isset($_GET["idInventario"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "inventario";
                $datos = $_GET["idInventario"];

                //Aqui vamos a buscar el activo fijo que queremos eliminar en la base de datos para ver si está asignado o no
                $item = "id_inventario";
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
                                window.location = "inventario";
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
                                window.location = "inventario";
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
                    window.location = "inventario";
                }
            });

    </script>';
            }
        }
    }
}
