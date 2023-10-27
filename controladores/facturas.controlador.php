<?php

class ControladorFacturas
{

    /* ==================================================
            MÉTODO PARA SUBIR FACTURAS
    ===================================================*/

    static public function ctrSubirFactura()
    {

        if (isset($_POST["submitPDF"])) {
            $targetDir = "uploads/";
            $fileType = strtolower(pathinfo($_FILES["subirFacturaPDF"]["name"], PATHINFO_EXTENSION));
            $numero_factura = $_POST["numeroDeFactura"];

            // Generar un nombre de archivo único
            $randomNumber = rand(100000, 999999); // Genera un número aleatorio de 6 dígitos
            $uniqueFileName = $randomNumber . "_" . $_FILES["subirFacturaPDF"]["name"];
            $targetFile = $targetDir . $uniqueFileName;

            if (move_uploaded_file($_FILES["subirFacturaPDF"]["tmp_name"], $targetFile)) {

                $nombre_factura = $uniqueFileName; // Usar el nombre de archivo único
                $ruta_factura = $targetDir . $nombre_factura;
                $tabla = "facturas";

                $respuesta = ModeloFacturas::mdlSubirFactura($tabla, $numero_factura, $nombre_factura, $ruta_factura);

                if ($respuesta == "ok") {

                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡La factura ha sido subida correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "facturas";
                            }
                        })
                    </script>';
                } else {

                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La factura no ha sido subida correctamente a la base de datos!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "facturas";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Hubo un error subiendo el archivo al servidor!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "facturas";
                        }
                    })
                </script>';
            }
        }
    }
    /* ==================================================
            MÉTODO PARA MOSTRAR LAS FACTURAS
    ===================================================*/

    static public function ctrMostrarFacturas($item, $valor)
    {

        $tabla = "facturas";

        $respuesta = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor);

        return $respuesta;
    }

    /* ==================================================
            MÉTODO PARA EDITAR LAS FACTURAS
    ===================================================*/

    static public function ctrEditarFactura()
    {

        if (isset($_POST["submitPDFEdited"])) {
            $targetDir = "uploads/";
            $fileType = strtolower(pathinfo($_FILES["editarSubirFacturaPDF"]["name"], PATHINFO_EXTENSION));
            $numero_factura = $_POST["editarNumeroDeFactura"];
            $id_factura = $_POST["idFacturaEditar"];
            $facturaAunlinkear = $_POST["facturaUnlinkear"];

            // Generar un nombre de archivo único
            $randomNumber = rand(100000, 999999); // Genera un número aleatorio de 6 dígitos
            $uniqueFileName = $randomNumber . "_" . $_FILES["editarSubirFacturaPDF"]["name"];
            $targetFile = $targetDir . $uniqueFileName;

            if (move_uploaded_file($_FILES["editarSubirFacturaPDF"]["tmp_name"], $targetFile)) {

                $nombre_factura = $uniqueFileName; // Usar el nombre de archivo único
                $ruta_factura = $targetDir . $nombre_factura;
                $tabla = "facturas";

                $respuesta = ModeloFacturas::mdlEditarFactura($tabla, $id_factura, $numero_factura, $nombre_factura, $ruta_factura);

                if ($respuesta == "ok") {

                    unlink($facturaAunlinkear);

                    echo '<script>
                        swal({
                            type: "success",
                            title: "¡La factura ha sido editada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "facturas";
                            }
                        })
                    </script>';
                } else {

                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La factura no ha sido editada correctamente a la base de datos!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "facturas";
                            }
                        })
                    </script>';
                }
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "¡Hubo un error subiendo el archivo al servidor!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "facturas";
                        }
                    })
                </script>';
            }
        }
    }

    /* ==================================================
            MÉTODO PARA BORRAR LAS FACTURAS
    ===================================================*/

    static public function ctrBorrarFactura()
    {

        if (isset($_GET["idFactura"])) {

            $tabla = "facturas";
            $valor = $_GET["idFactura"];
            $item = "id_factura";

            $factura = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor);

            $respuesta = ModeloFacturas::mdlBorrarFactura($tabla, $valor);

            if ($respuesta == "ok"){

                unlink($factura["ruta_factura"]);

                echo '<script>

                    swal({

                        type: "success",
                        title: "La factura ha sido borrada exitosamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConform: false

                        }).then((result)=>{
                            if (result.value) {
                                window.location = "facturas";
                            }
                        });

                </script>';

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "La factura no ha sido borrada",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConform: false

                        }).then((result)=>{
                            if (result.value) {
                                window.location = "facturas";
                            }
                        });

                </script>';
            }
            
        }
    }
}
