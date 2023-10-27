<?php

require_once "conexion.php";

class ModeloLineas
{

    /* ======================================================================
            MÉTODO PARA MOSTRAR LOS TELEFONOS (CELULARES Y TELÉFONOS FIJOS)
    ========================================================================*/

    static public function mdlMostrarLineas($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo IN (4) AND visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }


    /* ======================================================================
            MÉTODO PARA VER SI UN TELEFONO YA ESTÁ ASIGNADO A UNA LÍNEA
    ========================================================================*/

    static public function mdlBuscarImeiRepetido($item, $valor)
    {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM inventario i JOIN lineas l ON i.id_inventario = l.id_inventario WHERE l.$item = :$item AND i.visible = 1");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        

        $stmt = null;
    }

    /* ======================================================================
        MÉTODO PARA MOSTRAR LOS TELEFONOS PARA ASIGNARLOS A UNA LÍNEA
    ========================================================================*/

    static public function mdlMostrarDispositivos($tabla, $item, $valor)
    {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_tipo = 4 AND visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        
        $stmt = null;
    }


    /* ======================================================================
            MÉTODO PARA MOSTRAR LOS TELEFONOS (CELULARES Y TELÉFONOS FIJOS)
    ========================================================================*/

    static public function mdlMostrarLineasEditar($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, inventario.serie FROM $tabla JOIN inventario ON $tabla.id_inventario = inventario.id_inventario WHERE $tabla.visible = 1 AND $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT $tabla.*, inventario.serie FROM $tabla JOIN inventario ON $tabla.id_inventario = inventario.id_inventario WHERE $tabla.visible = 1");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
               MÉTODO PARA REGISTRAR LÍNEAS
    ===================================================*/

    static public function mdlRegistrarLineas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (linea, contrato, centro_costos, limite, id_tipo_linea, id_inventario, id_empleado, detalles) VALUES (:linea, :contrato, :centro_costos, :limite, :id_tipo_linea, :id_inventario, :id_empleado, :detalles)");

        $stmt->bindParam(":linea", $datos["linea"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":centro_costos", $datos["centro_costos"], PDO::PARAM_STR);
        $stmt->bindParam(":limite", $datos["limite"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_linea", $datos["id_tipo_linea"], PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR LINEAS
    ===================================================*/

    static public function mdlEditarLineas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET linea = :linea, contrato = :contrato, centro_costos = :centro_costos, limite = :limite, id_tipo_linea = :id_tipo_linea, id_inventario = :id_inventario, id_empleado = :id_empleado, detalles = :detalles  WHERE id_linea = :id_linea");

        $stmt->bindParam(":linea", $datos["linea"], PDO::PARAM_STR);
        $stmt->bindParam(":contrato", $datos["contrato"], PDO::PARAM_STR);
        $stmt->bindParam(":centro_costos", $datos["centro_costos"], PDO::PARAM_STR);
        $stmt->bindParam(":limite", $datos["limite"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_linea", $datos["id_tipo_linea"], PDO::PARAM_STR);
        $stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
        $stmt->bindParam(":detalles", $datos["detalles"], PDO::PARAM_STR);
        $stmt->bindParam(":id_linea", $datos["id_linea"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR LINEAS
    ===================================================*/

    static public function mdlEliminarLineas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET visible = 0 WHERE linea = :linea");

        $stmt->bindParam(":linea", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }
}
