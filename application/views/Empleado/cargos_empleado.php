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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Cargos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Gestión de cargos</li>
                            </ol>
                        </div>
                        <a href="#agregarCargo" data-bs-toggle='modal' class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Agregar cargo</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Listado de cargos para empleados</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($cargos) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="">
                                        <thead>
                                            <tr class="bg-primary">
												<th class="border-bottom-0 text-center text-white" scope="col">#</th>
                                          		<th class="border-bottom-0 text-center text-white" scope="col">Nombre</th>
                                          		<th class="border-bottom-0 text-center text-white" scope="col">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$index = 0;
												foreach ($cargos as $cargo) {
													$index++;
													$id ='"'.$cargo->idCargo.'"';
													$nombreCargo ='"'.$cargo->nombreCargo.'"';
											?>
											<tr>
                                              <td class="text-center" scope="row"><?php echo $index; ?></td>
                                              <td class="text-center"><?php echo $cargo->nombreCargo; ?></td>
                                              <td class="text-center">
                                              <?php
                                                  echo "<a onclick='actualizarCargo($id, $nombreCargo)' href='#actualizarCargo' data-bs-toggle='modal'><i class='fa fa-edit iconoPlus text-success'></i></a> ";
                                                  echo " <a onclick='eliminarCargo($id)' href='#eliminarCargo' data-bs-toggle='modal'><i class='fa fa-trash iconoPlus text-danger'></i></a>";
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
    <div class="modal fade" id="agregarCargo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/guardar_cargo" novalidate>
                        <div class="modal-body">   
							<div class="form-row">
								<div class="col-md-12">
									<label for="">Nombre</label>
									<div class="input-group">
										<input type="text" class="form-control" id="nombreCargo" name="nombreCargo" placeholder="Nombre del cargo" required>
										<div class="invalid-tooltip">
											Ingrese el nombre del cargo.
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar cargo</button>
                                <a class="btn btn-light" type="reset" data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</a>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="actualizarCargo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/actualizar_cargo" novalidate>
                        <div class="modal-body">   
    
							<div class="form-row">
								<div class="col-md-12">
									<label for="">Nombre del cargo</label>
									<div class="input-group">
										<input type="text" class="form-control" id="nombreCargoA" name="nombreCargo" placeholder="Nombre del insumo y/o servicio" required>
										<div class="invalid-tooltip">
											Ingrese el nombre del insumo y/o servicio.
										</div>
									</div>
								</div>
							</div>

                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
								<input type="hidden" class="form-control" id="idCargoA" name="idCargo" />
                                <button class="btn btn-primary mt-4 d-inline w-20" type="submit"><i class="fa fa-save"></i> Actualizar cargo</button>
                                <a class="btn btn-light mt-4 d-inline w-20"  data-bs-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Cancelar</a>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="eliminarCargo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/eliminar_cargo" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de eliminar los datos de este cargo?</p>
						<input type="hidden" class="form-control" id="idCargoE" name="idCargo" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger shadow-none"><i class="fa fa-trash"></i> Eliminar</button>
					    <a class="btn btn-light" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->


<script>
  
      function actualizarCargo(id, nombre){
          document.getElementById("idCargoA").value = id;
          document.getElementById("nombreCargoA").value = nombre;
      }
  
      function eliminarCargo(id){
          document.getElementById("idCargoE").value = id;
      }
  </script>