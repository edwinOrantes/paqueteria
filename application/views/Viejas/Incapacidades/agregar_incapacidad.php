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
                        <a href="<?= base_url(); ?>Incapacidades/lista_incapacidades/<?= $area->idArea; ?>/" class="btn btn-primary"> Lista incapacidades <i class="fe fe-file"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-dark">Datos de la incapacidad</strong></h4>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Incapacidades/guardar_incapacidad" novalidate>
                                        <div class="modal-body">
                                            <div class="form-row">

                                                <div class="col-xl-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="empleadoIncapacidad">Empleado</label>
                                                        <select class="form-control select2-show-search form-select" data-placeholder="Seleccionar empleado" id="empleadoIncapacidad" name="empleadoIncapacidad" required>
                                                            <option value="">.::Seleccionar::.</option>
                                                            <?php
                                                                foreach ($empleados as $row) {
                                                            ?> 
                                                                <option value="<?php echo $row->idEmpleado; ?>"><?php echo $row->nombreEmpleado; ?></option>
                                                            <?php
                                                                }
                                                            ?> 
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 mb-3">
                                                    <label for="inicioIncapacidad">De</label>
                                                    <input type="text" class="form-control calendario" id="inicioIncapacidad" name="inicioIncapacidad" required>
                                                    <div class="valid-feedback">Muy bien!</div>
                                                </div>

                                                <div class="col-xl-6 mb-3">
                                                    <label for="finIncapacidad">Hasta</label>
                                                    <input type="text" class="form-control calendario" id="finIncapacidad" name="finIncapacidad" required>
                                                    <div class="valid-feedback">Muy bien!</div>
                                                </div>


                                                <div class="col-xl-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="diagnosticoIncapacidad">Diagnóstico</label>
                                                        <textarea class="form-control mb-4" name="diagnosticoIncapacidad" id="diagnosticoIncapacidad" cols="30" rows="3" placeholder="Detallar el diagnóstico del empleado" required></textarea>
                                                        <div class="valid-feedback">Muy bien!</div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>

                                        </div>
                                        <div class="btnAcciones">
                                            <button class="btn btn-primary">Guardar Incapacidad</button>
                                        </div>
                                    </form>
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
   
    <div class="modal  fade" id="eliminarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleados/eliminar_empleado" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿Estas seguro de eliminar este registro?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="estadoEmpleadoE" value="0">
                        <input type="hidden" id="idEmpleadoE" name="idEmpleadoE">
                        <button class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->



<script>
    $(function() {
        $('.calendario').datepicker({
            'format': 'yyyy-m-d',
				'autoclose': true
        });

        // Time Picker
        $('#dePermiso, #hastaPermiso').timepicker();
        $('#dePermiso, #hastaPermiso').timepicker({
            'scrollDefault': 'now'
        });
    });

    $(document).on("click", "#btnEditarDatos", function(event) {
        event.preventDefault();
        
        $("#nombreEmpleadoU").val($(this).closest('tr').find('#nombre').val());
        $("#telefonoEmpleadoU").val($(this).closest('tr').find('#telefono').val());
        $("#duiEmpleadoU").val($(this).closest('tr').find('#dui').val());
        $("#correoEmpleadoU").val($(this).closest('tr').find('#correo').val());
        $("#nacimientoEmpleadoU").val($(this).closest('tr').find('#nacimiento').val());
        $("#ingresoEmpleadoU").val($(this).closest('tr').find('#ingreso').val());
        $("#salarioEmpleadoU").val($(this).closest('tr').find('#salario').val());
        $("#areaEmpleadoU").val($(this).closest('tr').find('#area').val());
        $("#direccionEmpleadoU").val($(this).closest('tr').find('#direccion').val()); 
        $("#idEmpleadoU").val($(this).closest('tr').find('#idEmpleado').val()); 
    });

    $(document).on("click", "#btnEliminarDatos", function(event) {
        event.preventDefault();
        $("#idEmpleadoE").val($(this).closest('tr').find('#idEmpleado').val()); 
    });

    // Para cuando sse seleecionar "Otro motivo"
    $(document).on("change", "#motivoPermiso", function(event) {
        event.preventDefault();
        var pivote = $(this).val();
        $("#detalleOtro").html(" ");
        if(pivote == 5){
            var html = "";
            html +='<label for="otroMotivo">Especifique</label>';
            html +='<input type="text" class="form-control" id="otroMotivo" name="otroMotivo" required>';
            html +='<div class="valid-feedback">Muy bien!</div>';
            $("#detalleOtro").append(html);
            // alert(html);
        }else{
            $("#detalleOtro").html(" ");
        }
    });
</script>