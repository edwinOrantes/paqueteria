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
                        <a href="<?php echo base_url(); ?>Empleado/" class="btn btn-primary"> Agregar empleado <i class="fe fe-user-plus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de Empleados</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($empleados) != 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="text-white text-center" scope="col">#</th>
                                                <th class="text-white text-center" scope="col">Nombre</th>
                                                <th class="text-white text-center" scope="col">Cargo</th>
                                                <th class="text-white text-center" scope="col">Telefono</th>
                                                <th class="text-white text-center" scope="col">Dirección</th>
                                                <th class="text-white text-center" scope="col">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                    $index = 0;
                                                foreach ($empleados as $empleado) {
                                                      $index++;
                                                      $id ='"'.$empleado->idEmpleado.'"';
                                                      $nombre = '"'.$empleado->nombreEmpleado.'"';
                                                      $edad = '"'.$empleado->edadEmpleado.'"';
                                                      $telefono = '"'.$empleado->telefonoEmpleado.'"';
                                                      $cargo = '"'.$empleado->cargoEmpleado.'"';
                                                      $cargoN = '"'.$empleado->nombreCargo.'"';
                                                      $sexo = '"'.$empleado->sexoEmpleado.'"';
                                                      $estado = '"'.$empleado->estadoEmpleado.'"';
                                                      $direccion = '"'.$empleado->direccionEmpleado.'"';
                                                      $ingreso = '"'.$empleado->ingresoEmpleado.'"';
                                            ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $index; ?></td>
                                                        <td><?php echo $empleado->nombreEmpleado; ?></td>
                                                        <td><?php echo $empleado->nombreCargo; ?></td>
                                                        <td><?php echo $empleado->telefonoEmpleado; ?></td>
                                                        <td><?php echo $empleado->direccionEmpleado; ?></td>
                                                        <td>
                                                        <?php
                                                            // echo "<a onclick='verEmpleado($id, $nombre, $edad, $telefono, $cargoN, $sexo, $estado, $direccion)' href='#verEmpleado' data-bs-toggle='modal'><i class='fa fa-eye iconoPlus text-primary'></i></a> ";
                                                            echo "<a onclick='actualizarEmpleado($id, $nombre, $edad, $telefono, $cargo, $sexo, $estado, $direccion)' href='#actualizarEmpleado' data-bs-toggle='modal'><i class='fa fa-edit iconoPlus text-success'></i></a> ";
                                                            echo "<a onclick='eliminarEmpleado($id)' href='#eliminarEmpleado' data-bs-toggle='modal'><i class='fa fa-trash iconoPlus text-danger'></i></a> ";
                                                        ?>
                                                        </td>
                                                    </tr>
                
                                            <?php
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
    <div class="modal fade" id="actualizarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/actualizar_empleado" novalidate>
                        <div class="modal-body">   
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for=""><strong>Nombre completo</strong></label>
                                    <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado"
                                        placeholder="Nombre del empleado" required>
                                    <div class="invalid-tooltip">
                                        Debes ingresar el nombre del empleado.
                                    </div>
                                </div>                                
                            </div>
    
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""><strong>Edad</strong></label>
                                    <input type="number" class="form-control" min="0" id="edadEmpleado" name="edadEmpleado"
                                        placeholder="Edad del empleado" required>
                                    <div class="invalid-tooltip">
                                        Debes ingresar la edad del empleado.
                                    </div>
                                </div>
    
                                <div class="form-group col-md-6">
                                    <label for=""><strong>Teléfono</strong></label>
                                    <input type="text" class="form-control" id="telefonoEmpleado"
                                        name="telefonoEmpleado" placeholder="Teléfono del empleado" required>
                                    <div class="invalid-tooltip">
                                        Debes ingresar el teléfono del empleado.
                                    </div>
                                </div>
    
                                <div class="form-group col-md-6">
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
    
                                <div class="form-group col-md-6">
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
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                            <input type="hidden" class="form-control" id="idEmpleado" name="idEmpleado">
                                <button class="btn btn-primary" type="submit">Actualizar datos <i class="fe fe-save"></i></button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal  fade" id="eliminarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleado/eliminar_empleado" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </a>
                    </div>
                    <div class="modal-body">
                        <p class="h5">¿Estas seguro de eliminar los datos de este empleado ?</p>
                        <input type="hidden" id="empleadoEliminar" name="idEmpleado" />
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
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

    $(document).on("click", "#btnEditarDatos", function(event) {
        event.preventDefault();
        
        $("#nombreClienteU").val($(this).closest('tr').find('#nombre').val());
        $("#telefonoClienteU").val($(this).closest('tr').find('#telefono').val());
        $("#documentoClienteU").val($(this).closest('tr').find('#documento').val());
        $("#direccionClienteU").val($(this).closest('tr').find('#direccion').val()); 
        $("#idClienteU").val($(this).closest('tr').find('#idCliente').val());
 
    });

    $(document).on("click", "#btnEliminarDatos", function(event) {
        event.preventDefault();
        $("#idClienteE").val($(this).closest('tr').find('#idCliente').val()); 
    });

    function actualizarEmpleado(id, nombre, edad, telefono, cargo, sexo, estado, direccion) {
        $("#idEmpleado").val(id);
        $("#nombreEmpleado").val(nombre);
        $("#edadEmpleado").val(edad);
        $("#telefonoEmpleado").val(telefono);
        $("#cargoEmpleado").val(cargo);
        $("#sexoEmpleado").val(sexo);
        $("#direccionEmpleado").val(direccion);
    }

    function eliminarEmpleado(id) {
        $("#empleadoEliminar").val(id);
    }

</script>

