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
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de ordenes pendientes de entrega</h3>
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
                                                    <td class="border-bottom-0 text-center"><?php echo str_replace("-", " ", $row->emisorOrden); ?></td>
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
                                                        <a href="#validarEntrega" data-bs-toggle="modal" class="btn btn-primary btn-sm validarEntrega"><i class="fa fa-check"></i> Entregado </a>
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
    <div class="modal  fade" id="validarEntrega" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Entregas/paquete_entregado/" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">¿El paquete ha sido entregado?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idOrdenU" name="idOrden">
                        <button class="btn btn-danger">Si</button>
                        <a href="#" class="btn btn-default" data-bs-dismiss="modal">No</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modales -->



<script>
    $(document).on("click", ".validarEntrega", function(event) {
        event.preventDefault();
        $("#idOrdenU").val($(this).closest('tr').find('.idOrden').val());
    });
    
</script>