<?php

require_once "conexion.php";

class ModeloUsoEstatusEstados
{

    /* ==================================================
            MÉTODO PARA MOSTRAR USOS
    ===================================================*/

    static public function mdlMostrarUsosEstatusEstados($tabla, $item, $valor)
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
}
