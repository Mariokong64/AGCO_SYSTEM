<?php

require_once "conexion.php";

class ModeloUbicacion
{

    /* ==================================================
            MÉTODO PARA CREAR UBICACIONES
    ===================================================*/

    static public function mdlIngresarUbicacion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ubicacion) VALUES (:ubicacion)");

        $stmt->bindParam(":ubicacion", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR UBICACIONES
    ===================================================*/

    static public function mdlMostrarUbicaciones($tabla, $item, $valor)
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
            MÉTODO PARA EDITAR UBICACIONES
    ===================================================*/

    static public function mdlEditarUbicacion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ubicacion = :ubicacion WHERE id_ubicacion = :id_ubicacion");

        $stmt->bindParam(":ubicacion", $datos["ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_ubicacion", $datos["id_ubicacion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR UBICACIONES
    ===================================================*/

    static public function mdlBorrarUbicacion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_ubicacion = :id_ubicacion");

        $stmt->bindParam(":id_ubicacion", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
