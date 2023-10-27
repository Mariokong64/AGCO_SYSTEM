<?php

class ControladorPuestos
{

    /* ==================================================
            MÉTODO PARA INGRESAR PUESTOS
    ===================================================*/

    static public function ctrCrearPuesto()
    {

        if (isset($_POST["nuevoPuesto"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPuesto"])) {

                $tabla = "puesto";
                $puesto = mb_strtoupper($_POST["nuevoPuesto"]);
                $puesto = trim($puesto);
                $datos = $puesto;

                $respuesta = ModeloPuesto::mdlIngresarPuesto($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "El puesto ha sido creado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "puesto";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre del puesto no puede ir vacío o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "puesto";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR PUESTOS
    ===================================================*/

    static public function ctrMostrarPuestos($item, $valor)
    {

        $tabla = "puesto";

        $respuesta = ModeloPuesto::mdlMostrarPuestos($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR PUESTOS
    ===================================================*/

    static public function ctrEditarPuesto()
    {

        if (isset($_POST["editarPuesto"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPuesto"])) {

                $tabla = "puesto";
                $editarPuesto = mb_strtoupper($_POST["editarPuesto"]);
                $editarPuesto = trim($editarPuesto);
                $datos = array(
                    "puesto" => $editarPuesto,
                    "id_puesto" => $_POST["idPuesto"]
                );

                $respuesta = ModeloPuesto::mdlEditarPuesto($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "El puesto ha sido editado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "puesto";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre del puesto no puede ir vacío o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "puesto";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR PUESTOS
    ===================================================*/

    static public function ctrBorrarPuesto()
    {

        if (isset($_GET["idPuesto"])) {

            $tabla = "puesto";
            $datos = $_GET["idPuesto"];
            $tablaConsulta = "empleado";
            $valor = "id_puesto";

            $consulta = ModeloEmpleados::mdlMostrarEmpleados($tablaConsulta, $valor, $datos);

            if ($consulta == false){

            $respuesta = ModeloPuesto::mdlBorrarPuesto($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({

                   type: "success",
                   title: "El puesto ha sido eliminado exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",

                    }).then(function(result){
                        if (result.value) {
                            window.location = "puesto";
                        }
                    });

            </script>';
            }
        } else {

            echo '<script>

            swal({

               type: "error",
               title: "Este puesto no se puede eliminar porque existen empleados que pertenecen a este puesto",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "puesto";
                    }
                });

        </script>';
        }
        }
    }
}
