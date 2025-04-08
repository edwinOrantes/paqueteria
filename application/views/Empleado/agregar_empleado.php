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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Empleados</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Agregar empleados</li>
                        </ol>
                    </div>
                    <a href="<?php echo base_url(); ?>Empleado/lista_empleados" class="btn btn-primary"> Lista empleados <i class="fe fe-users"></i></a>
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
                            <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/agregar_empleado" novalidate>
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for=""><strong>Nombre completo</strong></label>
                                        <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado"
                                            placeholder="Nombre del empleado" required>
                                        <div class="invalid-tooltip">
                                            Debes ingresar el nombre del empleado.
                                        </div>
                                    </div>
        
        
                                    <div class="form-group col-md-4">
                                        <label for=""><strong>Edad</strong></label>
                                        <input type="number" class="form-control" min="0" id="edadEmpleado" name="edadEmpleado"
                                            placeholder="Edad del empleado" required>
                                        <div class="invalid-tooltip">
                                            Debes ingresar la edad del empleado.
                                        </div>
                                    </div>
        
                                </div>
        
                                <div class="row">
        
                                    <div class="form-group col-md-4">
                                        <label for=""><strong>Teléfono</strong></label>
                                        <input type="text" class="form-control" id="telefonoEmpleado"
                                            name="telefonoEmpleado" placeholder="Teléfono del empleado" required>
                                        <div class="invalid-tooltip">
                                            Debes ingresar el teléfono del empleado.
                                        </div>
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label for=""><strong>Ocupación</strong></label>
                                        <select class="form-control" id="cargoEmpleado" name="cargoEmpleado" required>
                                            <option value="">.:: Seleccionar ::.</option>
                                            <?php
                                                foreach ($cargos as $cargo) {
                                            ?>
                                            <option value="<?php echo $cargo->idCargo; ?>"><?php echo $cargo->nombreCargo; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Debes ingresar la ocupación empleado.
                                        </div>
                                    </div>
        
                                    <div class="form-group col-md-4">
                                        <label for=""><strong>Sexo</strong></label>
                                        <select class="form-control" id="sexoEmpleado" name="sexoEmpleado" required>
                                            <option value=""> .:: Seleccionar ::.</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                        <div class="invalid-tooltip">
                                            Debes seleccionar el sexo empleado.
                                        </div>
                                    </div>
        
                                </div>
    
        
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for=""><strong>Dirección completa</strong></label>
                                        <input type="text" class="form-control" id="direccionEmpleado" name="direccionEmpleado"
                                            required>
                                        <div class="invalid-tooltip">
                                            Debes ingresar dirección del empleado.
                                        </div>
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