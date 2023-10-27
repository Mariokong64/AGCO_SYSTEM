<?php

require_once "conexion.php";

class ModeloInventario
{

    /* ==========================================================
            MÉTODO PARA MOSTRAR ACTIVOS FIJOS QUE ESTÉN VISIBLES
    ============================================================*/

    static public function mdlMostrarInventario($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlMostrarInventarioHistorial($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
            
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==============================================================
        MÉTODO PARA MOSTRAR ACTIVOS FIJOS QUE NO ESTÁN ASIGNADOS
    ===============================================================*/

    static public function mdlMostrarInventarionNoAsignado($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE asignado = $valor AND visible = 1");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }

    /* ==================================================================================
        MÉTODO PARA MOSTRAR  CUANTOS ACTIVOS FIJOS LE PERTENECEN A UN EMPLEADO EN ESPECÍFICO
    ===================================================================================*/

    static public function mdlMostrarInventarioDeEmpleado($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        $resultado = $stmt->fetchColumn();

        $stmt = null;

        return $resultado;

        
    }

    /* ======================================================================
            MÉTODO PARA MOSTRAR ACTIVOS FIJOS DE UN EMPLEADO EN ESPECÍFICO
    =======================================================================*/

    static public function mdlMostrarActivosDeEmpleado($tabla, $item, $valor)
    {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        
        $stmt = null;
    }


    /* ===================================================================
            MÉTODO PARA MOSTRAR LOS DISPOSITIVOS RELACIONADOS A UNA LÍNEA
    =====================================================================*/

    static public function mdlMostrarDispositivoDeLineas($item, $valor)
    {

        $tabla = "inventario";

        if ($valor == 826) {


            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        }

        $stmt = null;
    }

    
    /* ==================================================
            MÉTODO PARA REGISTRAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlRegistrarAF($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (serie, factura,  id_tipo, id_marca, id_modelo, id_estatus, fecha_ingreso, fecha_vencimiento, detalles, numero_tel, imei, email_cel, contrato, mac_tel, ip, host_name) VALUES (:serie, :factura, :id_tipo, :id_marca, :id_modelo, :id_estatus, :fecha_ingreso, :fecha_vencimiento, :detalles, :numero_tel, :imei, :email_cel, :contrato, :mac_tel, :ip, :host_name)");

        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_tel", $datos["numero_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cel", $datos["email_cel"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":mac_tel", $datos["mac_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":ip", $datos["ip"], PDO::PARAM_STR);
        $stmt->bindParam(":host_name", $datos["host_name"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlEditarAF($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET serie = :serie, factura = :factura, id_tipo = :id_tipo, id_marca = :id_marca, id_modelo = :id_modelo, id_departamento = :id_departamento, id_ubicacion = :id_ubicacion, id_estatus = :id_estatus, id_estado = :id_estado, fecha_ingreso = :fecha_ingreso, fecha_vencimiento = :fecha_vencimiento, posicion = :posicion, detalles = :detalles, host_name = :host_name, numero_tel = :numero_tel, imei = :imei, email_cel = :email_cel, mac_tel = :mac_tel, contrato = :contrato, ip = :ip WHERE id_inventario = :id_inventario");

        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
        $stmt->bindParam(":host_name", $datos["host_name"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_tel", $datos["numero_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cel", $datos["email_cel"], PDO::PARAM_STR);
        $stmt->bindParam(":mac_tel", $datos["mac_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":ip", $datos["ip"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
            var_dump(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }



    /* ==================================================
    MÉTODO PARA EDITAR ACTIVOS FIJOS AL MOMENTO DE ASIGNAR
    ===================================================*/

    static public function mdlEditarActivosAsignados($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_empleado = :id_empleado, id_departamento = :id_departamento, asignado = 1, id_estado = 1, id_ubicacion = 3 WHERE id_inventario = :id_inventario");

        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlEliminarAF($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET visible = 0 WHERE serie = :serie");

        $stmt->bindParam(":serie", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ===========================================================
        METODO PARA ACTUALIZAR LOS REGISTROS AL HACER ASIGNACIONES
       ==========================================================*/

    static public function mdlActualizarActivos($tabla, $item1, $valor1, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id_inventario = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            //return "error";
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

            return;
        }

        $stmt = null;
    }

    /* ===========================================================
        METODO PARA ACTUALIZAR LOS REGISTROS AL DESASIGNAR ACTIVOS
       ==========================================================*/

       static public function mdlDesasignarInventario($tabla, $datos)
       {
   
           $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET asignado = 0, id_departamento = 1, id_ubicacion = 1, id_empleado = 1, posicion = 0, id_estado = :id_estado WHERE id_inventario = :id_inventario");
   
           $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
           $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
   
           if ($stmt->execute()) {
   
               return "ok";
           } else {
   
               //return "error";
               echo "\nPDO::errorInfo():\n";
               print_r(Conexion::conectar()->errorInfo());
   
               return;
           }
   
           $stmt = null;
       }
}
