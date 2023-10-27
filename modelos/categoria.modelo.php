<?php

require_once "conexion.php";

class ModeloCategoria
{

    /* ==================================================
            MÉTODO PARA CREAR CATEGORÍAS
    ===================================================*/

    static public function mdlIngresarCategoria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (tipo) VALUES (:categoria)");

        $stmt->bindParam(":categoria", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR CATEGORÍAS
    ===================================================*/

    static public function mdlMostrarCategorias($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY tipo ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR CATEGORÍAS
    ===================================================*/

    static public function mdlEditarCategoria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo = :tipo WHERE id_tipo = :id_tipo");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR CATEGORÍAS
    ===================================================*/

    static public function mdlBorrarCategoria($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_tipo = :id_tipo");

        $stmt->bindParam(":id_tipo", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
