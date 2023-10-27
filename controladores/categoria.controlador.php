<?php

class ControladorCategorias
{

    /* ==================================================
            MÉTODO PARA INGRESAR CATEGORÍAS
    ===================================================*/

    static public function ctrCrearCategoria()
    {

        if (isset($_POST["nuevaCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])) {

                $tabla = "tipo";
                $categoria = mb_strtoupper($_POST["nuevaCategoria"]);
                $categoria = trim($categoria);
                $datos = $categoria;

                $respuesta = ModeloCategoria::mdlIngresarCategoria($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
    
                       type: "success",
                       title: "La categoría ha sido creada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "categoria";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la categoria no puede ir vacía o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "categoria";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR CATEGORÍAS
    ===================================================*/

    static public function ctrMostrarCategorias($item, $valor)
    {

        $tabla = "tipo";

        $respuesta = ModeloCategoria::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR CATEGORÍAS
    ===================================================*/

    static public function ctrEditarCategoria()
    {

        if (isset($_POST["editarCategoria"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])) {

                $tabla = "tipo";
                $editarCategoria = mb_strtoupper($_POST["editarCategoria"]);
                $editarCategoria = trim($editarCategoria);
                $datos = array(
                    "tipo" => $editarCategoria,
                    "id_tipo" => $_POST["idCategoria"]
                );

                if ($datos["id_tipo"] > 5) {

                    $respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

                    swal({
    
                       type: "success",
                       title: "La categoría ha sido editada exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "categoria";
                            }
                        });
    
                </script>';
                    }
                } else {

                    echo '<script>

                swal({

                   type: "error",
                   title: "Esta categoría no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "categoria";
                        }
                    });

            </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre de la categoria no puede ir vacía o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "categoria";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR CATEGORÍAS
    ===================================================*/

    static public function ctrBorrarCategoria()
    {

        if (isset($_GET["idCategoria"])) {

            $tabla = "tipo";
            $tablaConsulta = "inventario";
            $datos = $_GET["idCategoria"];
            $valor = "id_tipo";
            
            if ($datos > 5) {

                $consulta = ModeloInventario::mdlMostrarInventario($tablaConsulta, $valor, $datos);

                if($consulta == false){

                $respuesta = ModeloCategoria::mdlBorrarCategoria($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                swal({

                   type: "success",
                   title: "La categoría ha sido eliminada exitosamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",

                    }).then(function(result){
                        if (result.value) {
                            window.location = "categoria";
                        }
                    });

            </script>';
                }
            
            } else {

                echo '<script>

            swal({

               type: "error",
               title: "Esta categoría no se puede eliminar porque hay AFs que pertenecen a esta categoría",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "categoria";
                    }
                });

        </script>';
            }
            
            
            } else {

                echo '<script>

            swal({

               type: "error",
               title: "Esta categoría no se puede eliminar",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "categoria";
                    }
                });

        </script>';
            }
        }
    }
}
