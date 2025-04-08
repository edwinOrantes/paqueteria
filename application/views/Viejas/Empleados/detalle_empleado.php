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
                            <li class="breadcrumb-item active" aria-current="page">Datos del empleado</li>
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
                            <div class="col-md-12 alert-info p-6">
                                <h3 class="card-title">Datos del empleado</h3>
                                <table class="table table-borderless mt-3">
                                    <tr>
                                        <td class="text-black"><strong>Nombre: </strong></td>
                                        <td><?php echo $empleado->nombreEmpleado; ?></td>
                                        <td class="text-black"><strong>Area : </strong></td>
                                        <td><?php echo $empleado->nombreArea; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-black"><strong>Teléfono: </strong></td>
                                        <td><?php echo $empleado->telefonoEmpleado; ?></td>
                                        <td class="text-black"><strong>DUI: </strong></td>
                                        <td><?php echo $empleado->duiEmpleado; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-black"><strong>Tiempo laborando: </strong></td>
                                        <td><?php echo $empleado->nombreEmpleado; ?></td>
                                        <td class="text-black"><strong>Salario: </strong></td>
                                        <td><?php echo $empleado->salarioEmpleado; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-black"><strong>Dirección: </strong></td>
                                        <td><?php echo $empleado->direccionEmpleado; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="tab-menu-heading tab-menu-heading-boxed">
                                            <div class="tabs-menu tabs-menu-border">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li><a href="#tab29"  class="active" data-bs-toggle="tab">Permisos</a></li>
                                                    <li><a href="#tab30" data-bs-toggle="tab" class="">Incapacidades</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab29">
                                                    <?php
                                                        if(sizeof($permisos) > 0){
                                                    ?>
                                                    <table class="table table-striped table-inverse tblPlus">
                                                        <thead class="thead-inverse">
                                                            <tr class="bg-primary">
                                                                <th class="border-bottom-0 text-white text-center">#</th>
                                                                <th class="border-bottom-0 text-white text-center">Fecha</th>
                                                                <th class="border-bottom-0 text-white text-center">Motivo</th>
                                                                <th class="border-bottom-0 text-white text-center">Horas</th>
                                                                <th class="border-bottom-0 text-white text-center">De-Hasta</th>
                                                                <th class="border-bottom-0 text-white text-center">Autorización</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $flag = 1;
                                                                    foreach($permisos as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $flag; ?></td>
                                                                    <td class="text-center"><?php echo $row->diaPermiso; ?></td>
                                                                    <td class="text-center"><?php echo $row->nombreMotivoPermiso; ?></td>
                                                                    <td class="text-center"><?php echo $row->horasPermiso; ?></td>
                                                                    <td class="text-center"><?php echo $row->dePermiso."-".$row->hastaPermiso; ?></td>
                                                                    <td class="text-center"><?php echo $row->autorizacionPermiso; ?></td>
                                                                </tr>
                                                                <?php
                                                                        $flag++;
                                                                    }
                                                                ?>
                                                            </tbody>
                                                    </table>
                                                    <?php
                                                        }else{
                                                            echo '<div class="alert-danger p-3 text-center">No hay datos que mostrar...</div>';
                                                        }
                                                    ?>
                                                </div>
                                                <div class="tab-pane" id="tab30">
                                                    <?php
                                                        if(sizeof($incapacidades) > 0){
                                                    ?>
                                                    <table class="table table-striped table-inverse tblPlus">
                                                        <thead class="thead-inverse">
                                                            <tr class="bg-primary">
                                                                <th class="border-bottom-0 text-white text-center">#</th>
                                                                <th class="border-bottom-0 text-white text-center">Diagnóstico</th>
                                                                <th class="border-bottom-0 text-white text-center">Inicio</th>
                                                                <th class="border-bottom-0 text-white text-center">Fin</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $flag = 1;
                                                                    foreach($incapacidades as $row) {
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $flag; ?></td>
                                                                    <td class="text-center"><?php echo $row->diagnosticoIncapacidad; ?></td>
                                                                    <td class="text-center"><?php echo $row->deIncapacidad; ?></td>
                                                                    <td class="text-center"><?php echo $row->hastaIncapacidad; ?></td>
                                                                </tr>
                                                                <?php
                                                                        $flag++;
                                                                    }
                                                                ?>
                                                            </tbody>
                                                    </table>
                                                    <?php
                                                        }else{
                                                            echo '<div class="alert-danger p-3 text-center">No hay datos que mostrar...</div>';
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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