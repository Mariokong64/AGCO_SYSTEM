<?php

class ControladorInventarioImpresora
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS ACTIVOS FIJOS
    ===================================================*/

    static public function ctrMostrarImpresora($item, $valor)
    {

        $tabla = "inventario";

        $respuesta = ModeloInventarioImpresora::mdlMostrarInventarioImpresora($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA REGISTRAR LAS IMPRESORAS
    ===================================================*/

    static public function ctrRegistrarImpresora()
    {

        if (isset($_POST["nuevaSerie"])) {

            $tipo = 3;

            $tabla = "inventario";
            $datos = array(
                "serie" => $_POST["nuevaSerie"],
                "factura" => $_POST["nuevaFactura"],
                "id_tipo" => $tipo,
                "id_marca" => $_POST["nuevaMarca"],
                "id_modelo" => $_POST["nuevoModelo"],
                "id_estatus" => $_POST["nuevoEstatus"],
                "fecha_ingreso" => $_POST["nuevaFechaCompra"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "ip" => $_POST["nuevoIP"],
                "detalles" => $_POST["nuevoDetalle"]
            );

            var_dump($datos);
            $respuesta = ModeloInventarioImpresora::mdlRegistrarImpresora($tabla, $datos);

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
                        window.location = "inventarioImpresora";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA EDITAR LAS IMPRESORAS
    ===================================================*/

    static public function ctrEditarImpresora()
    {

        if (isset($_POST["editarSerie"])) {

            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                $tabla = "inventario";
                $tipo = 3;

                $datos = array(
                    "serie" => $_POST["editarSerie"],
                    "id_inventario" => $_POST["idDelInventario"],
                    "factura" => $_POST["editarFactura"],
                    "id_tipo" => $tipo,
                    "id_marca" => $_POST["editarMarca"],
                    "id_modelo" => $_POST["editarModelo"],
                    "id_estatus" => $_POST["editarEstatus"],
                    "fecha_ingreso" => $_POST["editarFechaCompra"],
                    "fecha_vencimiento" => $_POST["editarFechaVencimiento"],
                    "id_ubicacion" => $_POST["editarUbicacion"],
                    "ip" => $_POST["editarIP"],
                    "id_estado" => $_POST["editarEstado"],
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

                $respuesta = ModeloInventarioImpresora::mdlEditarImpresora($tabla, $datos);

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
                        window.location = "inventarioImpresora";
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
                        window.location = "inventarioImpresora";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR IMPRESORAS
    ===================================================*/

    static public function ctrEliminarImpresora()
    {

        if (isset($_GET["idInventario"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "inventario";
                $datos = $_GET["idInventario"];

                $respuesta = ModeloInventarioImpresora::mdlEliminarImpresora($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                    
                       type: "success",
                       title: "La impresora ha sido eliminada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "inventarioImpresora";
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
                    window.location = "inventarioImpresora";
                }
            });

    </script>';
            }
        }
    }
}
