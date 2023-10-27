<?php

require_once "conexion.php";

class ModeloInventarioImpresora
{

    /* ==================================================
            MÉTODO PARA MOSTRAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlMostrarInventarioImpresora($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo = 3 AND visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA REGISTRAR IMPRESORAS
    ===================================================*/

    static public function mdlRegistrarImpresora($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (serie, factura, id_tipo, id_marca, id_modelo, id_estatus, fecha_ingreso, fecha_vencimiento, detalles, ip) VALUES (:serie, :factura, :id_tipo, :id_marca, :id_modelo, :id_estatus, :fecha_ingreso, :fecha_vencimiento, :detalles, :ip)");

        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
        $stmt->bindParam(":ip", $datos["ip"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR IMPRESORAS
    ===================================================*/

    static public function mdlEditarImpresora($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET serie = :serie, factura = :factura, id_tipo = :id_tipo, id_marca = :id_marca, id_modelo = :id_modelo, id_estatus = :id_estatus, fecha_ingreso = :fecha_ingreso, fecha_vencimiento = :fecha_vencimiento, id_ubicacion = :id_ubicacion, ip = :ip,  id_estado = :id_estado, detalles = :detalles WHERE id_inventario = :id_inventario AND visible = 1");

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
        $stmt->bindParam(":ip", $datos["ip"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
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
            MÉTODO PARA ELIMINAR IMPRESORAS
    ===================================================*/

    static public function mdlEliminarImpresora($tabla, $datos)
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
