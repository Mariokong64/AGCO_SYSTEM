<?php

class ControladorDepartamentos
{

    /* ==================================================
            MÉTODO PARA INGRESAR DEPARTAMENTOS
    ===================================================*/

    static public function ctrCrearDepartamento()
    {

        if (isset($_POST["nuevoDepartamento"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDepartamento"])) {

                if (preg_match('/^[0-9]+$/', $_POST["nuevoCC"])) {

                    $tabla = "departamento";
                    $departamento = mb_strtoupper($_POST["nuevoDepartamento"]);
                    $departamento = trim($departamento);
                    $datos = array(
                        "departamento" => $departamento,
                        "centro_costos" => $_POST["nuevoCC"],
                    );

                    $respuesta = ModeloDepartamento::mdlIngresarDepartamento($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>
    
                        swal({
        
                           type: "success",
                           title: "El departamento ha sido creado exitosamente",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar",
                           closeOnConform: false
        
                            }).then((result)=>{
                                if (result.value) {
                                    window.location = "departamento";
                                }
                            });
        
                    </script>';
                    }
                } else {

                    echo '<script>
    
                    swal({
    
                       type: "error",
                       title: "El centro de costos debe contener solo caracteres numéricos, no puede ir vacío ni llevar caracteres especiales",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "departamento";
                            }
                        });
    
                </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre del departamento no puede ir vacío o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR DEPARTAMENTOS
    ===================================================*/

    static public function ctrMostrarDepartamentos($item, $valor)
    {

        $tabla = "departamento";

        $respuesta = ModeloDepartamento::mdlMostrarDepartamentos($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR DEPARTAMENTOS
    ===================================================*/

    static public function ctrEditarDepartamento()
    {

        if (isset($_POST["editarDepartamento"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDepartamento"])) {

                if (preg_match('/^[0-9]+$/', $_POST["editarCC"])) {

                    $tabla = "departamento";
                    $editarDepartamento = mb_strtoupper($_POST["editarDepartamento"]);
                    $editarDepartamento = trim($editarDepartamento);
                    $datos = array(
                        "departamento" => $editarDepartamento,
                        "centro_costos" => $_POST["editarCC"],
                        "id_departamento" => $_POST["idActual"]
                    );

                    if ($datos["id_departamento"] != 1) {

                        $respuesta = ModeloDepartamento::mdlEditarDepartamento($tabla, $datos);

                        if ($respuesta == "ok") {

                            echo '<script>

                    swal({
    
                       type: "success",
                       title: "El departamento ha sido editado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "departamento";
                            }
                        });
    
                </script>';
                        }
                    } else {

                        echo '<script>

                swal({

                   type: "error",
                   title: "Este departamento no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
                    }
                } else {

                    echo '<script>

                swal({

                   type: "error",
                   title: "El centro de costos debe contener solo caracteres numéricos, no puede ir vacío ni llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
                }
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "El nombre del departamento no puede ir vacío o llevar caracteres especiales",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR DEPARTAMENTO
    ===================================================*/

    static public function ctrBorrarDepartamento()
    {

        if (isset($_GET["idDepartamento"])) {

            $tabla = "departamento";
            $tablaConsulta = "empleado";
            $datos = $_GET["idDepartamento"];
            $valor = "id_departamento";

            if ($datos != 1) {

                $consulta = ModeloEmpleados::mdlMostrarEmpleados($tablaConsulta, $valor, $datos);

                if($consulta == false){

                $respuesta = ModeloDepartamento::mdlBorrarDepartamento($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
    
                    swal({
    
                       type: "success",
                       title: "El departamento ha sido eliminado exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
    
                        }).then(function(result){
                            if (result.value) {
                                window.location = "departamento";
                            }
                        });
    
                </script>';
                }
            
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "Este departamento no se puede eliminar porque hay empleados y AFs asociados a él",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
            }
            
            
            
            
            } else {

                echo '<script>

                swal({

                   type: "error",
                   title: "Este departamento no se puede eliminar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{
                        if (result.value) {
                            window.location = "departamento";
                        }
                    });

            </script>';
            }
        }
    }
}
