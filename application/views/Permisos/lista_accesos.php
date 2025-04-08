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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Accesos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestión de permisos de usuario</li>
                            </ol>
                        </div>
						<a href="#agregarAcceso" data-bs-toggle="modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Agregar acceso</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de accesos</h3>
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
                                            	<th class="border-bottom-0 text-white text-center" scope="col">Nombre acceso</th>
                                            	<th class="border-bottom-0 text-white text-center" scope="col">Descripción</th>
                                            	<th class="border-bottom-0 text-white text-center" scope="col">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $index = 0;
												foreach ($accesos as $acceso) {
													$index++;
													$id ='"'.$acceso->idAcceso.'"';
													$nombre ='"'.$acceso->nombreAcceso.'"';
													$descripcion ='"'.$acceso->descripcionAcceso.'"';
                                            ?>
												<tr>
                                                    <td scope="row"><?php echo $index; ?></td>
                                                    <td><?php echo $acceso->nombreAcceso; ?></td>
                                                    <td><?php echo $acceso->descripcionAcceso; ?></td>
                                                    <td>
                                                    <?php
                                                        
                                                        echo "<a href='".base_url()."Permisos/agregar_permisos/".$acceso->idAcceso."'><i class='fa fa-edit iconoPlus text-success'></i></a>";
                                                        
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
    <div class="modal fade" id="agregarAcceso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Accesos/guardar_acceso" novalidate>
                        <div class="modal-body">   
                            <div class="form-row">
								<div class="col-md-12">
									<label for=""><strong>Nombre</strong></label>
									<div class="input-group">
										<input type="text" class="form-control" id="nombreAcceso" name="nombreAcceso" placeholder="Nombre del acceso" required>
										<div class="invalid-tooltip">
											Ingrese un nombre para el acceso.
										</div>
									</div>
								</div>
								
																	
							</div>

							<div class="form-row">
								<div class="col-md-12">
									<label for=""><strong>Descripción</strong></label>
									<textarea class="form-control disableSelect" id="descripcionAcceso" name="descripcionAcceso" required></textarea>
									<div class="invalid-tooltip">
										Ingrese la descripción del acceso.
									</div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar acceso</button>
                                <button class="btn btn-light" type="reset" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="actualizarAcceso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Accesos/actualizar_acceso" novalidate>
                        <div class="modal-body">   
    
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Nombre</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="nombreAccesoA" name="nombreAcceso" placeholder="Nombre del acceso" required>
                                        <div class="invalid-tooltip">
                                            Ingrese un nombre para el acceso.
                                        </div>
                                    </div>
                                </div>
                                
                                                                    
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for=""><strong>Descripción</strong></label>
                                    <textarea class="form-control disableSelect" id="descripcionAccesoA" name="descripcionAcceso" required></textarea>
                                    <div class="invalid-tooltip">
                                        Ingrese la descripción del acceso.
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                            <input type="hidden" class="form-control" id="idAccesoA" name="idAcceso">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Actualizar acceso</button>
                                    <button class="btn btn-light" type="reset" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="eliminarAcceso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Accesos/eliminar_acceso" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de eliminar los datos de este acceso ?</p>
					    <input type="hidden" class="form-control" id="idAccesoE" name="idAcceso">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger shadow-none"><i class="fa fa-trash"></i> Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div> -->
<!-- Modales -->


<script>

	function actualizarAcceso(id, nombre, descripcion){
		$("#idAccesoA").val(id);
		$("#nombreAccesoA").val(nombre);
		$("#descripcionAccesoA").val(descripcion);
	}
	
	function eliminarAcceso(id){
		$("#idAccesoE").val(id);
	}
</script>