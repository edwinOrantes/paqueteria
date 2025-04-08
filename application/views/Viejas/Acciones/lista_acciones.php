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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Acciones</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lista acciones</li>
                            </ol>
                        </div>
                        <a href="<?= base_url(); ?>Acciones/agregar_accion/<?= $area->idArea; ?>/" class="btn btn-primary"> Agregar acción <i class="fe fe-file-plus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-dark">Lista de acciones de personal del area: <strong><?= $area->nombreArea; ?></strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($acciones) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom" id="tblEmpleados">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-white"><strong>#</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Fecha</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Empleado</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Tipo de acción</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Descripción</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Opción</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $flag = 0;
                                                foreach ($acciones as $row) {
                                                    if($row->estadoAccionPersonal = 1){
                                                    $flag++;
                                            ?>
                                                <tr>
                                                    <td><?= $flag; ?></td>
                                                    <td><?= $row->fechaAccionPersonal; ?></td>
                                                    <td><?= $row->nombreEmpleado; ?></td>
                                                    <td><?= $row->nombreTipoAccion; ?></td>
                                                    <td>
                                                        <?= $row->descripcionAccionPersonal; ?>
                                                        <input type="hidden" value="<?= $row->idAccionPersonal; ?>" id="idAccionPersonal">
                                                   
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>Acciones/accion_pdf/<?= $row->idAccionPersonal; ?>/" id="btnVerAccion" class="h4 text-primary" title="Ver detalle acción de personal"><i class="fe fe-eye"></i></a> 
                                                        <!-- <a href="#" data-bs-toggle="modal" title="Editar permiso"><i class="fe fe-edit"></i></a>  -->
                                                        <a href="#cancelarAccion" id="btnCancelarAccion" class="h4 text-danger"  data-bs-toggle="modal" title="Cancelar acción de personal"><i class="fe fe-x-circle"></i></a>
                                                    </td>
                                                </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                    <?php
                                        }else{
                                            echo '<div class="text-center alert-danger p-5"><p>No hay datos que mostrar...</p></div>';
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
    <div class="modal fade" id="verAccion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Detalles del permiso</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                <div class="modal-body">
                    <div id="tblDetalleEmpleado"> </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="cancelarAccion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Acciones/eliminar_accion_personal" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a href="#" class="" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">X</span>
                            </a>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Estas seguro de eliminar esta acción de personal?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="area" value="<?= $area->idArea; ?>">
                        <input type="hidden" id="idAccionDelete" name="idAccionPersonal">
                        <a class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->


<script>
    $(document).on("click", "#btnCancelarAccion", function() {
        $("#idAccionDelete").val($(this).closest("tr").find("#idAccionPersonal").val());
        
    });
</script>