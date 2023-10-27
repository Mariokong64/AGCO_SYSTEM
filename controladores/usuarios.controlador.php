<?php

class ControladorUsuarios
{

    /* ==================================================
            MÉTODO DE INGRESO DE USUARIOS
  ===================================================*/

    static public function ctrIngresoUsuario()
    {

        if (isset($_POST["ingUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ingPassword"])
            ) {

                /* AQUÍ DEBEMOS ENCRIPTAR DE MEJOR FORMA EL PASSWORD CUANDO DESCUBRA COMO HACERLO */
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuario";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                if (is_array($respuesta)) {

                    if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["contrasena"] == $encriptar /* $_POST["ingPassword"] */) {

                        if ($respuesta["estado_usuario"] == 1) {

                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id_usuario"] = $respuesta["id_usuario"];
                            $_SESSION["usuario"] = $respuesta["usuario"];
                            $_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
                            $_SESSION["perfil"] = $respuesta["perfil"];

                            /*Aquí registramos la hora del login en la base de datos */

                            date_default_timezone_set('America/Mexico_City');

                            $fecha = date('Y-m-d');
                            $hora = date('H:i:s');
                            $fechaActual = $fecha . ' ' . $hora;

                            $item1 = "ultimo_login";
                            $valor1 = $fechaActual;
                            $item2 = "id_usuario";
                            $valor2 = $respuesta["id_usuario"];

                            $utimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                            if ($utimoLogin == "ok") {

                                /* Aquí ya mandamos al usuario a la página de inicio */

                                echo '<script>

                                window.location = "inicio";
    
                                </script>';
                            }
                        } else {
                            echo '<br><div class="alert alert-danger">El usuario no está activado</div>';
                        }
                    } else {
                        echo '<br><div class="alert alert-danger">La contraseña no es correcta</div>';
                    }
                } else {
                    echo '<br><div class="alert alert-danger">El usuario no existe</div>';
                }
            }
        }
    }

    /* ==================================================
        MÉTODO PARA REGISTRAR USUARIO
     ===================================================*/

    static public function ctrCrearUsuario()
    {

        if (isset($_POST["nuevoUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoPassword"])
            ) {

                /* AQUÍ DEBEMOS ENCRIPTAR EL PASSWORD CUANDO DESCUBRA COMO HACERLO */
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuario";

                $datos = array(
                    "usuario" => $_POST["nuevoUsuario"],
                    "nombre_usuario" => $_POST["nuevoNombre"],
                    "contrasena" => $encriptar,
                    "perfil" => $_POST["nuevoPerfil"]
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                       type: "success",
                       title: "El usuario ha sido guardado correctamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false

                        }).then((result)=>{

                            if (result.value) {

                                window.location = "usuarios";
                        
                            }
                        });

                </script>';
                }
            } else {

                echo '<script>

                    swal({

                       type: "error",
                       title: "El nombre de usuario no puede ir vacío o llevar caracteres especiales ni espacios",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false

                        }).then((result)=>{

                            if (result.value) {

                                window.location = "usuarios";
                        
                            }
                        });

                </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR USUARIOS EN LA TABLA
    ===================================================*/

    static public function ctrMostrarUsuario($item, $valor)
    {

        $tabla = "usuario";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR USUARIOS
        ===================================================*/

    static public function ctrEditarUsuario()
    {

        if (isset($_POST["editarUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])
            ) {

                $tabla = "usuario";

                if ($_POST["editarPassword"] != "") {

                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarPassword"])) {

                        /* AQUÍ DEBEMOS ENCRIPTAR EL PASSWORD CUANDO DESCUBRA COMO HACERLO */
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {

                        echo '<script>

                            swal({
        
                               type: "error",
                               title: "La contraseña no puede ir vacía o llevar caracteres especiales",
                               showConfirmButton: true,
                               confirmButtonText: "Cerrar",
                               closeOnConform: false
        
                                }).then((result)=>{
        
                                    if (result.value) {
        
                                        window.location = "usuarios";
                                
                                    }
                                });
        
                        </script>';
                        return;
                    }
                } else {

                    /* AQUÍ DEBEMOS ENCRIPTAR EL PASSWORD CUANDO DESCUBRA COMO HACERLO */
                }

                if ($_POST["editarPassword"] == "") {

                    $datos = array(
                        "usuario" => $_POST["editarUsuario"],
                        "nombre_usuario" => $_POST["editarNombre"],
                        "contrasena" => $_POST["passwordActual"],
                        "perfil" => $_POST["editarPerfil"]
                    );
                } else {

                    $datos = array(
                        "usuario" => $_POST["editarUsuario"],
                        "nombre_usuario" => $_POST["editarNombre"],
                        "contrasena" => $encriptar,
                        "perfil" => $_POST["editarPerfil"]
                    );
                }

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                       type: "success",
                       title: "El usuario ha sido editado correctamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false

                        }).then((result)=>{

                            if (result.value) {

                                window.location = "usuarios";
                        
                            }
                        });

                </script>';
                }
            } else {

                echo '<script>

                    swal({

                       type: "error",
                       title: "El usuario no puede ir vacío o llevar caracteres especiales",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false

                        }).then((result)=>{

                            if (result.value) {

                                window.location = "usuarios";
                        
                            }
                        });

                </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR USUARIOS
    ===================================================*/

    static public function ctrBorrarUsuario()
    {

        if (isset($_GET["idUsuario"])) {

            $tabla = "usuario";
            $datos = $_GET["idUsuario"];

            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({

                   type: "success",
                   title: "El usuario ha sido eliminado correctamente",
                   showConfirmButton: true,
                   confirmButtonText: "Cerrar",
                   closeOnConform: false

                    }).then((result)=>{

                        if (result.value) {

                            window.location = "usuarios";
                    
                        }
                    });

            </script>';
            }
        }
    }

        /* ====================================================================================
            MÉTODO PARA MOSTRAR EL PERFIL DEL USUARIO QUE ESTÁ UTILIZANDO EL SISTEMA
        =====================================================================================*/

        static public function ctrMostrarPerfilUsuario()
        {
    
            $respuesta = $_SESSION["perfil"];    
            return $respuesta;
        }
}
