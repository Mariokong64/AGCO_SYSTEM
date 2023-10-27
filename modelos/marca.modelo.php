<?php

require_once "conexion.php";

class ModeloMarca
{

    /* ==================================================
            MÉTODO PARA CREAR MARCAS
    ===================================================*/

    static public function mdlIngresarMarca($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (marca) VALUES (:marca)");

        $stmt->bindParam(":marca", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR MARCAS
    ===================================================*/

    static public function mdlMostrarMarcas($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY marca ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR MARCAS
    ===================================================*/

    static public function mdlEditarMarca($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET marca = :marca WHERE id_marca = :id_marca");

        $stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
        $stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR MARCAS
    ===================================================*/

    static public function mdlBorrarMarca($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_marca = :id_marca");

        $stmt->bindParam(":id_marca", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
