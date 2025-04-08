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
                                <li class="breadcrumb-item active" aria-current="page">Lista ordenes</li>
                            </ol>
                        </div>
                        <a href="<?php echo base_url(); ?>Ordenes/agregar_orden" class="btn btn-primary"> Agregar orden <i class="fe fe-file-plus iconoPlus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de ordenes</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    
                                <?php
                                    if(sizeof($ordenes) > 0){
                                ?>

                                    <table class="table table-bordered text-nowrap border-bottom" id="tblOrdenes">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-center text-white"><strong>Código</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Emisor</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Receptor</strong></th>
                                                <!-- <th class="border-bottom-0 text-center text-white"><strong>Costo</strong></th> -->
                                                <th class="border-bottom-0 text-center text-white"><strong>Estado del pago</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Estado del envio</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Dirección</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Opción</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $estadoOrden = "";
                                                foreach ($ordenes as $row) {
                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->codigoOrden; ?></td>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->emisorOrden; ?></td>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->receptorOrden; ?></td>
                                                    <!-- <td class="border-bottom-0 text-center">$<?php echo number_format($row->totalPaquete, 2); ?></td> -->
                                                    <td class="border-bottom-0 text-center"><?php echo $row->estadoPago; ?></strong></td>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->nombreEstado; ?></strong></td>
                                                    <td class="border-bottom-0 text-center">
                                                        <?php 
                                                            $pais = explode("-", $row->strPais);
                                                            $estado = explode("-", $row->strEstado);
                                                            echo $row->destinoOrden.", ".$estado[1].", ".$pais[1];
        
                                                        ?>
                                                    </td>
                                                    <!-- <td class="border-bottom-0 text-center">
                                                        <?php
                                                            if($row->creoQR == 1){
                                                                echo '<a href="'.base_url().'Ordenes/etiqueta_pdf/'.$row->idOrden.'/" class="text-primary" title="Ver etiquetas"><i class="fa fa-file iconoPlus"></i></a>';
                                                            }
                                                        ?>
                                                        
                                                        
                                                        
                                                        
                                                    </td> -->

                                                    <td class="text-center">
                                                        <!-- Dropdown de acciones -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Acciones
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" data-id="1" href="<?php echo base_url(); ?>Ordenes/detalle_orden/<?php echo $row->idOrden;?>/" class="text-primary" title="Ver detalle"></i>Ver</a></li>
                                                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>Ordenes/editar_detalle_orden/<?php echo $row->idOrden;?>/" data-id="2">Editar</a></li>
                                                                <li><a class="dropdown-item" href="#" data-id="3">Eliminar</a></li>
                                                                <li><a class="dropdown-item" target="blank" href="<?php echo base_url(); ?>Ordenes/ver_etiquetas/<?php echo $row->idOrden;?>/" data-id="4">Imprimir viñetas</a></li>
                                                                <li><a class="dropdown-item" target="blank" href="<?php echo base_url(); ?>Ordenes/ver_hoja_envio/<?php echo $row->idOrden;?>/" data-id="5">Imprimir hoja resumen</a></li>
                                                            </ul>
                                                        </div>
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
    <div class="modal fade" id="editarEmpleado" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del empleado</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                <form class="needs-validation" method="post" action="<?= base_url(); ?>Empleados/actualizar_empleado" novalidate>
                    <div class="modal-body">
                        <div class="form-row">

                            <div class="col-xl-6 mb-3">
                                <label for="nombreEmpleado">Nombre completo</label>
                                <input type="text" class="form-control" id="nombreEmpleadoU" name="nombreEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="telefonoEmpleado">Teléfono</label>
                                <input type="text" class="form-control" id="telefonoEmpleadoU" name="telefonoEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            <div class="col-xl-6 mb-3">
                                <label for="duiEmpleado">DUI</label>
                                <input type="text" class="form-control" id="duiEmpleadoU" name="duiEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="correoEmpleado">Correo electrónico</label>
                                <input type="email" class="form-control" id="correoEmpleadoU" name="correoEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="nacimientoEmpleado">Fecha nacimiento</label>
                                <input type="date" class="form-control calendario" id="nacimientoEmpleadoU" name="nacimientoEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="ingresoEmpleado">Ingreso Hospital</label>
                                <input type="date" class="form-control calendario" id="ingresoEmpleadoU" name="ingresoEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="salarioEmpleado">Salario</label>
                                <input type="text" class="form-control" id="salarioEmpleadoU" name="salarioEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>

                            <div class="col-xl-6 mb-3">
                                <label for="areaEmpleado">Area</label>
                                <select class="form-control" id="areaEmpleadoU" name="areaEmpleado" required>
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
                                <input type="text" class="form-control" id="direccionEmpleadoU" name="direccionEmpleado" required>
                                <div class="valid-feedback">Muy bien!</div>
                            </div>
                            
                            
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idEmpleadoU" name="idEmpleadoU">
                        <button class="btn btn-primary">Actualizar datos</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
</script>