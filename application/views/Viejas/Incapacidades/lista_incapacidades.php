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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Incapacidades</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lista incapacidades</li>
                            </ol>
                        </div>
                        <a href="<?= base_url(); ?>Incapacidades/agregar_incapacidad/<?= $area->idArea; ?>/" class="btn btn-primary"> Agregar incapacidad <i class="fe fe-file-plus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-dark">Lista de incapacidades del area: <strong><?= $area->nombreArea; ?></strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($incapacidades) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom" id="tblEmpleados">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-white"><strong>Empleado</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>De</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Hasta</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Diagnóstico</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Opción</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($incapacidades as $row) { ?>
                                                <tr>
                                                    <td><?= $row->nombreEmpleado; ?></td>
                                                    <td><?= $row->deIncapacidad; ?></td>
                                                    <td><?= $row->hastaIncapacidad; ?></td>
                                                    <td>
                                                        <?= $row->diagnosticoIncapacidad; ?>
                                                        <input type="hidden" value="<?= $row->idIncapacidad; ?>" id="idIncapacidad">
                                                        <input type="hidden" value="<?= $row->nombreEmpleado; ?>" id="nombreEmpleado">
                                                        <input type="hidden" value="<?= $row->diagnosticoIncapacidad; ?>" id="diagnosticoIncapacidad">
                                                        <input type="hidden" value="<?= $row->deIncapacidad; ?>" id="deIncapacidad">
                                                        <input type="hidden" value="<?= $row->hastaIncapacidad; ?>" id="hastaIncapacidad">
                                                    </td>
                                                    <td>
                                                        <a href="#verIncapacidad" id="btnVerPermiso" class="h4 text-primary" data-bs-toggle="modal" title="Ver detalle permiso"><i class="fe fe-eye"></i></a> 
                                                        <!-- <a href="#" data-bs-toggle="modal" title="Editar permiso"><i class="fe fe-edit"></i></a>  -->
                                                        <a href="#cancelarIncapacidad" id="btnCancelarPermiso" class="h4 text-danger"  data-bs-toggle="modal" title="Cancelar permiso"><i class="fe fe-x-circle"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
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
    <div class="modal fade" id="verIncapacidad" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Detalles de la incapacidad</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                <div class="modal-body">
                    <div id="tblDetalleEmpleado"> </div>

                </div>
                <div class="btnAcciones">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="cancelarIncapacidad" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Incapacidades/cancelar_incapacidad" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Estas seguro de cancelar esta incapacidad?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="area" value="<?= $area->idArea; ?>">
                        <input type="hidden" id="idIncapacidadDelete" name="idIncapacidad">
                        <a class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->


<script>
    $(document).on("click", "#btnVerPermiso", function() {
        $("#tblDetalleEmpleado").html(" ");
        var idIncapacidad = $(this).closest("tr").find("#idIncapacidad").val();
        var nombreEmpleado = $(this).closest("tr").find("#nombreEmpleado").val();
        var diagnosticoIncapacidad = $(this).closest("tr").find("#diagnosticoIncapacidad").val();
        var deIncapacidad = $(this).closest("tr").find("#deIncapacidad").val();
        var hastaIncapacidad = $(this).closest("tr").find("#hastaIncapacidad").val();

        var html = '';
        // Creando tabla
            html += '<table class="table">';
            html += '    <thead></thead>';
            html += '    <tbody>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Empleado: </strong> </td>';
            html += '            <td>'+nombreEmpleado+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Diagnóstico: </strong> </td>';
            html += '            <td>'+diagnosticoIncapacidad+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Inicio de la incapacidad: </strong> </td>';
            html += '            <td>'+deIncapacidad+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Final de la incapacidad: </strong> </td>';
            html += '            <td>'+hastaIncapacidad+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '    </tbody>';
            html += '</table>';
        // Creando tabla
        $("#tblDetalleEmpleado").html(html);
    });

    $(document).on("click", "#btnCancelarPermiso", function() {
        $("#idIncapacidadDelete").val($(this).closest("tr").find("#idIncapacidad").val());
        
    });
</script>