<?php

class ControladorCredenciales
{

    /* ==================================================
            MÉTODO PARA INGRESAR CREDENCIALES
    ===================================================*/

    static public function ctrCrearCredenciales($datos)
    {

        $tabla = "credencial";

        $respuesta = ModeloCredencial::mdlIngresarCredencial($tabla, $datos);

        return $respuesta;
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR CREDENCIALES
    ===================================================*/

    static public function ctrMostrarCredenciales($item, $valor)
    {

        $tabla = "credencial";

        $respuesta = ModeloCredencial::mdlMostrarCredencial($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR CREDENCIALES
    ===================================================*/

    static public function ctrEditarCredenciales()
    {

        if (isset($_POST["idCredencial"])) {

            $idEmpleado = $_GET["idEmpleado"];
            $tabla = "credencial";
            $datos = array(
                "credencial_intelisis" => $_POST["editarIntelisis"],
                "contr_intelisis" => $_POST["ctrIntelisis"],
                "credencial_global" => $_POST["editarGlobal"],
                "contr_global" => $_POST["ctrGlobal"],
                "passcode" => $_POST["passcode"],
                "impresora" => $_POST["editarCredencialImpresora"],
                "contr_impresora" => $_POST["ctrImpresora"],
                "contr_email" => $_POST["ctremail"],
                "id_credencial" => $_POST["idCredencial"]
            );

            $respuesta = ModeloCredencial::mdlEditarCredencial($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                    swal({
    
                       type: "success",
                       title: "Las credenciales han sido editadas exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "index.php?ruta=credencialesEmpleado&idEmpleado=' . $idEmpleado . '";
                            }
                        });
    
                </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR PARCIALEMNTE LOS REGISTROS DE LAS CREDENCIALES
    ===================================================*/

    static public function ctrBorrarParcialmenteCredencial()
    {

        if (isset($_GET["idEliminarParcialmenteCredencial"])) {

            $idEmpleado = $_GET["idEmpleado"];
            $tabla = "credencial";
            $datos = array(
                "credencial_intelisis" => "-",
                "contr_intelisis" => "",
                "credencial_global" => "-",
                "contr_global" => "",
                "passcode" => "",
                "impresora" => "-",
                "contr_impresora" => "-",
                "contr_email" => "",
                "id_credencial" => $_GET["idEliminarParcialmenteCredencial"]
            );

            $respuesta = ModeloCredencial::mdlBorrarParcialmenteCredencial($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                    swal({
    
                       type: "success",
                       title: "Las credenciales han sido editadas exitosamente",
                       showConfirmButton: true,
                       confirmButtonText: "Cerrar",
                       closeOnConform: false
    
                        }).then((result)=>{
                            if (result.value) {
                                window.location = "index.php?ruta=credencialesEmpleado&idEmpleado=' . $idEmpleado . '";
                            }
                        });
    
                </script>';
            }
        }
    }



    /* ==================================================
            MÉTODO PARA BORRAR CREDENCIALES
    ===================================================*/

    static public function ctrBorrarCredenciales()
    {

        if (isset($_GET["idCredencial"])) {

            $tabla = "credencial";
            $datos = $_GET["idEliminarCredencial"];

            $respuesta = ModeloCredencial::mdlBorrarParcialmenteCredencial($tabla, $datos);

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
        }
    }
}
