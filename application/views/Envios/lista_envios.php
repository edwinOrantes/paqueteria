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

<style>
    .fa-1x{
        font-size: 20px;
    }
</style>
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
                                <li class="breadcrumb-item active" aria-current="page">Lista envios</li>
                            </ol>
                        </div>
                        <a href="<?php echo base_url(); ?>Envios/" class="btn btn-primary"> Agregar envio <i class="fe fe-file-plus iconoPlus"></i></a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de envios</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    
                                <?php
                                    if(sizeof($envios) > 0){
                                ?>

                                    <table class="table table-bordered text-nowrap border-bottom" id="tblOrdenes">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-center text-white"><strong>#</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Código</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Gestor</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Fecha de envio</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Destino</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Opción</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $index = 1;
                                                foreach ($envios as $row) {
                                            ?>
                                                <tr>
                                                    <td class="border-bottom-0 text-center"><?php echo $index; ?></td>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->codigoEnvio; ?></td>
                                                    <td class="border-bottom-0 text-center">
                                                        <?php 
                                                            if($row->gestorEnvio > 0){
                                                                echo $row->strGestor; 
                                                            }else{
                                                                echo '<a href="#asignarGestor" data-bs-toggle="modal" title="Asignar gestor">
                                                                        <span class="badge bg-danger badge-sm asignarGestor" style="cursor: pointer">Sin asignar</span>
                                                                      </a>';
                                                            }
                                                        ?>
                                                    </td> 
                                                    <td class="border-bottom-0 text-center"><?php echo $row->fechaEnvio; ?></td>
                                                    <td class="border-bottom-0 text-center"><?php echo $row->nombreDestino; ?></td>

                                                    <td class="text-center">
                                                        <input type="hidden" value="<?php echo $row->idEnvio; ?>" class="idEnvio">
                                                        <!-- Dropdown de acciones -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                Acciones
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" data-id="1" href="<?php echo base_url(); ?>Envios/ver_detalle_envio/<?php echo $row->idEnvio;?>/" class="text-primary" title="Ver detalle"></i>Ver</a></li>
                                                                <li><a class="dropdown-item" href="<?php echo base_url(); ?>Envios/detalle_envio/<?php echo $row->idEnvio;?>/" data-id="2">Editar</a></li>
                                                                <!-- <li><a class="dropdown-item" target="blank" href="<?php echo base_url(); ?>Ordenes/ver_etiquetas/<?php echo $row->idOrden;?>/" data-id="4">Imprimir viñetas</a></li> -->
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
    <div class="modal fade" id="asignarGestor" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">DSeleccionar el gestor</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
                </div>
                <form class="needs-validation" method="post" action="<?= base_url(); ?>Envios/asignar_gestor" novalidate>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-xl-12 mb-6">
                                <label for="idGestor"><strong>Gestor</strong></label>
                                <select class="form-control" id="idGestor" name="idGestor" required="">
                                    <option selected disabled value="">.::Seleccionar::.</option>
                                    <?php
                                        foreach ($gestores as $row) {
                                    ?>
                                        <option value="<?php echo $row->idEmpleado;?>"><?php echo $row->nombreEmpleado;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Debes seleccionar una opcion</div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="nombreGestor" name="nombreGestor">
                        <input type="hidden" id="idEnvioU" name="idEnvio">
                        <button class="btn btn-primary">Asignar</button>
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

    $(document).on("change", "#idGestor", function(event) {
        event.preventDefault();
        var valor = $(this).val();
        $("#nombreGestor").val($('#idGestor option:selected').text());
        
    });

    $(document).on("click", ".asignarGestor", function(event) {
        event.preventDefault();
        $("#idEnvioU").val($(this).closest('tr').find('.idEnvio').val()); 
    });
</script>