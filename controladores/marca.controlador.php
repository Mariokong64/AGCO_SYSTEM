<?php

class ControladorMarcas
{

    /* ==================================================
            MÉTODO PARA INGRESAR MARCAS
    ===================================================*/

    static public function ctrCrearMarca()
    {

        if (isset($_POST["nuevaMarca"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])) {

                $tabla = "marca";
                $marca = mb_strtoupper($_POST["nuevaMarca"]);
                $marca = trim($marca);
                $datos = $marca;

                $respuesta = ModeloMarca::mdlIngresarMarca($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "La Marca ha sido creada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "marca";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la marca no puede ir vacía o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "marca";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR MARCAS
    ===================================================*/

    static public function ctrMostrarMarcas($item, $valor)
    {

        $tabla = "marca";

        $respuesta = ModeloMarca::mdlMostrarMarcas($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR MARCAS
    ===================================================*/

    static public function ctrEditarMarca()
    {

        if (isset($_POST["editarMarca"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])) {

                $tabla = "marca";
                $editarMarca = mb_strtoupper($_POST["editarMarca"]);
                $editarMarca = trim($editarMarca);
                $datos = array(
                    "marca" => $editarMarca,
                    "id_marca" => $_POST["idMarca"]
                );

                if ($datos["id_marca"] != 1) {

                    $respuesta = ModeloMarca::mdlEditarMarca($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
    
                       type: "success",
                       title: "La marca ha sido editada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "marca";
                            }
                        });
    
                </script>';
                    }
                } else {

                    echo '<script>

                swal({

                   type: "error",
                   title: "Esta marca no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "marca";
                        }
                    });

            </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la marca no puede ir vacía o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "marca";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR MARCAS
    ===================================================*/

    static public function ctrBorrarMarca()
    {

        if (isset($_GET["idMarca"])) {

            $tabla = "marca";
            $tablaConsulta = "inventario";
            $datos = $_GET["idMarca"];
            $valor = "id_marca";

            if ($datos != 1) {

                $consulta = ModeloInventario::mdlMostrarInventario($tablaConsulta, $valor, $datos);

                if($consulta == false){

                $respuesta = ModeloMarca::mdlBorrarMarca($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                swal({

                   type: "success",
                   title: "La marca ha sido eliminada exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",

                    }).then(function(result){
                        if (result.value) {
                            window.location = "marca";
                        }
                    });

            </script>';
                }

            }  else {

                echo '<script>

            swal({

               type: "error",
               title: "Esta marca no se puede eliminar porque hay AFs que pertenecen a esta marca",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "marca";
                    }
                });

        </script>';
            }




            } else {

                echo '<script>

            swal({

               type: "error",
               title: "Esta marca no se puede eliminar",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "marca";
                    }
                });

        </script>';
            }
        }
    }
}
