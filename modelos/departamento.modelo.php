<?php

require_once "conexion.php";

class ModeloDepartamento
{

    /* ==================================================
            MÉTODO PARA CREAR DEPARTAMENTOS
    ===================================================*/

    static public function mdlIngresarDepartamento($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (departamento, centro_costos) VALUES (:departamento, :centro_costos)");

        $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":centro_costos", $datos["centro_costos"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR DEPARTAMENTOS
    ===================================================*/

    static public function mdlMostrarDepartamentos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY departamento ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR DEPARTAMENTOS
    ===================================================*/

    static public function mdlEditarDepartamento($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET departamento = :departamento, centro_costos = :centro_costos WHERE id_departamento = :id_departamento");

        $stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":centro_costos", $datos["centro_costos"], PDO::PARAM_STR);
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
            MÉTODO PARA ELIMINAR DEPARTAMENTOS
    ===================================================*/

    static public function mdlBorrarDepartamento($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_departamento = :id_departamento");

        $stmt->bindParam(":id_departamento", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
