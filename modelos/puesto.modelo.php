<?php

require_once "conexion.php";

class ModeloPuesto
{

    /* ==================================================
            MÉTODO PARA CREAR PUESTOS
    ===================================================*/

    static public function mdlIngresarPuesto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (puesto) VALUES (:puesto)");

        $stmt->bindParam(":puesto", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR PUESTOS
    ===================================================*/

    static public function mdlMostrarPuestos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY puesto ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR PUESTOS
    ===================================================*/

    static public function mdlEditarPuesto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET puesto = :puesto WHERE id_puesto = :id_puesto");

        $stmt->bindParam(":puesto", $datos["puesto"], PDO::PARAM_STR);
        $stmt->bindParam(":id_puesto", $datos["id_puesto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR PUESTO
    ===================================================*/

    static public function mdlBorrarPuesto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_puesto = :id_puesto");

        $stmt->bindParam(":id_puesto", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
