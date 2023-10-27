<?php

class ControladorUbicaciones
{

    /* ==================================================
            MÉTODO PARA INGRESAR UBICACIONES
    ===================================================*/

    static public function ctrCrearUbicacion()
    {

        if (isset($_POST["nuevaUbicacion"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaUbicacion"])) {

                $tabla = "ubicacion";
                $ubicacion = mb_strtoupper($_POST["nuevaUbicacion"]);
                $ubicacion = trim($ubicacion);
                $datos = $ubicacion;

                $respuesta = ModeloUbicacion::mdlIngresarUbicacion($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "La ubicación ha sido agregada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "ubicacion";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la ubicacion no puede ir vacío o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "ubicacion";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR UBICACIONES
    ===================================================*/

    static public function ctrMostrarUbicaciones($item, $valor)
    {

        $tabla = "ubicacion";

        $respuesta = ModeloUbicacion::mdlMostrarUbicaciones($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR UBICACIONES
    ===================================================*/

    static public function ctrEditarUbicacion()
    {

        if (isset($_POST["editarUbicacion"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarUbicacion"])) {

                $tabla = "ubicacion";
                $editarUbicacion = mb_strtoupper($_POST["editarUbicacion"]);
                $editarUbicacion = trim($editarUbicacion);
                $datos = array(
                    "ubicacion" => $editarUbicacion,
                    "id_ubicacion" => $_POST["idUbicacion"]
                );

                if ($datos["id_ubicacion"] != 1) {

                    $respuesta = ModeloUbicacion::mdlEditarUbicacion($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
    
                       type: "success",
                       title: "La ubicación ha sido editada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "ubicacion";
                            }
                        });
    
                </script>';
                    }
                } else {

                    echo '<script>

                swal({

                   type: "error",
                   title: "Esta ubicación no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "ubicacion";
                        }
                    });

            </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la ubicación no puede ir vacía o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "ubicacion";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR UBICACIONES
    ===================================================*/

    static public function ctrBorrarUbicacion()
    {

        if (isset($_GET["idUbicacion"])) {

            $tabla = "ubicacion";
            $tablaConsulta = "inventario";
            $datos = $_GET["idUbicacion"];
            $valor = "id_ubicacion";

            if ($datos != 1) {

                $consulta = ModeloInventario::mdlMostrarInventario($tablaConsulta, $valor, $datos);

                if ($consulta == false) {

                    $respuesta = ModeloUbicacion::mdlBorrarUbicacion($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                swal({

                   type: "success",
                   title: "La ubicacion ha sido eliminada exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",

                    }).then(function(result){
                        if (result.value) {
                            window.location = "ubicacion";
                        }
                    });

            </script>';
                    }

                } else {

                    echo '<script>

            swal({

               type: "error",
               title: "Esta ubicación no se puede eliminar porque hay AFs asociados a ella",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "ubicacion";
                    }
                });

        </script>';
                }
            } else {

                echo '<script>

            swal({

               type: "error",
               title: "Esta ubicación no se puede eliminar",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "ubicacion";
                    }
                });

        </script>';
            }
        }
    }
}
