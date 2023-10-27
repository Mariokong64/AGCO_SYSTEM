<?php

require_once "conexion.php";

class ModeloInventarioTelefonos
{

    /* ======================================================================
            MÉTODO PARA MOSTRAR LOS TELEFONOS (CELULARES Y TELÉFONOS FIJOS)
    ========================================================================*/

    static public function mdlMostrarInventarioTelefonos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo IN (4,5) AND visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR LOS CELULARES
    ===================================================*/

    static public function mdlMostrarInventarioCelulares($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo = 4 AND visible = 1");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA REGISTRAR TELEFONOS
    ===================================================*/

    static public function mdlRegistrarTelefonos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (serie, factura, id_tipo, id_marca, id_modelo, id_estatus, fecha_ingreso, fecha_vencimiento, numero_tel, imei, email_cel, contrato, mac_tel, detalles) VALUES (:serie, :factura, :id_tipo, :id_marca, :id_modelo, :id_estatus, :fecha_ingreso, :fecha_vencimiento, :numero_tel, :imei, :email_cel, :contrato, :mac_tel, :detalles)");

        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_tel", $datos["numero_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cel", $datos["email_cel"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":mac_tel", $datos["mac_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);

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

    static public function mdlEditarTelefonos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET serie = :serie, factura = :factura, id_tipo = :id_tipo, id_marca = :id_marca, id_modelo = :id_modelo, id_estatus = :id_estatus, fecha_ingreso = :fecha_ingreso, fecha_vencimiento = :fecha_vencimiento, id_ubicacion = :id_ubicacion, posicion = :posicion, id_estado = :id_estado, contrato = :contrato, numero_tel = :numero_tel, imei = :imei, email_cel = :email_cel, mac_tel = :mac_tel, detalles = :detalles WHERE id_inventario = :id_inventario");

        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":numero_tel", $datos["numero_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":imei", $datos["imei"], PDO::PARAM_STR);
        $stmt->bindParam(":email_cel", $datos["email_cel"], PDO::PARAM_STR);
        $stmt->bindParam(":mac_tel", $datos["mac_tel"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR TELEFONOS
    ===================================================*/

    static public function mdlEliminarTelefonos($tabla, $datos)
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
}
