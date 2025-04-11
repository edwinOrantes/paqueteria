<?php if($this->session->flashdata("exito")):?>
  <script type="text/javascript">
        $(document).ready(function(){
        toastr.remove();
            toastr.options = {
                "positionClass": "toast-top-center",
                "showDuration": "3000",
                "hideDuration": "3000",
                "timeOut": "3000",
                "extendedTimeOut": "50",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                },
            toastr.success('<?php echo $this->session->flashdata("exito")?>', 'Aviso!');

        });
    </script>
    <?php endif; ?>

<?php if($this->session->flashdata("error")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
        toastr.options = {
            "positionClass": "toast-top-center",
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "3000",
            "extendedTimeOut": "50",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            },
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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Gastos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cuentas</li>
                            </ol>
                        </div>
						<a href="#agregarCuenta" data-bs-toggle="modal" class="btn btn-primary btn-sm"title="Agregar cuenta"><i class="fa fa-plus"></i> Agregar cuenta</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de cuentas</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($cuentas) != 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="tbl_clientes">
                                        <thead>
                                            <tr class="bg-primary">
												<th class="text-center text-white">#</th>
												<th class="text-center text-white">Nombre</th>
												<th class="text-center text-white">Descripción</th>
												<th class="text-center text-white">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
                                                $index = 1;
                                                foreach ($cuentas as $row) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index;?></td>
                                                        <td class="text-center"><?= $row->nombreCuenta;?></td>
                                                        <td class="text-center"><?= $row->descripcionCuenta;?></td>
                                                        <td class="text-center">
                                                            <input type="hidden" class="idC" value="<?= $row->idCuenta;?>">
                                                            <input type="hidden" class="nombreC" value="<?= $row->nombreCuenta;?>">
                                                            <input type="hidden" class="descripcionC" value="<?= $row->descripcionCuenta;?>">

                                                            <a href="#editarCuenta" id="btnEditar" data-bs-toggle="modal"  class="text-primary" title="Editar cuenta"><i class="fa fa-edit iconoPlus"></i></a>
                                                            <a href="#eliminarCuenta" id="btnEliminar" data-bs-toggle="modal" class="text-danger" title="Eliminar cuenta"><i class="fa fa-trash iconoPlus"></i></a>
                                                        </td>
                                                    </tr>
                
                                            <?php
                                                     $index++;
                                                }
                                            ?>
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
    <div class="modal fade" id="agregarCuenta" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Datos de la cuenta</strong></h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Gastos/guardar_cuenta" novalidate>
                        <div class="modal-body">   
                            <div class="form-row">

                                <div class="col-xl-12 mb-3">
                                    <label for="nombreCuenta"><strong>Nombre cuenta:</strong></label>
                                    <input type="text" class="form-control" id="nombreCuenta" name="nombreCuenta" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="descripcionCuenta"><strong> Descripción: </strong></label>
									<textarea class="form-control" id="descripcionCuenta" name="descripcionCuenta" rows="5" required></textarea>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit"> Guardar cuenta <i class="fe fe-save"></i></button>
                            </div>
                        </div>   
                    </form>

					
            </div>
        </div>
    </div>


    <div class="modal fade" id="editarCuenta" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Datos de la cuenta</strong></h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Gastos/actualizar_cuenta" novalidate>
                        <div class="modal-body">   
                            <div class="form-row">

                                <div class="col-xl-12 mb-3">
                                    <label for="nombreCuenta"><strong>Nombre cuenta:</strong></label>
                                    <input type="text" class="form-control" id="nombreCuentaU" name="nombreCuenta" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="descripcionCuenta"><strong> Descripción: </strong></label>
									<textarea class="form-control" id="descripcionCuentaU" name="descripcionCuenta" rows="5" required></textarea>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
								<input type="hidden" class="form-control" id="idCuenta" name="idCuenta" required>
                                <button class="btn btn-primary" type="submit"> Actualizar cuenta <i class="fe fe-save"></i></button>
                            </div>
                        </div>   
                    </form>

					
            </div>
        </div>
    </div>

    <div class="modal  fade" id="eliminarCuenta" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Gastos/eliminar_cuenta" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </a>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Estas seguro de eliminar este registro?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="estadoCuentaE" value="0">
                        <input type="hidden" id="idCuentaE" name="idCuentaE">
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->



<script>
    $(function() {
        /* $('.calendario').datepicker({
            'format': 'yyyy-m-d',
				'autoclose': true
        }); */

        $('input[id="telefonoEmpleadoU"]').mask('0000-0000');
        $('input[id="duiEmpleadoU"]').mask('000000000');
    });

    $(document).on("click", "#btnEditar", function(event) {
        event.preventDefault();
        
        $("#nombreCuentaU").val($(this).closest('tr').find('.nombreC').val());
        $("#descripcionCuentaU").val($(this).closest('tr').find('.descripcionC').val());
        $("#idCuenta").val($(this).closest('tr').find('.idC').val());

		


 
    });

    $(document).on("click", "#btnEliminar", function(event) {
        event.preventDefault();
        $("#idCuentaE").val($(this).closest('tr').find('.idC').val()); 
    });
</script>