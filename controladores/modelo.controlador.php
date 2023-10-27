<?php

class ControladorModelos
{

    /* ==================================================
            MÉTODO PARA INGRESAR MODELOS
    ===================================================*/

    static public function ctrCrearModelo()
    {

        if (isset($_POST["nuevoModelo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ -]+$/', $_POST["nuevoModelo"])) {

                $tabla = "modelo";
                $modelo = mb_strtoupper($_POST["nuevoModelo"]);
                $modelo = trim($modelo);
                $datos = $modelo;

                $respuesta = ModeloModelo::mdlIngresarModelo($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "El modelo ha sido creado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "modelo";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la categoria no puede ir vacío o llevar caracteres tan especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "modelo";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR MODELOS
    ===================================================*/

    static public function ctrMostrarModelos($item, $valor)
    {

        $tabla = "modelo";

        $respuesta = ModeloModelo::mdlMostrarModelos($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR MODELOS
    ===================================================*/

    static public function ctrEditarModelo()
    {

        if (isset($_POST["editarModelo"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ -]+$/', $_POST["editarModelo"])) {

                $tabla = "modelo";
                $editarModelo = mb_strtoupper($_POST["editarModelo"]);
                $editarModelo = trim($editarModelo);
                $datos = array(
                    "modelo" => $editarModelo,
                    "id_modelo" => $_POST["idModelo"]
                );

                if ($datos["id_modelo"] != 1) {

                    $respuesta = ModeloModelo::mdlEditarModelo($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
    
                       type: "success",
                       title: "El modelo ha sido editado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "modelo";
                            }
                        });
    
                </script>';
                    }
                } else {

                    echo '<script>

                swal({

                   type: "error",
                   title: "Este modelo no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "modelo";
                        }
                    });

            </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre del modelo no puede ir vacío o llevar caracteres tan especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "modelo";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR MODELOS
    ===================================================*/

    static public function ctrBorrarModelo()
    {

        if (isset($_GET["idModelo"])) {

            $tabla = "modelo";
            $tablaConsulta = "inventario";
            $datos = $_GET["idModelo"];
            $valor = "id_modelo";

            if ($datos != 1) {

                $consulta = ModeloInventario::mdlMostrarInventario($tablaConsulta, $valor, $datos);

                if($consulta == false){

                $respuesta = ModeloModelo::mdlBorrarModelo($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                swal({

                   type: "success",
                   title: "El modelo ha sido eliminado exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",

                    }).then(function(result){
                        if (result.value) {
                            window.location = "modelo";
                        }
                    });

            </script>';
                }


            } else {

                echo '<script>
            
                    swal({
            
                       type: "error",
                       title: "Este modelo no se puede eliminar porque hay AFs asociados a el",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
            
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "modelo";
                            }
                        });
            
                </script>';
            }

            } else {

                echo '<script>
            
                    swal({
            
                       type: "error",
                       title: "Este modelo no se puede eliminar",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
            
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "modelo";
                            }
                        });
            
                </script>';
            }
        }
    }
}
