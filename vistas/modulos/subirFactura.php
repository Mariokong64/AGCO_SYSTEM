<?php

if(isset($_POST["submitPDF"])){

    $targetDir = "../../uploads/";
    $targetFile = $targetDir . basename($_FILES["subirFacturaPDF"]["name"]);
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    $numero_Factura = $_POST["numeroDeFactura"];

    if(move_uploaded_file($_FILES["subirFacturaPDF"]["tmp_name"], $targetFile)){

        $nombreFactura = $_FILES["subirFacturaPDF"]["name"];
        $ruta_factura = $targetDir;
        $tabla = "facturas";

     $respuesta = ModeloFacturas::mdlSubirFactura($tabla, $numero_Factura, $nombre_factura, $ruta_factura);

        if($respuesta == "ok"){

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
        }

        else{

            echo '<script>

                swal({
                    type: "error",
                    title: "¡La factura no ha sido subida correctamente!",
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

        echo "Lo sentimos, hubo un error subiendo tu archivo.";
    }
}
