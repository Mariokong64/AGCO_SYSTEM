<?php

require_once "conexion.php";

class ModeloEmpleados
{

    /* ==================================================
            MÉTODO PARA MOSTRAR EMPLEADOS
    ===================================================*/

    static public function mdlMostrarEmpleados($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_empleado != 1 ORDER BY nombre ASC");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA INGRESAR EMPLEADOS
    ===================================================*/

    static public function mdlIngresarEmpleados($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido_paterno, apellido_materno, nomina, email, id_departamento, id_puesto) VALUES (:nombre, :apellido_paterno, :apellido_materno, :nomina, :email, :id_departamento, :id_puesto)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR);
        $stmt->bindParam(":nomina", $datos["nomina"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_puesto", $datos["id_puesto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA EDITAR EMPLEADOS
    ===================================================*/

    static public function mdlEditarEmpleados($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, nomina = :nomina, email = :email, id_departamento = :id_departamento, id_puesto = :id_puesto WHERE id_empleado = :id_empleado");

        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_paterno", $datos["apellido_paterno"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_materno", $datos["apellido_materno"], PDO::PARAM_STR);
        $stmt->bindParam(":nomina", $datos["nomina"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_puesto", $datos["id_puesto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* ==================================================
            MÉTODO PARA ELIMINAR EMPLEADOS
    ===================================================*/

    static public function mdlEliminarEmpleado($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_empleado = :id_empleado");

        $stmt->bindParam(":id_empleado", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());
        }

        $stmt = null;
    }

    /* =======================================================================
            MÉTODO PARA MOSTRAR AL ÚLTIMO EMPLEADO Y ASÍ ASIGNARLE UNAS CREDENCIALES
    =========================================================================*/

    static public function mdlMostrarEmpleadoParaCredencial()
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM empleado ORDER BY id_empleado DESC LIMIT 1;");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }
}
