<?php if($this->session->flashdata("exito")):?>
  <script type="text/javascript">
        $(document).ready(function(){
        toastr.remove();
            toastr.options = {
                "positionClass": "toast-top-center",
                "showDuration": "3000",
                "hideDuration": "3000",
                "timeOut": "3000",
                "extendedTimeOut": "50",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                },
            toastr.success('<?php echo $this->session->flashdata("exito")?>', 'Aviso!');

        });
    </script>
    <?php endif; ?>

<?php if($this->session->flashdata("error")):?>
  <script type="text/javascript">
    $(document).ready(function(){
      toastr.remove();
        toastr.options = {
            "positionClass": "toast-top-center",
            "showDuration": "3000",
            "hideDuration": "3000",
            "timeOut": "3000",
            "extendedTimeOut": "50",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            },
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
                            <li class="breadcrumb-item active" aria-current="page">Datos de la orden</li>
                        </ol>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-primary mt-3" href="<?php echo base_url(); ?>Envios/lista_envios"><i class="fe fe-arrow-left"></i> Volver </a>
                        
                    </div>
                </div>
            <!-- page-header end -->

            <!-- row open -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Maletas del Envío</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($envios as $idMaleta => $maleta){ ?>
    
                                        <div class="col-md-4 text-center">
                                            <strong>Maleta #<?= $maleta['codigoMaleta'] ?></strong> | Tipo: <?php echo $maleta['tipoMaleta'] ==1 ? "Maleta": "De mano" ?>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr  class="bg-primary">
                                                        <th class="text-center text-white">#</th>
                                                        <th class="text-center text-white">Código</th>
                                                        <th class="text-center text-white">Detalle</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php 
                                                    $index = 1;
                                                        foreach ($maleta['ordenes'] as $orden){ 
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $index ?></td>
                                                            <td class="text-center"><?php echo $orden['codigoOrdenMaleta'] ?></td>
                                                            <td class="text-center"><?php echo $orden['strDetalle'] ?></td>
                                                        </tr>
                                                    <?php 
                                                            $index++;
                                                        } 
                                                    ?>
                                                </tbody>


                                            </table>
                                        </div>
                                        
                                        <!-- <div class="mb-3">
                                            <div class="card-header">
                                               
                                            </div>
                                            <div class="card-body">
                                                <ul>
                                                    <?php foreach ($maleta['ordenes'] as $orden): ?>
                                                        <li><strong><?= $orden['codigoOrdenMaleta'] ?>:</strong> <?= $orden['strDetalle'] ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div> -->
                                    <?php }?>
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