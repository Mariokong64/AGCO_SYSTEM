<?php

require_once "conexion.php";

class ModeloMotivo
{

    /* ==================================================
            MÉTODO PARA MOSTRAR MOTIVOS
    ===================================================*/

    static public function mdlMostrarMotivos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY motivo ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

}
