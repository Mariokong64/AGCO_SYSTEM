<?php

require_once "conexion.php";

class ModeloFacturas
{

    /* ==================================================
            MÉTODO PARA SUBIR FACTURAS
    ===================================================*/

    static public function mdlSubirFactura($tabla, $numero_factura, $nombre_factura, $ruta_factura)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numero_factura, nombre_factura, ruta_factura) VALUES (:numero_factura, :nombre_factura, :ruta_factura)");

        $stmt->bindParam(":numero_factura", $numero_factura, PDO::PARAM_STR);
        $stmt->bindParam(":nombre_factura", $nombre_factura, PDO::PARAM_STR);
        $stmt->bindParam(":ruta_factura", $ruta_factura, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR LAS FACTURAS
    ===================================================*/

    static public function mdlMostrarFacturas($tabla, $item, $valor)
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

    /* ==================================================
            MÉTODO PARA EDITAR LAS FACTURAS
    ===================================================*/

    static public function mdlEditarFactura($tabla, $id_factura, $numero_factura, $nombre_factura, $ruta_factura)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numero_factura = :numero_factura, nombre_factura = :nombre_factura, ruta_factura = :ruta_factura  WHERE id_factura = :id_factura");

        $stmt->bindParam(":id_factura", $id_factura, PDO::PARAM_STR);
        $stmt->bindParam(":numero_factura", $numero_factura, PDO::PARAM_STR);
        $stmt->bindParam(":nombre_factura", $nombre_factura, PDO::PARAM_STR);
        $stmt->bindParam(":ruta_factura", $ruta_factura, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR LAS FACTURAS
    ===================================================*/

    static public function mdlBorrarFactura($tabla, $valor)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_factura = :id_factura");

        $stmt->bindParam(":id_factura", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
