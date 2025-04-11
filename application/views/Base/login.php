<style>
    .page {
    position: relative;
    background: url(public/images/empresa/bg_login.jpg);
    background-size: cover;
    background-position: center;
    z-index: 0;
}

.page::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8); /* Negro con transparencia */
    z-index: 1;
}

</style>
<!-- PAGE -->
    <div class="page">
        <div class="">

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                        <div class="panel panel-primary">
                            
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <form class="needs-validation" id="frmLogin" method="post" action="<?php echo base_url() ?>Home/validar_usuario">
                                    <div class="form-03-main">
                                    <div class="logo text-center">
                                        <img src="<?php echo base_url(); ?>public/images/empresa/logo_circle.jpg" alt="profile-user" class="">
                                    </div>
                                    <h5 class="text-center fw-bold">Introducir datos de usuario</h5>
                                    <hr>
                                    <div class="col-xl-12 mb-3">
                                        <label for="codigoCliente"><strong>Usuario</strong></label>
                                        <input class="form-control" type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Ingresa tu nombre de usuario" required>
                                        <div class="invalid-tooltip"></div>
                                    </div>

                                    <div class="col-xl-12 mb-6">
                                        <label for="codigoCliente"><strong>Contraseña</strong></label>
                                        <input type="password" class="form-control" id="psUsuario" name="psUsuario" placeholder="Ingresa tu contraseña de usuario" required>
                                        <div class="invalid-tooltip"></div>
                                    </div>


                    
                                    <div class="form-group">
                                        <div class="_btn_04">
                                            <button class="btn btn-primary btn-block py-3">Ingresar</button>
                                        </div>
                                    </div>
                    
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
<!-- End PAGE -->