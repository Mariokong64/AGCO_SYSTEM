<?php

require_once "conexion.php";

class ModeloModelo
{

    /* ==================================================
            MÉTODO PARA CREAR MODELOS
    ===================================================*/

    static public function mdlIngresarModelo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (modelo) VALUES (:modelo)");

        $stmt->bindParam(":modelo", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR MODELOS
    ===================================================*/

    static public function mdlMostrarModelos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY modelo ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR MODELOS
    ===================================================*/

    static public function mdlEditarModelo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET modelo = :modelo WHERE id_modelo = :id_modelo");

        $stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_modelo", $datos["id_modelo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR MODELOS
    ===================================================*/

    static public function mdlBorrarModelo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_modelo = :id_modelo");

        $stmt->bindParam(":id_modelo", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
