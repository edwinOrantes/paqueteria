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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Datos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista empleados</li>
                        </ol>
                    </div>
                    <a href="<?php echo base_url(); ?>Empleados/lista_empleados" class="btn btn-primary"> Lista empleados <i class="fe fe-file"></i></a>
                </div>
            <!-- page-header end -->

            <!-- row open -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Datos del empleado</h3>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleados/guardar_empleado" novalidate>
                                <div class="form-row">

                                    <div class="col-xl-6 mb-3">
                                        <label for="nombreEmpleado">Nombre completo</label>
                                        <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="telefonoEmpleado">Teléfono</label>
                                        <input type="text" class="form-control" id="telefonoEmpleado" name="telefonoEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>
                                    
                                    <div class="col-xl-6 mb-3">
                                        <label for="duiEmpleado">DUI</label>
                                        <input type="text" class="form-control" id="duiEmpleado" name="duiEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="correoEmpleado">Correo electrónico</label>
                                        <input type="email" class="form-control" id="correoEmpleado" name="correoEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="nacimientoEmpleado">Fecha nacimiento</label>
                                        <input type="text" class="form-control calendario" id="nacimientoEmpleado" name="nacimientoEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="ingresoEmpleado">Ingreso Hospital</label>
                                        <input type="text" class="form-control calendario" id="ingresoEmpleado" name="ingresoEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="salarioEmpleado">Salario</label>
                                        <input type="text" class="form-control" id="salarioEmpleado" name="salarioEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                        <label for="areaEmpleado">Area</label>
                                        <select class="form-control" id="areaEmpleado" name="areaEmpleado" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($areas as $row) {
                                            ?>
                                            <option value="<?php echo $row->idArea;?>"><?php echo $row->nombreArea;?></option>
                                            <?php
                                                }
                                            ?>

                                        </select>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>

                                    <div class="col-xl-12 mb-3">
                                        <label for="direccionEmpleado">Dirección</label>
                                        <input type="text" class="form-control" id="direccionEmpleado" name="direccionEmpleado" required>
                                        <div class="valid-feedback">Muy bien!</div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" type="submit">Guardar datos <i class="fe fe-save"></i></button>
                                </div>
                                    
                            </form>
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


<script>
    $(function() {
        $('.calendario').datepicker({
            'format': 'yyyy-m-d',
				'autoclose': true
        });

        $('input[id="telefonoEmpleado"]').mask('0000-0000');
        $('input[id="duiEmpleado"]').mask('000000000');

    });
</script>