<?php

require_once "conexion.php";

class ModeloCredencial
{

    /* ==================================================
            MÉTODO PARA CREAR CREDENCIALES
    ===================================================*/

    static public function mdlIngresarCredencial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (credencial_intelisis, credencial_global, passcode, impresora, id_empleado) VALUES ('-', '-', '-', '-', :id_empleado)");

        $stmt->bindParam(":id_empleado", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA MOSTRAR CREDENCIALES
    ===================================================*/

    static public function mdlMostrarCredencial($tabla, $item, $valor)
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
            MÉTODO PARA EDITAR CREDENCIALES
    ===================================================*/

    static public function mdlEditarCredencial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET credencial_intelisis = :credencial_intelisis, contr_intelisis = :contr_intelisis, credencial_global = :credencial_global, contr_global = :contr_global, passcode = :passcode, impresora = :impresora, contr_impresora = :contr_impresora, contr_email = :contr_email WHERE id_credencial = :id_credencial");

        $stmt->bindParam(":credencial_intelisis", $datos["credencial_intelisis"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_intelisis", $datos["contr_intelisis"], PDO::PARAM_STR);
        $stmt->bindParam(":credencial_global", $datos["credencial_global"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_global", $datos["contr_global"], PDO::PARAM_STR);
        $stmt->bindParam(":passcode", $datos["passcode"], PDO::PARAM_STR);
        $stmt->bindParam(":impresora", $datos["impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_impresora", $datos["contr_impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_email", $datos["contr_email"], PDO::PARAM_STR);
        $stmt->bindParam(":id_credencial", $datos["id_credencial"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

        /* ================================================================
            MÉTODO PARA EDITAR CREDENCIALES COMO SI LAS HUBIERAS BORRADO
        =================================================================*/

    static public function mdlBorrarParcialmenteCredencial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET credencial_intelisis = :credencial_intelisis, contr_intelisis = :contr_intelisis, credencial_global = :credencial_global, contr_global = :contr_global, passcode = :passcode, impresora = :impresora, contr_impresora = :contr_impresora, contr_email = :contr_email WHERE id_credencial = :id_credencial");

        $stmt->bindParam(":credencial_intelisis", $datos["credencial_intelisis"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_intelisis", $datos["contr_intelisis"], PDO::PARAM_STR);
        $stmt->bindParam(":credencial_global", $datos["credencial_global"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_global", $datos["contr_global"], PDO::PARAM_STR);
        $stmt->bindParam(":passcode", $datos["passcode"], PDO::PARAM_STR);
        $stmt->bindParam(":impresora", $datos["impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_impresora", $datos["contr_impresora"], PDO::PARAM_STR);
        $stmt->bindParam(":contr_email", $datos["contr_email"], PDO::PARAM_STR);
        $stmt->bindParam(":id_credencial", $datos["id_credencial"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }


    /* ==================================================
            MÉTODO PARA ELIMINAR CREDENCIALES
    ===================================================*/

    static public function mdlBorrarCredencial($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_empleado = :id_empleado");

        $stmt->bindParam(":id_empleado", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }
}
