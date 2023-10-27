<?php

/* ------------------------------------------------------------------------------------------------------------------------------
EN ESTE ARCHIVO ES PARA HACER LOS REPORTES DE EXCEL CON PURO PHP, PERO YA NO SE USA. SOLO QUE LO VOY A DEJAR POR CUALQUIER COSA
------------------------------------------------------------------------------------------------------------------------------- */

class ControladorReportes
{

    public $AFseries;

    /*--------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DE TELEFONOS
    --------------------------------------------------------------------*/

    public function ctrDescargarReporteTelefonos()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de telefonos

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>

            <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
            <td style='font-weight:bold; border:1px solid #000000;'>TIPO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
            <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>ASIGNADO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
            <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO</td>
            <td style='font-weight:bold; border:1px solid #000000;'># DE TELÉFONO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>IMEI</td>
            <td style='font-weight:bold; border:1px solid #000000;'>EMAIL REGISTRADO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>CONTRATO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>MAC</td>
            <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>

            </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "inventario" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $PCs = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos el tipo de la tabla tipos
            $valor = $PCs["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $tipo = $tipos["tipo"];

            // Obtenemos la marca de la tabla marcas
            $valor = $PCs["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $PCs["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }

            // Obtenemos el estado de la tabla estados
            $valor = $PCs["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Obtenemos el estado de la tabla de departamentos
            $valor = $PCs["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
            $departamento = $departamentos["departamento"];

            // Obtenemos la ubicación de la tabla de ubicaciones
            $valor = $PCs["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $valor);
            $ubicacion = $ubicaciones["ubicacion"];

            // Obtenemos el empleado de la tabla de empleados
            $valor = $PCs["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];
            $apellidoP = $empleados["apellido_paterno"];
            $apellidoM = $empleados["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;

            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($PCs["asignado"] == 1) {
                $asignado = "SI";
            } else {
                $asignado = "NO";
            }

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $PCs["serie"] . "</td>
                <td style='border:1px solid #000000;'>" . $tipo . "</td>
                <td style='border:1px solid #000000;'>" . $marca . "</td>
                <td style='border:1px solid #000000;'>" . $modelo . "</td>
                <td style='border:1px solid #000000;'>" . $estado . "</td>
                <td style='border:1px solid #000000;'>" . $asignado . "</td>
                <td style='border:1px solid #000000;'>" . $departamento . "</td>
                <td style='border:1px solid #000000;'>" . $ubicacion . "</td>
                <td style='border:1px solid #000000;'>" . $empleado . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["numero_tel"] . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["imei"] . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["email_cel"] . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["contrato"] . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["mac_tel"] . "</td>
                <td style='border:1px solid #000000;'>" . $PCs["detalles"] . "</td>

                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    /*--------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DE IMPRESORAS
    --------------------------------------------------------------------*/

    public function ctrDescargarReporteImpresoras()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de telefonos

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>

        <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
        <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
        <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
        <td style='font-weight:bold; border:1px solid #000000;'>ESTATUS</td>
        <td style='font-weight:bold; border:1px solid #000000;'>IP</td>
        <td style='font-weight:bold; border:1px solid #000000;'>FECHA DE ADQUISICIÓN</td>
        <td style='font-weight:bold; border:1px solid #000000;'>FECHA DE VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>

        </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "inventario" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $impresoras = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos la marca de la tabla marcas
            $valor = $impresoras["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $impresoras["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }

            // Obtenemos el estado de la tabla estados
            $valor = $impresoras["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Obtenemos el estado de la tabla de departamentos
            $valor = $impresoras["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
            $departamento = $departamentos["departamento"];

            // Obtenemos la ubicación de la tabla de ubicaciones
            $valor = $impresoras["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $valor);
            $ubicacion = $ubicaciones["ubicacion"];

            // Obtenemos el estatus de la tabla de estatus
            $valor = $impresoras["id_estatus"];
            $estatus = ControladorUsoEstatusEstados::ctrMostrarEstatus("id_estatus", $valor);
            $estatus = $estatus["estatus"];

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $impresoras["serie"] . "</td>
            <td style='border:1px solid #000000;'>" . $modelo . "</td>
            <td style='border:1px solid #000000;'>" . $marca . "</td>
            <td style='border:1px solid #000000;'>" . $estado . "</td>
            <td style='border:1px solid #000000;'>" . $departamento . "</td>
            <td style='border:1px solid #000000;'>" . $ubicacion . "</td>
            <td style='border:1px solid #000000;'>" . $estatus . "</td>
            <td style='border:1px solid #000000;'>" . $impresoras["ip"] . "</td>
            <td style='border:1px solid #000000;'>" . $impresoras["fecha_ingreso"] . "</td>
            <td style='border:1px solid #000000;'>" . $impresoras["fecha_vencimiento"] . "</td>
            <td style='border:1px solid #000000;'>" . $impresoras["detalles"] . "</td>

            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    /*--------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DE COMPUTADORAS
    --------------------------------------------------------------------*/

    public function ctrDescargarReporteComputadoras()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
        
                <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>TIPO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ASIGNADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTATUS</td>
                <td style='font-weight:bold; border:1px solid #000000;'>HOSTNAME</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>
        
                </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "inventario" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $computadoras = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos la marca de la tabla marcas
            $valor = $computadoras["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $computadoras["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }

            // Obtenemos el tipo de la tabla tipos
            $valor = $computadoras["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $tipo = $tipos["tipo"];

            // Obtenemos el estado de la tabla estados
            $valor = $computadoras["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Obtenemos el estado de la tabla de departamentos
            $valor = $computadoras["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
            $departamento = $departamentos["departamento"];

            // Obtenemos la ubicación de la tabla de ubicaciones
            $valor = $computadoras["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $valor);
            $ubicacion = $ubicaciones["ubicacion"];

            // Obtenemos el empleado de la tabla de empleados
            $valor = $computadoras["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];
            $apellidoP = $empleados["apellido_paterno"];
            $apellidoM = $empleados["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;

            // Obtenemos el estatus de la tabla de estatus
            $valor = $computadoras["id_estatus"];
            $estatus = ControladorUsoEstatusEstados::ctrMostrarEstatus("id_estatus", $valor);
            $estatus = $estatus["estatus"];

            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($computadoras["asignado"] == 1) {
                $asignado = "SI";
            } else {
                $asignado = "NO";
            }

            echo "<tr>

                <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $computadoras["serie"] . "</td>
                <td style='border:1px solid #000000;'>" . $modelo . "</td>
                <td style='border:1px solid #000000;'>" . $marca . "</td>
                <td style='border:1px solid #000000;'>" . $tipo . "</td>
                <td style='border:1px solid #000000;'>" . $estado . "</td>
                <td style='border:1px solid #000000;'>" . $asignado . "</td>
                <td style='border:1px solid #000000;'>" . $departamento . "</td>
                <td style='border:1px solid #000000;'>" . $ubicacion . "</td>
                <td style='border:1px solid #000000;'>" . $empleado . "</td>
                <td style='border:1px solid #000000;'>" . $estatus . "</td>
                <td style='border:1px solid #000000;'>" . $computadoras["host_name"] . "</td>
                <td style='border:1px solid #000000;'>" . $computadoras["detalles"] . "</td>

                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DEL INVENTARIO GENERAL
    -------------------------------------------------------------------------------*/

    public function ctrDescargarReporteGeneral()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
        
                <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
                <td style='font-weight:bold; border:1px solid #000000;'>TIPO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ASIGNADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>NÓMINA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>
        
                </tr>";

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $AFs = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos la marca de la tabla marcas
            $valor = $AFs["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $AFs["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }
            // Obtenemos el tipo de la tabla tipos
            $valor = $AFs["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $tipo = $tipos["tipo"];

            // Obtenemos el estado de la tabla estados
            $valor = $AFs["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Obtenemos el estado de la tabla de departamentos
            $valor = $AFs["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
            $departamento = $departamentos["departamento"];

            // Obtenemos la ubicación de la tabla de ubicaciones
            $valor = $AFs["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $valor);
            $ubicacion = $ubicaciones["ubicacion"];

            // Obtenemos el empleado de la tabla de empleados
            $valor = $AFs["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];
            $apellidoP = $empleados["apellido_paterno"];
            $apellidoM = $empleados["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;
            $nomina = $empleados["nomina"];

            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($AFs["asignado"] == 1) {
                $asignado = "SI";
            } else {
                $asignado = "NO";
            }

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $AFs["serie"] . "</td>
            <td style='border:1px solid #000000;'>" . $tipo . "</td>
            <td style='border:1px solid #000000;'>" . $marca . "</td>
            <td style='border:1px solid #000000;'>" . $modelo . "</td>
            <td style='border:1px solid #000000;'>" . $asignado . "</td>
            <td style='border:1px solid #000000;'>" . $estado . "</td>
            <td style='border:1px solid #000000;'>" . $departamento . "</td>
            <td style='border:1px solid #000000;'>" . $ubicacion . "</td>
            <td style='border:1px solid #000000;'>" . $empleado . "</td>
            <td style='border:1px solid #000000;'>" . $nomina . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["detalles"] . "</td>

            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DEL INVENTARIO COMPLETO
    -------------------------------------------------------------------------------*/

    public function ctrDescargarReporteCompleto()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
        
                <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
                <td style='font-weight:bold; border:1px solid #000000;'>TIPO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ASIGNADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>POSICIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>NÓMINA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>USO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTATUS</td>
                <td style='font-weight:bold; border:1px solid #000000;'># DE FACTURA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>HOSTNAME (Computadoras)</td>
                <td style='font-weight:bold; border:1px solid #000000;'># DE TELÉFONO (teléfonos)</td>
                <td style='font-weight:bold; border:1px solid #000000;'>IMEI (teléfonos)</td>
                <td style='font-weight:bold; border:1px solid #000000;'>EMAIL (teléfonos)</td>
                <td style='font-weight:bold; border:1px solid #000000;'># DE CONTRATO (teléfonos)</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MAC (teléfonos)</td>
                <td style='font-weight:bold; border:1px solid #000000;'>IP (impresoras)</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA DE ADQUISICIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA DE VENCIMIENTO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA DE REGISTRO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>
        
                </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "inventario" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $AFs = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos la marca de la tabla marcas
            $valor = $AFs["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            $marca = $marcas["marca"];

            // Obtenemos el modelo de la tabla modelos
            $valor = $AFs["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }

            // Obtenemos el tipo de la tabla tipos
            $valor = $AFs["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $tipo = $tipos["tipo"];

            // Obtenemos el estado de la tabla estados
            $valor = $AFs["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Obtenemos el estado de la tabla de departamentos
            $valor = $AFs["id_departamento"];
            $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
            $departamento = $departamentos["departamento"];

            // Obtenemos la ubicación de la tabla de ubicaciones
            $valor = $AFs["id_ubicacion"];
            $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones("id_ubicacion", $valor);
            $ubicacion = $ubicaciones["ubicacion"];

            // Obtenemos el empleado de la tabla de empleados
            $valor = $AFs["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];
            $apellidoP = $empleados["apellido_paterno"];
            $apellidoM = $empleados["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;
            $nomina = $empleados["nomina"];

            // Obtenemos el uso de la tabla de usos
            $valor = $AFs["id_uso"];
            $usos = ControladorUsoEstatusEstados::ctrMostrarUsos("id_uso", $valor);
            $uso = $usos["uso"];

            // Obtenemos el estatus de la tabla de estatus
            $valor = $AFs["id_estatus"];
            $estatuses = ControladorUsoEstatusEstados::ctrMostrarEstatus("id_estatus", $valor);
            $estatus = $estatuses["estatus"];


            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($AFs["asignado"] == 1) {
                $asignado = "SI";
            } else {
                $asignado = "NO";
            }

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $AFs["serie"] . "</td>
            <td style='border:1px solid #000000;'>" . $tipo . "</td>
            <td style='border:1px solid #000000;'>" . $marca . "</td>
            <td style='border:1px solid #000000;'>" . $modelo . "</td>
            <td style='border:1px solid #000000;'>" . $asignado . "</td>
            <td style='border:1px solid #000000;'>" . $estado . "</td>
            <td style='border:1px solid #000000;'>" . $departamento . "</td>
            <td style='border:1px solid #000000;'>" . $ubicacion . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["posicion"] . "</td>
            <td style='border:1px solid #000000;'>" . $empleado . "</td>
            <td style='border:1px solid #000000;'>" . $nomina . "</td>
            <td style='border:1px solid #000000;'>" . $uso . "</td>
            <td style='border:1px solid #000000;'>" . $estatus . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["factura"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["host_name"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["numero_tel"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["imei"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["email_cel"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["contrato"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["mac_tel"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["ip"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["fecha_ingreso"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["fecha_vencimiento"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["fecha_registro"] . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["detalles"] . "</td>

            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LOS EMPLEADOS
    -------------------------------------------------------------------------------*/

    public function ctrDescargarReporteEmpleados()
    {

        $tabla = "empleado";
        $item = "nomina";
        $nomina = $this->AFseries;
        $nomina = explode(",", $nomina);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
    
            <td style='font-weight:bold; border:1px solid #000000;'>NOMBRE</td>
            <td style='font-weight:bold; border:1px solid #000000;'>APELLIDO PATERNO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>APELLIDO MATERNO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>PUESTO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>CENTRO DE COSTOS</td>
            <td style='font-weight:bold; border:1px solid #000000;'>EMAIL DEL EMPLEADO</td>
            <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO DE NÓMINA</td>
            <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO DE ACTIVOS SIGNADOS</td>
    
            </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "empleado" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($nomina); $i++) {

            $valor = $nomina[$i];

            if ($valor == "SIN EMPLEADO ESPECIFICO") {
                continue;
            }

            $empleados = ModeloEmpleados::mdlMostrarEmpleados($tabla, $item, $valor);

            //Aqui nos saltamos el registro que se llama "NO ASIGNADO" para que no aparezca en el reporte
            if ($empleados["nombre"] == "NO ASIGNADO") {
                continue;
            }

            // Obtenemos el estado de la tabla de departamentos
            if ($empleados["id_departamento"] != null) {
                $valor = $empleados["id_departamento"];
                $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos("id_departamento", $valor);
                $departamento = $departamentos["departamento"];
                $cc = $departamentos["centro_costos"];
            } else {
                $departamento = "No Aplica";
                $cc = 0;
            }

            if ($empleados["id_puesto"] != null) {
                // Obtenemos el puesto de la tabla de puestos
                $valor = $empleados["id_puesto"];
                $puestos = ControladorPuestos::ctrMostrarPuestos("id_puesto", $valor);
                $puesto = $puestos["puesto"];
            } else {
                $puesto = "No Aplica";
            }

            // Aquí hacemos la consulta a la tabla de inventario para ver cuantos activos salen asignados a este empleado
            $valor = $empleados["id_empleado"];
            $activos = ControladorInventario::ctrMostrarAFdeEmpleado("id_empleado", $valor);
            $numeroActivos = $activos;

            echo "<tr>

            <td style='border:1px solid #000000;'>" . $empleados["nombre"] . "</td>
            <td style='border:1px solid #000000;'>" . $empleados["apellido_paterno"] . "</td>
            <td style='border:1px solid #000000;'>" . $empleados["apellido_materno"] . "</td>
            <td style='border:1px solid #000000;'>" . $puesto . "</td>            
            <td style='border:1px solid #000000;'>" . $departamento . "</td>
            <td style='border:1px solid #000000;'>" . $cc . "</td>
            <td style='border:1px solid #000000;'>" . $empleados["email"] . "</td>
            <td style='border:1px solid #000000;'>" . $empleados["nomina"] . "</td>
            <td style='border:1px solid #000000;'>" . $numeroActivos . "</td>
            
            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LOS PUESTOS DE TRABAJO
    -------------------------------------------------------------------------------*/

    public function ctrDescargarReportePuestos()
    {

        $item = null;
        $valor = null;

        $puestos = ControladorPuestos::ctrMostrarPuestos($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>PUESTO DE TRABAJO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($puestos); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $puestos[$i]["puesto"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LAS CATEGORIAS DE ACTIVOS FIJOS
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteCategorias()
    {

        $item = null;
        $valor = null;

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>CATEGORÍA DE ACTIVO FIJO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($categorias); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $categorias[$i]["tipo"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LAS MARCAS DE ACTIVOS FIJOS
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteMarcas()
    {

        $item = null;
        $valor = null;

        $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>MARCA DE ACTIVO FIJO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($marcas); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $marcas[$i]["marca"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LOS MODELOS DE ACTIVOS FIJOS
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteModelos()
    {

        $item = null;
        $valor = null;

        $modelos = ControladorModelos::ctrMostrarModelos($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>MODELO DE ACTIVO FIJO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($modelos); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $modelos[$i]["modelo"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL REPORTE DE LOS DEPARTAMENTOS
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteDepartamentos()
    {

        $item = null;
        $valor = null;

        $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>DEPARTAMENTO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($departamentos); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $departamentos[$i]["departamento"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LAS UBICACIONES
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteUbicaciones()
    {

        $item = null;
        $valor = null;

        $ubicaciones = ControladorUbicaciones::ctrMostrarUbicaciones($item, $valor);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>NÚMERO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>UBICACIÓN</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($ubicaciones); $i++) {

            echo "<tr>

                <td style='border:1px solid #000000;'>" . ($i + 1) . "</td>
                <td style='border:1px solid #000000;'>" . $ubicaciones[$i]["ubicacion"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL HISTORIAL DE ASIGNACIONES Y DEVOLUCIONES
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteHistorial()
    {

        $item = "fecha";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>MOVIMIENTO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>SERIE DEL ACTIVO FIJO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>TIPO DEL ACTIVO FIJO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>USUARIO QUE HIZO EL MOVIMIENTO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>FECHA DEL MOVIMIENTO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $registros = ControladorHistorialMovimientos::ctrMostrarMovimientos($item, $valor);

            //Aquí asignamos que tipo de movimiento es segun el id, de esta forma no tenemos que hacer la consulta a la tabla de movimientos

            switch ($registros["id_tipo_movimiento"]) {
                case 1:
                    $tipoMovimiento = "ASIGNACIÓN";
                    break;
                case 2:
                    $tipoMovimiento = "DEVOLUCIÓN";
                    break;
                default:
                    $tipoMovimiento = 'NA';
                    break;
            }

            // Aquí hacemos la consulta a la tabla de inventario para sacar la serie y el tipo de activo fijo que se asignó o se dio de baja

            $valor = $registros["id_inventario"];
            $activos = ControladorInventario::ctrMostrarAF("id_inventario", $valor);
            $serie = $activos["serie"];
            $tipo = $activos["id_tipo"];

            // Obtenemos el tipo de la tabla tipos
            $valor = $tipo;
            $categorias = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $categoria = $categorias["tipo"];

            //Aqui hacemos la consulta a la tabla de empleados para obtener el nombre del empleado
            $valor = $registros["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];

            // Aquí hacemos la consulta a la tabla de usuarios para sacar el nombre del usuario que hizo el movimiento
            $valor = $registros["id_usuario"];
            $usuarios = ControladorUsuarios::ctrMostrarUsuario("id_usuario", $valor);
            $usuario = $usuarios["usuario"];

            echo "<tr>

                <td style='border:1px solid #000000;'>" . $tipoMovimiento . "</td>
                <td style='border:1px solid #000000;'>" . $serie . "</td>
                <td style='border:1px solid #000000;'>" . $categoria . "</td>
                <td style='border:1px solid #000000;'>" . $nombre . "</td>
                <td style='border:1px solid #000000;'>" . $usuario . "</td>
                <td style='border:1px solid #000000;'>" . $registros["fecha"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }


    /*--------------------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR EL HISTORIAL DE CAMBIOS DE ESTADOS
    ----------------------------------------------------------------------------------------*/

    public function ctrDescargarReporteHistorialEstados()
    {

        $item = "fecha";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
      
              <td style='font-weight:bold; border:1px solid #000000;'>SERIE DEL ACTIVO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>TIPO DEL ACTIVO FIJO</td>
              <td style='font-weight:bold; border:1px solid #000000;'>ESTADO ANTERIOR</td>
              <td style='font-weight:bold; border:1px solid #000000;'>ESTADO POSTERIOR</td>
              <td style='font-weight:bold; border:1px solid #000000;'>REALIZÓ</td>
              <td style='font-weight:bold; border:1px solid #000000;'>FECHA DEL CAMBIO</td>
      
              </tr>";

        // Aquí vamos a imprimir los datos obtenidos de la tabla "puesto"

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $registros = ControladorHistorialMovimientos::ctrMostrarHistorialEstado($item, $valor);

            // Obtenemos los estados por lo que ha pasado el activo de la tabla de estados según su id_estado

            $valor1 = $registros["id_estado_anterior"];
            $valor2 = $registros["id_estado_posterior"];
            $estado1 = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor1);
            $estado2 = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor2);
            $estadoAnterior = $estado1["estado"];
            $estadoPosterior = $estado2["estado"];

            // Aquí hacemos la consulta a la tabla de inventario para sacar la serie y el tipo de activo fijo que se asignó o se dio de baja

            $valor = $registros["id_inventario"];
            $activos = ControladorInventario::ctrMostrarAF("id_inventario", $valor);
            $serie = $activos["serie"];
            $tipo = $activos["id_tipo"];

            // Obtenemos el tipo de la tabla tipos
            $valor = $tipo;
            $categorias = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $categoria = $categorias["tipo"];

            // Aquí hacemos la consulta a la tabla de usuarios para sacar el nombre del usuario que hizo el movimiento
            $valor = $registros["id_usuario"];
            $usuarios = ControladorUsuarios::ctrMostrarUsuario("id_usuario", $valor);
            $usuario = $usuarios["usuario"];

            echo "<tr>

                <td style='border:1px solid #000000;'>" . $serie . "</td>
                <td style='border:1px solid #000000;'>" . $categoria . "</td>
                <td style='border:1px solid #000000;'>" . $estadoAnterior . "</td>
                <td style='border:1px solid #000000;'>" . $estadoPosterior . "</td>
                <td style='border:1px solid #000000;'>" . $usuario . "</td>
                <td style='border:1px solid #000000;'>" . $registros["fecha"] . "</td>            
    
                </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    //Aquí empieza lo del reporte de las líneas con el método POST a ver si funciona

    /*--------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DE IMPRESORAS
    --------------------------------------------------------------------*/

    public function ctrDescargarReporteLineas()
    {

        $tabla = "lineas";
        $item = "linea";
        $series = $this->AFseries;
        $series = explode(",", $series);

        //Aquí creamos el archivo de excel de este reporte de telefonos

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>

        <td style='font-weight:bold; border:1px solid #000000;'>LINEA</td>
        <td style='font-weight:bold; border:1px solid #000000;'>IMEI ASIGNADO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
        <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>EMPLEADO ASIGNADO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>CONTRATO</td>
        <td style='font-weight:bold; border:1px solid #000000;'>CENTRO DE COSTOS</td>
        <td style='font-weight:bold; border:1px solid #000000;'>LÍMITE DE DATOS</td>
        <td style='font-weight:bold; border:1px solid #000000;'>TIPO DE LÍNEA</td>
        <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>

        </tr>";

        // Aquí vamos a obtener los datos de las tablas utilizando las claves foráneas que obtuvimos de la tabla "lineas" y vamos a ir imprimiendo cada celda en el excel

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $lineas = ModeloLineas::mdlMostrarLineas($tabla, $item, $valor);

            // Obtenemos el imei de la tabla inventario
            $valor = $lineas["id_inventario"];
            $dispositivos = ModeloInventario::mdlMostrarDispositivoDeLineas("id_inventario", $valor);
            if ($dispositivos != null) {
                $imei = $dispositivos["serie"];
            } else {
                $imei = "Sin dispositivo asignado";
            }

            // Obtenemos la marca de la tabla marcas
            $valor = $dispositivos["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $dispositivos["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }

            // Obtenemos el empleado de la tabla de empleados
            $valor = $lineas["id_empleado"];
            $empleados = ControladorEmpleados::ctrMostrarEmpleados("id_empleado", $valor);
            $nombre = $empleados["nombre"];
            $apellidoP = $empleados["apellido_paterno"];
            $apellidoM = $empleados["apellido_materno"];
            $empleado = $nombre . " " . $apellidoP . " " . $apellidoM;

            // Asignamos un valor según el id de la línea. Lo voy a hacer así porque de todos modos ni saben como agregar una nueva línea y por eso no se va a agregar ninguna línea nueva en un buen rato
            if ($lineas["id_tipo_linea"] == 1) {
                $tipoLinea = "VOZ";
            } else {
                $tipoLinea = "DATOS";
            }

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $lineas["linea"] . "</td>
            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $imei . "</td>
            <td style='border:1px solid #000000;'>" . $marca . "</td>
            <td style='border:1px solid #000000;'>" . $modelo . "</td>
            <td style='border:1px solid #000000;'>" . $empleado . "</td>
            <td style='border:1px solid #000000;'>" . $lineas["contrato"] . "</td>
            <td style='border:1px solid #000000;'>" . $lineas["centro_costos"] . "</td>
            <td style='border:1px solid #000000;'>" . $lineas["limite"] . "</td>
            <td style='border:1px solid #000000;'>" . $tipoLinea . "</td>
            <td style='border:1px solid #000000;'>" . $lineas["detalles"] . "</td>

            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }

    /*-----------------------------------------------------------------------------
      ESTE VA A SER EL MÉTODO PARA DESCARGAR LOS REPORTES DE LAS RENOVACIONES
    -------------------------------------------------------------------------------*/
    public $añosSumar;

    public function ctrDescargarReporteRenovaciones()
    {

        $tabla = "inventario";
        $item = "serie";
        $series = $this->AFseries;
        $series = explode(",", $series);
        $añosSumar = $this->añosSumar;

        //Convertimos las variables a números enteros
        if ($añosSumar != null && $añosSumar != "") {
            $años = intval($this->añosSumar);
        } else {
            $años = null;
        }

        //Aquí creamos el archivo de excel de este reporte de computadoras

        $name = $_GET["reporte"] . '.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");

        echo chr(239) . chr(187) . chr(191);

        //encabezado de la tabla de excel

        echo "<table border='0'> <tr>
        
                <td style='font-weight:bold; border:1px solid #000000;'>SERIE</td>
                <td style='font-weight:bold; border:1px solid #000000;'>TIPO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MARCA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>MODELO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ASIGNADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTADO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>ESTATUS</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA COMPRA</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA VENCIMIENTO</td>
                <td style='font-weight:bold; border:1px solid #000000;'>FECHA RENOVACIÓN</td>
                <td style='font-weight:bold; border:1px solid #000000;'>DETALLES</td>
        
                </tr>";

        for ($i = 0; $i < count($series); $i++) {

            $valor = $series[$i];

            $AFs = ModeloInventario::mdlMostrarInventario($tabla, $item, $valor);

            // Obtenemos la marca de la tabla marcas
            $valor = $AFs["id_marca"];
            $marcas = ControladorMarcas::ctrMostrarMarcas("id_marca", $valor);
            if ($marcas != null) {
                $marca = $marcas["marca"];
            } else {
                $marca = "Sin marca";
            }

            // Obtenemos el modelo de la tabla modelos
            $valor = $AFs["id_modelo"];
            $modelos = ControladorModelos::ctrMostrarModelos("id_modelo", $valor);
            if ($modelos != null) {
                $modelo = $modelos["modelo"];
            } else {
                $modelo = "Sin modelo";
            }
            // Obtenemos el tipo de la tabla tipos
            $valor = $AFs["id_tipo"];
            $tipos = ControladorCategorias::ctrMostrarCategorias("id_tipo", $valor);
            $tipo = $tipos["tipo"];

            // Obtenemos el estado de la tabla estados
            $valor = $AFs["id_estado"];
            $estados = ControladorUsoEstatusEstados::ctrMostrarEstados("id_estado", $valor);
            $estado = $estados["estado"];

            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($AFs["asignado"] == 1) {
                $asignado = "SI";
            } else {
                $asignado = "NO";
            }

            // Colocamos el valor de asignado segun sea el caso. Si es 1, entonces se asignó, si es 0, entonces no se ha asignado
            if ($AFs["id_estatus"] == 1) {
                $estatus = "COMPRADO";
            } else {
                $estatus = "ARRENDADO";
            }

            //Colocamos el valor de la fecha de vencimiento dependiendo que como venga de la base de datos
            if ($AFs["fecha_vencimiento"] == null || $AFs["fecha_vencimiento"] == "0000-00-00" || $AFs["fecha_vencimiento"] == "") {
                $fechaVencimiento = "No Aplica";
            } else {
                $fechaVencimiento = $AFs["fecha_vencimiento"];
            }

            //Sumamos el valor de los años a la fecha de compra
            if ($años != null && $años != "" && $AFs["fecha_ingreso"] != null && $AFs["fecha_ingreso"] != "0000-00-00" && $AFs["fecha_ingreso"] != "") {
                $fechaRenovacion = date("Y-m-d", strtotime($AFs["fecha_ingreso"] . "+ " . $años . " year"));
            } else {
                $fechaRenovacion = "No Aplica";
            }

            //Ponemos la fecha de compra
            if($AFs["fecha_ingreso"] == null || $AFs["fecha_ingreso"] == "0000-00-00" || $AFs["fecha_ingreso"] == "") {
                $fechaCompra = "";
            } else {
                $fechaCompra = $AFs["fecha_ingreso"];
            }

            echo "<tr>

            <td style='border:1px solid #000000; mso-number-format:\"\\@\";'>" . $AFs["serie"] . "</td>
            <td style='border:1px solid #000000;'>" . $tipo . "</td>
            <td style='border:1px solid #000000;'>" . $marca . "</td>
            <td style='border:1px solid #000000;'>" . $modelo . "</td>
            <td style='border:1px solid #000000;'>" . $asignado . "</td>
            <td style='border:1px solid #000000;'>" . $estado . "</td>
            <td style='border:1px solid #000000;'>" . $estatus . "</td>
            <td style='border:1px solid #000000;'>" . $fechaCompra . "</td>
            <td style='border:1px solid #000000;'>" . $fechaVencimiento . "</td>
            <td style='border:1px solid #000000;'>" . $fechaRenovacion . "</td>
            <td style='border:1px solid #000000;'>" . $AFs["detalles"] . "</td>

            </tr>";
        }

        echo "</table>" . htmlspecialchars_decode("&lt;/table&gt;", ENT_QUOTES | ENT_HTML5);
    }
}
