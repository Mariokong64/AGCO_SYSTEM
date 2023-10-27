<?php

require_once "conexion.php";

class ModeloHistorial{

    /* ============================================================================
            MÉTODO PARA MOSTRAR LOS MOVIEMIENTOS DE ASIGNACIONES Y DEVOLUCIONES
    =============================================================================*/

    static public function mdlMostrarMovimientos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }


    /* ==================================================
            MÉTODO PARA CREAR HISTORIAL DE MOVIMIENTOS
    ===================================================*/

    static public function mdlIngresarMovimiento($movimiento, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO movimiento (id_tipo_movimiento, id_inventario, id_usuario, id_empleado, id_motivo) VALUES (:id_tipo_movimiento, :id_inventario, :id_usuario, :id_empleado, :id_motivo)");

        $stmt->bindParam(":id_tipo_movimiento", $movimiento, PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
        $stmt->bindParam(":id_motivo", $datos["id_motivo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

       /* =======================================================
            MÉTODO PARA CREAR HISTORIAL DE CAMBIOS DE ESTADOS
        =======================================================*/

    static public function mdlIngresarEstado($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO historial_estado (id_inventario, id_usuario, id_estado_anterior, id_estado_posterior) VALUES (:id_inventario, :id_usuario, :id_estado_anterior, :id_estado_posterior)");

        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado_anterior", $datos["id_estado_anterior"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado_posterior", $datos["id_estado_posterior"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }

}