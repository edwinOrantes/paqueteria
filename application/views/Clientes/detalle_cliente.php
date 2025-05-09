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
                            <li class="breadcrumb-item active" aria-current="page">Datos del cliente</li>
                        </ol>
                    </div>
                    <a href="<?php echo base_url(); ?>Clientes/" class="btn btn-primary"><i class="fe fe-arrow-left"></i> Volver </a>
                </div>
            <!-- page-header end -->

            <!-- row open -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12 alert-info p-6">
                                <h3 class="card-title">Datos del cliente</h3>
                                <table class="table table-borderless mt-3">
                                    <tr>
                                        <td class="text-black"><strong>Código : </strong></td>
                                        <td><?php echo $cliente->codigoCliente; ?></td>
                                        <td class="text-black"><strong>Nombre: </strong></td>
                                        <td><?php echo str_replace("-", " ", $cliente->nombreCliente); ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-black"><strong>Teléfono: </strong></td>
                                        <td><?php echo $cliente->telefonoCliente; ?></td>
                                        <td class="text-black"><strong>DUI: </strong></td>
                                        <td><?php echo $cliente->documentoCliente; ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="text-black"><strong>Dirección: </strong></td>
                                        <td><?php echo $cliente->direccionCliente; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="panel panel-primary">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li><a href="#enviadas" class="" data-bs-toggle="tab">Enviadas <span class="badge bg-success"><?php echo count($enviadas); ?></span> </a></li>
                                            <li><a href="#recibidas" data-bs-toggle="tab" class="">Recibidas <span class="badge bg-success"><?php echo count($recibidas); ?></span> </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="enviadas">
                                            <?php
                                                if(sizeof($enviadas) > 0){
                                            ?>

                                                <table class="table table-bordered text-nowrap border-bottom" id="">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th class="border-bottom-0 text-center text-white"><strong>Código</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Receptor</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Estado del pago</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Estado del envio</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Dirección</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Opción</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $estadoOrden = "";
                                                            foreach ($enviadas as $row) {
                                                        ?>
                                                            <tr>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->codigoOrden; ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo str_replace("-", " ", $row->receptorOrden); ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->estadoPago; ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->nombreEstado; ?></td>
                                                                <td class="border-bottom-0 text-center">
                                                                    <?php 
                                                                        $pais = explode("-", $row->strPais);
                                                                        $estado = explode("-", $row->strEstado);
                                                                        echo $row->destinoOrden.", ".$estado[1].", ".$pais[1];
                    
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="hidden" value="<?php echo $row->idOrden; ?>" class="idOrden">
                                                                    <a href="#validarEntrega" data-bs-toggle="modal" class="btn btn-primary btn-sm validarEntrega"><i class="fa fa-file"></i> Ver </a>
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

                                        <div class="tab-pane" id="recibidas">
                                            <?php
                                                if(sizeof($recibidas) > 0){
                                            ?>

                                                <table class="table table-bordered text-nowrap border-bottom" id="">
                                                    <thead>
                                                        <tr class="bg-primary">
                                                            <th class="border-bottom-0 text-center text-white"><strong>Código</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Receptor</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Estado del pago</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Estado del envio</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Dirección</strong></th>
                                                            <th class="border-bottom-0 text-center text-white"><strong>Opción</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $estadoOrden = "";
                                                            foreach ($recibidas as $row) {
                                                        ?>
                                                            <tr>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->codigoOrden; ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo str_replace("-", " ", $row->receptorOrden); ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->estadoPago; ?></td>
                                                                <td class="border-bottom-0 text-center"><?php echo $row->nombreEstado; ?></td>
                                                                <td class="border-bottom-0 text-center">
                                                                    <?php 
                                                                        $pais = explode("-", $row->strPais);
                                                                        $estado = explode("-", $row->strEstado);
                                                                        echo $row->destinoOrden.", ".$estado[1].", ".$pais[1];
                    
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <input type="hidden" value="<?php echo $row->idOrden; ?>" class="idOrden">
                                                                    <a href="#validarEntrega" data-bs-toggle="modal" class="btn btn-primary btn-sm validarEntrega"><i class="fa fa-file"></i> Ver </a>
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
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
        <!-- container closed -->
    </div>
</div>
<!--app-content closed-->