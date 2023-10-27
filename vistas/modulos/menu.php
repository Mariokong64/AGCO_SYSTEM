<!-- ESTE ES EL HTML QUE HACE EL MENÚ LATERAL DEL SISTEMA. DEPENDIENDO DEL PERFIL DEL USUARIO SERÁN LOS BOTONES QUE SE VAN A MOSTRAR  -->

<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <!-- Botón de inicio -->

            <li class="active">
                <a href="inicio"><i class="fa fa-home"></i><span>Inicio</span></a>
            </li>

            <?php

            if($_SESSION["perfil"] == "Administrador"){
            
            echo
            '
            <!-- Botón de usuarios -->

            <li>
                <a href="usuarios">

                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>

                </a>

            </li>';

            }

            echo
            '<!-- Botón principal de trabajadores -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-users"></i>
                    <span>Trabajadores</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de empleados -->
                    <li>
                        <a href="empleado">
                            <i class="fa fa-circle-o"></i>
                            <span>Empleados</span>
                        </a>
                    </li>

                    <!-- Sub botón de puestos de los empleados -->
                    <li>
                        <a href="puesto">
                            <i class="fa fa-circle-o"></i>
                            <span>Puestos</span>
                        </a>

                    </li>

                </ul>

            </li>

            <!-- Botón principal de inventario -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-list"></i>
                    <span>Clasificación de AFs</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de inventario categoría -->
                    <li>
                        <a href="categoria">
                            <i class="fa fa-circle-o"></i>
                            <span>Categorías</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario modelo -->
                    <li>
                        <a href="marca">
                            <i class="fa fa-circle-o"></i>
                            <span>Marcas</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario modelo -->
                    <li>
                        <a href="modelo">
                            <i class="fa fa-circle-o"></i>
                            <span>Modelos</span>
                        </a>
                    </li>

                </ul>

            </li>

            <!-- Botón principal de inventario -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-th"></i>
                    <span>Inventario de AFs</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de inventario categoría -->
                    <li>
                        <a href="inventarioTelefonos">
                            <i class="fa fa-circle-o"></i>
                            <span>Telefonos</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario modelo -->
                    <li>
                        <a href="inventarioImpresora">
                            <i class="fa fa-circle-o"></i>
                            <span>Impresoras</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario modelo -->
                    <li>
                        <a href="inventarioPC">
                            <i class="fa fa-circle-o"></i>
                            <span>Laptops/PC</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario general -->
                    <li>
                        <a href="inventario">
                            <i class="fa fa-circle-o"></i>
                            <span>Consulta Completa</span>
                        </a>
                    </li>

                    <!-- Sub botón de inventario rápido -->
                    <li>
                        <a href="inventarioRapido">
                            <i class="fa fa-circle-o"></i>
                            <span>Consulta General</span>
                        </a>
                    </li>

                    <!-- Sub botón de Consulta Recurrente -->
                    <li>
                        <a href="inventarioRecurrente">
                            <i class="fa fa-circle-o"></i>
                            <span>Consulta Rápida</span>
                        </a>
                    </li>

                </ul>

            </li>

            <!-- Botón principal de Ubicaciones -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-building"></i>
                    <span>Ubicaciones</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de departamentos -->
                    <li>
                        <a href="departamento">
                            <i class="fa fa-circle-o"></i>
                            <span>Departamentos</span>
                        </a>
                    </li>

                    <!-- Sub botón de ubicaciones -->
                    <li>
                        <a href="ubicacion">
                            <i class="fa fa-circle-o"></i>
                            <span>Ubicaciones</span>
                        </a>

                    </li>

                </ul>

            </li>';

            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Soporte") {

            echo
            '<!-- Botón principal de movimientos -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-exchange"></i>
                    <span>Movimientos</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de movimiento asignaciónes -->
                    <li>
                        <a href="asignacion">
                            <i class="fa fa-circle-o"></i>
                            <span>Asignaciones</span>
                        </a>
                    </li>

                    <!-- Sub botón de movimiento devoluciones -->
                    <li>
                        <a href="devolucion">
                            <i class="fa fa-circle-o"></i>
                            <span>Devoluciones</span>
                        </a>
                    </li>

                </ul>

            </li>
            
            <!-- Botón de Credenciales -->
            <li>
                <a href="credenciales">

                    <i class="fa fa-address-card"></i>
                    <span>Credenciales</span>

                </a>
            </li>

            <!-- Botón de Lineas telefónicas -->
            <li>
                <a href="lineas">

                    <i class="fa fa-phone-square"></i>
                    <span>Líneas Telefónicas</span>

                </a>
            </li>

            <!-- Botón del módulo de renovaciones -->
            <li>
                <a href="renovaciones">

                    <i class="fa fa-refresh"></i>
                    <span>Renovaciones</span>

                </a>
            </li>

            <!-- Botón del módulo de facturas -->
            <li>
                <a href="facturas">

                    <i class="fa fa-file-pdf-o"></i>
                    <span>Facturas</span>

                </a>
            </li>

            <!-- Botón principal del historial -->

            <li class="treeview">
                <a href="">

                    <i class="fa fa-history"></i>
                    <span>Historial</span>
                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>
                <ul class="treeview-menu">

                    <!-- Sub botón de movimiento historial -->
                    <li>
                        <a href="historial">
                            <i class="fa fa-circle-o"></i>
                            <span>Movimientos</span>
                        </a>
                    </li>

                    <!-- Sub botón de hitorial de cambios de estados -->
                    <li>
                        <a href="historial-estado">
                            <i class="fa fa-circle-o"></i>
                            <span>Estados</span>
                        </a>
                    </li>

                    <!-- Sub botón de hitorial de cambios en las líneas -->
                    <li>
                        <a href="historialLineas">
                            <i class="fa fa-circle-o"></i>
                            <span>Lineas</span>
                        </a>
                    </li>

                </ul>

            </li>

        </ul>';

            }

        ?>

    </section>

</aside>