<?php if($this->session->flashdata("exito")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
      toastr.options.positionClass = "toast-top-center";
      toastr.success('<?php echo $this->session->flashdata("exito")?>', 'Aviso!');
    });
  </script>
<?php endif; ?>

<?php if($this->session->flashdata("error")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
      toastr.options.positionClass = "toast-top-center";
      toastr.error('<?php echo $this->session->flashdata("error")?>', 'Aviso!');
    });
  </script>
<?php endif; ?>
<!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- page-header -->
                    <div class="page-header">
                        <div>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Usuarios</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestión de usuarios</li>
                            </ol>
                        </div>
                        <a href="#agregarUsuario" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Agregar usuario</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de usuarios</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($accesos) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-white text-center" scope="col">#</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Empleado</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Usuario</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Contraseña</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Tipo acceso</th>
                                                <th class="border-bottom-0 text-white text-center" scope="col">Opción</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 0;
                                                foreach ($usuarios as $usuario) {
                                                    $index++;
                                                    $id ='"'.$usuario->idUsuario.'"';
                                                    $nombre ='"'.$usuario->nombreUsuario.'"';
                                                    $ps ='"'.$usuario->psUsuario.'"';
                                                    $empleado ='"'.$usuario->idEmpleado.'"';
                                                    $acceso ='"'.$usuario->idAcceso.'"';
                                            ?>
                                                <tr>
                                                    <td scope="row"><?php echo $index; ?></td>
                                                    <td><?php echo $usuario->nombreEmpleado; ?></td>
                                                    <td><?php echo $usuario->nombreUsuario; ?></td>
                                                    <td>
														<i class="fa fa-asterisk fa-sm text-info"></i>
														<i class="fa fa-asterisk fa-sm text-info"></i>
														<i class="fa fa-asterisk fa-sm text-info"></i>
														<i class="fa fa-asterisk fa-sm text-info"></i>
														<i class="fa fa-asterisk fa-sm text-info"></i>
													</td>
                                                    <td><?php echo $usuario->nombreAcceso; ?></td>
                                                    <td>
                                                    <?php
                                                        //echo "<a onclick='verDetalle($id, $nombre, $especialidad, $telefono, $direccion)' href='#verMedico' data-toggle='modal'><i class='far fa-eye ms-text-primary'></i></a>";
                                                        echo "<a onclick='actualizarUsuario($id, $nombre, $ps, $empleado, $acceso)' href='#actualizarUsuario' data-bs-toggle='modal'><i class='fa fa-edit iconoPlus text-success'></i></a> ";
                                                        echo " <a onclick='eliminarUsuario($id)' href='#eliminarUsuario' data-bs-toggle='modal'><i class='fa fa-trash iconoPlus text-danger'></i></a>";
                                                    ?>
                                                    </td>
                                                </tr>
                
                                            <?php  }  ?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php
                                        }else{
                                            echo '<div class="alert-danger p-3 text-center">No hay datos que mostrar</div>';
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- container closed -->
        </div>
    </div>
<!--app-content closed-->


<!-- Modales -->
    <div class="modal fade" id="agregarUsuario" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Usuarios/guardar_usuario" novalidate>
                        <div class="modal-body">   
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Usuario</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre del usuario" required>
                                        <div class="invalid-tooltip">
                                            Ingrese un nombre para el usuario.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Contraseña</strong></label>
                                    <input type="text" class="form-control" id="psUsuario" name="psUsuario" placeholder="Contraseña de acceso" required>
                                    <div class="invalid-tooltip">
                                        Ingrese la contraseña del acceso.
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Empleado</strong></label>
                                    <div class="input-group">
                                        <select class="form-control" id="empleadoUsuario" name="empleadoUsuario" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($empleados as $empleado) {
                                            ?>
                                            <option value="<?php echo $empleado->idEmpleado; ?>"><?php echo $empleado->nombreEmpleado; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Seleccione un empleado.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Acceso</strong></label>
                                    <div class="input-group">
                                        <select class="form-control" id="accesoUsuario" name="accesoUsuario" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($accesos as $acceso) {
                                            ?>
                                            <option value="<?php echo $acceso->idAcceso; ?>"><?php echo $acceso->nombreAcceso; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Ingrese un acceso para el usuario.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar usuario</button>
                                <button class="btn btn-light" type="reset" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actualizarUsuario" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Usuarios/actualizar_usuario" novalidate>
                        <div class="modal-body">   
    
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Usuario</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nombreUsuarioA" name="nombreUsuario" placeholder="Nombre del usuario" required>
                                        <div class="invalid-tooltip">
                                            Ingrese un nombre para el usuario.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Contraseña</strong></label>
                                    <input type="password" class="form-control" id="psUsuarioA" name="psUsuario" placeholder="Contraseña de acceso">
                                    <div class="invalid-tooltip">
                                        Ingrese la contraseña del acceso.
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Empleado</strong></label>
                                    <div class="input-group">
                                        <select class="form-control" id="empleadoUsuarioA" name="empleadoUsuario" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($empleados as $empleado) {
                                            ?>
                                            <option value="<?php echo $empleado->idEmpleado; ?>"><?php echo $empleado->nombreEmpleado; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Seleccione un empleado.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Acceso</strong></label>
                                    <div class="input-group">
                                        <select class="form-control" id="accesoUsuarioA" name="accesoUsuario" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($accesos as $acceso) {
                                            ?>
                                            <option value="<?php echo $acceso->idAcceso; ?>"><?php echo $acceso->nombreAcceso; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Ingrese un acceso para el usuario.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" class="form-control" id="idUsuarioA" name="idUsuario">

                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Actualizar usuario</button>
                                <button class="btn btn-light" type="reset" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="eliminarUsuario" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Usuarios/eliminar_usuario" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de eliminar los datos de este usuario ?</p>
					    <input type="hidden" class="form-control" id="idUsuarioE" name="idUsuario">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger shadow-none"><i class="fa fa-trash"></i> Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->


<script>
	function actualizarUsuario(id, nombre, ps, empleado, acceso){
		$("#idUsuarioA").val(id);
		$("#nombreUsuarioA").val(nombre);
/* 		$("#psUsuarioA").val(ps); */
		$("#empleadoUsuarioA").val(empleado);
		$("#accesoUsuarioA").val(acceso);
	}
	
	function eliminarUsuario(id){
		$("#idUsuarioE").val(id);
	}
</script>