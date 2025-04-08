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
                                        <td><?php echo $cliente->nombreCliente; ?></td>
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
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
        <!-- container closed -->
    </div>
</div>
<!--app-content closed-->