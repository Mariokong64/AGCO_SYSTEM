<?php

require_once "conexion.php";

class ModeloInventarioPC
{

    /* ==================================================
            MÉTODO PARA MOSTRAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlMostrarInventarioPC($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo IN (1,2) AND visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA REGISTRAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlRegistrarPC($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (serie, factura,  id_tipo, id_marca, id_modelo, id_estatus, fecha_ingreso, fecha_vencimiento, detalles, host_name) VALUES (:serie, :factura, :id_tipo, :id_marca, :id_modelo, :id_estatus, :fecha_ingreso, :fecha_vencimiento, :detalles, :host_name)");

        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
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

    static public function mdlEditarPC($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET serie = :serie, factura = :factura, id_tipo = :id_tipo, id_marca = :id_marca, id_modelo = :id_modelo, id_estatus = :id_estatus, fecha_ingreso = :fecha_ingreso, fecha_vencimiento = :fecha_vencimiento, id_ubicacion = :id_ubicacion,  id_estado = :id_estado, posicion = :posicion, host_name = :host_name, detalles = :detalles WHERE id_inventario = :id_inventario");

        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":serie", $datos["serie"], PDO::PARAM_STR);
        $stmt->bindParam(":factura", $datos["factura"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estatus", $datos["id_estatus"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
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
            MÉTODO PARA ELIMINAR ACTIVOS FIJOS
    ===================================================*/

    static public function mdlEliminarPC($tabla, $datos)
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
