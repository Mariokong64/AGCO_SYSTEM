<?php

require_once "conexion.php";

class ModeloHisotrialLineas
{

    /* ========================================================
      MÉTODO PARA EDITAR ACTIVOS FIJOS AL MOMENTO DE ASIGNAR
    =========================================================*/

    static public function mdlRegistralHistorialLinea($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_linea, id_inventario_anterior, id_inventario_posterior, id_empleado_anterior, id_empleado_posterior, id_usuario, cambio) VALUES (:id_linea, :id_inventario_anterior, :id_inventario_posterior, :id_empleado_anterior, :id_empleado_posterior, :id_usuario, :cambio)");

        $stmt->bindParam(":id_linea", $datos["id_linea"], PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario_anterior", $datos["id_inventario_anterior"], PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario_posterior", $datos["id_inventario_posterior"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado_anterior", $datos["id_empleado_anterior"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado_posterior", $datos["id_empleado_posterior"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }











}