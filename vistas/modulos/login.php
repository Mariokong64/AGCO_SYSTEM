<!-- ESTE ES LA VISTA DEL LOGIN, QUE ES LO QUE SE VE AL INICIO DEL SISTEMA EN DONDE SALE EL TRACTOR Y EN DONDE SE TIENEN QUE INGRESAR LAS CREDENCIALES DEL USUARIO -->

<div id="back"></div>

<div class="login-box">

    <div class="login-logo">

        <img src="vistas/img/plantilla/agco_large_logo2.png" class="img-responsive" style="padding: 20px 80px 0px 80px">

    </div>
    
    <div class="login-box-body" style="  border-radius: 10px; background-color: rgba(255, 255, 255, 0.9);">
    
        <p class="login-box-msg">Administrador de Activos Fijos</p>

        <form method="post">

            <div class="form-group has-feedback">

                <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

            </div>

            <div class="form-group has-feedback">

                <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

            </div>

            <div class="row">

                <div class="col-xs-4"></div>

                <div class="col-xs-4">

                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

                </div>

                <div class="col-xs-4"></div>

            </div>

            <div class="text-center" style="padding-top: 15px;">
                <a href="">¿Olvidó su contraseña?</a>
            </div>

            <?php
            $login = new ControladorUsuarios();
            $login->ctrIngresoUsuario();
            ?>

        </form>

    </div>

</div>