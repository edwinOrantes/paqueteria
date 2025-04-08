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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Permisos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lista permisos</li>
                            </ol>
                        </div>
                        <a href="<?= base_url(); ?>Permisos/agregar_permiso/<?= $area->idArea; ?>/" class="btn btn-primary"> Agregar permiso <i class="fe fe-file-plus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-dark">Lista de permisos del area: <strong><?= $area->nombreArea; ?></strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($permisos) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom" id="tblEmpleados">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-white"><strong>Fecha</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Empleado</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Motivo</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Autorización</strong></th>
                                                <th class="border-bottom-0 text-white"><strong>Opción</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($permisos as $row) { ?>
                                                <tr>
                                                    <td><?= $row->diaPermiso; ?></td>
                                                    <td><?= $row->nombreEmpleado; ?></td>
                                                    <td><?= $row->nombreMotivoPermiso; ?></td>
                                                    <td>
                                                        <?= $row->autorizacionPermiso; ?>
                                                        <input type="hidden" value="<?= $row->idPermiso; ?>" id="idPermiso">
                                                        <input type="hidden" value="<?= $row->nombreEmpleado; ?>" id="nombreEmpleado">
                                                        <input type="hidden" value="<?= $row->nombreMotivoPermiso; ?>" id="nombreMotivoPermiso">
                                                        <input type="hidden" value="<?= $row->autorizacionPermiso; ?>" id="autorizacionPermiso">
                                                        <input type="hidden" value="<?= $row->horasPermiso; ?>" id="horasPermiso">
                                                        <input type="hidden" value="<?= $row->diaPermiso; ?>" id="diaPermiso">
                                                        <input type="hidden" value="<?= $row->dePermiso; ?>" id="dePermiso">
                                                        <input type="hidden" value="<?= $row->hastaPermiso; ?>" id="hastaPermiso">
                                                    </td>
                                                    <td>
                                                        <a href="#verPermiso" id="btnVerPermiso" class="h4 text-primary" data-bs-toggle="modal" title="Ver detalle permiso"><i class="fe fe-eye"></i></a> 
                                                        <!-- <a href="#" data-bs-toggle="modal" title="Editar permiso"><i class="fe fe-edit"></i></a>  -->
                                                        <a href="#cancelarPermiso" id="btnCancelarPermiso" class="h4 text-danger"  data-bs-toggle="modal" title="Cancelar permiso"><i class="fe fe-x-circle"></i></a>
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
    <div class="modal fade" id="verPermiso" tabindex="-1" role="dialog">
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

    <div class="modal  fade" id="cancelarPermiso" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Permisos/cancelar_permiso" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Estas seguro de cancelar este permiso?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="area" value="<?= $area->idArea; ?>">
                        <input type="hidden" id="idPermisoDelete" name="idPermiso">
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
        var idPermiso = $(this).closest("tr").find("#idPermiso").val();
        var nombreEmpleado = $(this).closest("tr").find("#nombreEmpleado").val();
        var nombreMotivoPermiso = $(this).closest("tr").find("#nombreMotivoPermiso").val();
        var autorizacionPermiso = $(this).closest("tr").find("#autorizacionPermiso").val();
        var horasPermiso = $(this).closest("tr").find("#horasPermiso").val();
        var diaPermiso = $(this).closest("tr").find("#diaPermiso").val();
        var dePermiso = $(this).closest("tr").find("#dePermiso").val();
        var hastaPermiso = $(this).closest("tr").find("#hastaPermiso").val();
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
            html += '            <td> <strong class="text-dark">Fecha permiso: </strong> </td>';
            html += '            <td>'+diaPermiso+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Horas solicitadas: </strong> </td>';
            html += '            <td>'+horasPermiso+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Motivo: </strong> </td>';
            html += '            <td>'+nombreMotivoPermiso+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">Autorización: </strong> </td>';
            html += '            <td>'+autorizacionPermiso+'</td>';
            html += '            <td></td>';
            html += '            <td></td>';
            html += '        </tr>';
            html += '        <tr>';
            html += '            <td> <strong class="text-dark">De: </strong> </td>';
            html += '            <td>'+dePermiso+'</td>';
            html += '            <td> <strong class="text-dark">Hasta: </strong> </td>';
            html += '            <td>'+hastaPermiso+'</td>';
            html += '        </tr>';
            html += '    </tbody>';
            html += '</table>';
        // Creando tabla
        $("#tblDetalleEmpleado").html(html);
    });

    $(document).on("click", "#btnCancelarPermiso", function() {
        $("#idPermisoDelete").val($(this).closest("tr").find("#idPermiso").val());
        
    });
</script>