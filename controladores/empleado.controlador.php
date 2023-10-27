<?php

class ControladorEmpleados
{

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS EMPLEADOS
    ===================================================*/

    static public function ctrMostrarEmpleados($item, $valor)
    {

        $tabla = "empleado";

        $respuesta = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR EMPLEADOS
    ===================================================*/

    static public function ctrIngresarEmpleados()
    {

        if (isset($_POST["nombre"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"])
            ) {

                if ($_POST["nuevaNomina"] === '' || preg_match('/^[0-9]+$/', $_POST["nuevaNomina"])) {

                    $tabla = "empleado";

                    $nombre = $_POST["nombre"];
                    $apellidoP = $_POST["apellidoP"];
                    $apellidoM = $_POST["apellidoM"];
                    $email = $_POST["nuevoEmail"];

                    $nombre = mb_strtoupper($nombre);
                    $apellidoP = mb_strtoupper($apellidoP);
                    $apellidoM = mb_strtoupper($apellidoM);
                    $email = mb_strtolower($email);

                    $nombre = trim($nombre);
                    $apellidoP = trim($apellidoP);
                    $apellidoM = trim($apellidoM);
                    $email = trim($email);

                    $datos = array(
                        "nombre" => $nombre,
                        "apellido_paterno" => $apellidoP,
                        "apellido_materno" => $apellidoM,
                        "nomina" => $_POST["nuevaNomina"],
                        "email" => $email,
                        "id_departamento" => $_POST["nuevoEmpleadoDepartamento"],
                        "id_puesto" => $_POST["nuevoEmpleadoPuesto"],
                    );

                    $respuesta = ModeloEmpleados::mdlIngresarEmpleados($tabla, $datos);

                    ControladorEmpleados::ctrCrearCredencialEmpleado();

                    if ($respuesta == "ok") {

                        echo '<script>
    
                        swal({
        
                           type: "success",
                           title: "El empleado ha sido ingresado exitosamente",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar",
                           closeOnConform: false
        
                            }).then((result)=>{
                                if (result.value) {
                                    window.location = "empleado";
                                }
                            });
        
                    </script>';
                    }
                } else {

                    echo '<script>
    
                swal({
    
                   type: "error",
                   title: "El número de nómina solo puede llevar caracteres numéricos",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "empleado";
                        }
                    });
    
            </script>';
                }
            } else {

                echo '<script>

            swal({

               type: "error",
               title: "El nombre del empleado y su email no pueden llevar caracteres especiales",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "empleado";
                    }
                });

        </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA CREAR CREDENCIALES
    ===================================================*/

    static public function ctrCrearCredencialEmpleado()
    {

        // Aquí vamos a crear un registro en la tabla de credenciales para el último empleado que acabamos de ingresar.

        $ultimoEmpleado = ModeloEmpleados::mdlMostrarEmpleadoParaCredencial();

        $tabla = "credencial";
        $datos = $ultimoEmpleado["id_empleado"];

        ModeloCredencial::mdlIngresarCredencial($tabla, $datos);
    }


    /* ==================================================
            MÉTODO PARA EDITAR EMPLEADOS
    ===================================================*/

    static public function ctrEditarEmpleados()
    {

        if (isset($_POST["editarNombre"])) {

            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                    if (preg_match('/^[0-9]+$/', $_POST["editarNomina"])) {

                        $tabla = "empleado";

                        $editarNombre = $_POST["editarNombre"];
                        $editarApellidoP = $_POST["editarApellidoP"];
                        $editarApellidoM = $_POST["editarApellidoM"];
                        $editarEmail = $_POST["editarEmail"];

                        $editarNombre = mb_strtoupper($editarNombre);
                        $editarApellidoP = mb_strtoupper($editarApellidoP);
                        $editarApellidoM = mb_strtoupper($editarApellidoM);
                        $editarEmail = mb_strtolower($editarEmail);

                        $editarNombre = trim($editarNombre);
                        $editarApellidoP = trim($editarApellidoP);
                        $editarApellidoM = trim($editarApellidoM);
                        $editarEmail = trim($editarEmail);

                        $datos = array(
                            "nombre" => $editarNombre,
                            "apellido_paterno" => $editarApellidoP,
                            "apellido_materno" => $editarApellidoM,
                            "id_empleado" => $_POST["idDelEmpleado"],
                            "nomina" => $_POST["editarNomina"],
                            "email" => $editarEmail,
                            "id_departamento" => $_POST["editarEmpleadoDepartamento"],
                            "id_puesto" => $_POST["editarEmpleadoPuesto"],
                        );

                        if ($datos["id_empleado"] != 1) {

                            $respuesta = ModeloEmpleados::mdlEditarEmpleados($tabla, $datos);

                            if ($respuesta == "ok") {

                                echo '<script>
    
                        swal({
        
                           type: "success",
                           title: "El empleado ha sido editado exitosamente",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar",
                           closeOnConform: false
        
                            }).then((result)=>{
                                if (result.value) {
                                    window.location = "empleado";
                                }
                            });
        
                    </script>';
                            }
                        } else {

                            echo '<script>
    
                swal({
    
                   type: "error",
                   title: "Este registro no se puede editar",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "empleado";
                        }
                    });
    
            </script>';
                        }
                    } else {

                        echo '<script>
    
                swal({
    
                   type: "error",
                   title: "El número de nómina solo puede llevar caracteres numéricos",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "empleado";
                        }
                    });
    
            </script>';
                    }
                } else {

                    echo '<script>

            swal({

               type: "error",
               title: "El nombre del empleado y su email no pueden llevar caracteres especiales",
               showConfirmButton: true,
               confirmButtonText: "Cerrar",
               closeOnConform: false

                }).then((result)=>{
                    if (result.value) {
                        window.location = "empleado";
                    }
                });

        </script>';
                }
            } else {

                echo '<script>

                swal({
    
                   type: "error",
                   title: "Actualmente no cuentas con los permisos para editar registros de empleados",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "empleado";
                        }
                    });
    
            </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR EMPLEADOS
    ===================================================*/

    static function ctrEliminarEmpleado()
    {

        if (isset($_GET["idEmpleado"])) {

            if ($_SESSION["perfil"] == "Administrador") {

                $tabla = "empleado";
                $datos = $_GET["idEmpleado"];

                if ($datos != 1) {

                    $tablaConsulta = "inventario";
                    $valor = "id_empleado";
                    $consultaActivos = ModeloInventario::mdlMostrarInventario($tablaConsulta, $valor, $datos);

                    if ($consultaActivos == false) {


                        $respuesta = ModeloEmpleados::mdlEliminarEmpleado($tabla, $datos);

                        if ($respuesta == "ok") {

                            echo '<script>

                                    swal({
                        
                                       type: "success",
                                       title: "El empleado ha sido eliminado exitosamente",
                                       showConfirmButton: true,
                                       confirmButtonText: "Cerrar",                
                                        }).then(function(result){
                                            if (result.value) {
                                                window.location = "empleado";
                                                }
                                            });

                             </script>';

                            $tabla = "credencial";
                            ModeloCredencial::mdlBorrarCredencial($tabla, $datos);
                        }
                    } else {

                        echo '<script>

                        swal({
                
                           type: "error",
                           title: "No puedes eliminar empleados que aún tengan activos asignados",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar",
                           closeOnConform: false
                
                            }).then((result)=>{
                                if (result.value) {
                                    window.location = "empleado";
                                }
                            });

                    </script>';
                    }
                } else {

                    echo '<script>

                            swal({
                    
                               type: "error",
                               title: "Este registro no se puede eliminar",
                               showConfirmButton: true,
                               confirmButtonText: "Cerrar",
                               closeOnConform: false
                    
                                }).then((result)=>{
                                    if (result.value) {
                                        window.location = "empleado";
                                    }
                                });

                        </script>';
                }
            } else {

                echo '<script>

                swal({
    
                   type: "error",
                   title: "Actualmente no cuentas con los permisos para eliminar registros de empleados",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false
    
                    }).then((result)=>{
                        if (result.value) {
                            window.location = "empleado";
                        }
                    });
    
            </script>';
            }
        }
    }
}
