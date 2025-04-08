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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Empresa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Datos de la empresa</li>
                        </ol>
                    </div>
                    <?php
                        if(is_null($empresa)){
                            echo '<a href="#agregarInformacion" data-bs-toggle="modal" class="btn btn-primary"> Agregar datos <i class="fe fe-plus"></i>  </a>';
                        }else{
                            echo '<a href="#editarInformacion" data-bs-toggle="modal" class="btn btn-info"> Editar datos <i class="fe fe-edit"></i>  </a>';
                        }
                    ?>
                    
                </div>
            <!-- page-header end -->

            <!-- row open -->
            <?php
                if(!is_null($empresa)){
            ?>
                <div class="row">
                    </div>
                    <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" alt="Logo de la empresa" style="width: 250px">
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 alert-info p-6">
                                    <h3 class="">Información</h3>
                                    <table class="table table-borderless mt-3">
                                        <tr>
                                            <td class="text-black h4"><strong>Nombre : </strong></td>
                                            <td class="h3"><?php echo $empresa->nombreEmpresa; ?></td>
                                            <td class="text-black h4"><strong>Teléfono: </strong></td>
                                            <td class="h3"><?php echo $empresa->telefonoEmpresa; ?></td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-black h4"><strong>Dirección: </strong></td>
                                            <td class="h3"><?php echo $empresa->direccionEmpresa; ?></td>
                                            <!-- <td class="text-black"><strong>DUI: </strong></td>
                                            <td class="h3"><?php echo $empresa->documentoCliente; ?></td> -->
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }else{
                    echo '<div class="alert-danger p-3 text-center">No hay datos que mostrar</div>';
                }
            ?>
            <!-- row closed -->
        </div>
        <!-- container closed -->
    </div>
</div>
<!--app-content closed-->

<!-- Modales -->
    <div class="modal fade" id="agregarInformacion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos de la empresa</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" enctype="multipart/form-data" method="post" action="<?= base_url(); ?>Empresa/guardar_informacion" novalidate>
                        <div class="modal-body">   
                            <div class="form-row">

                                <div class="col-xl-12 mb-3">
                                    <label for="nombreEmpresa">Nombre</label>
                                    <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-6 mb-3">
                                    <label for="telefonoEmpresa">Teléfono</label>
                                    <input type="text" class="form-control" id="telefonoEmpresa" name="telefonoEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="direccionEmpresa">Dirección</label>
                                    <input type="text" class="form-control" id="direccionEmpresaU" name="direccionEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="logoEmpresa">Logo</label>
                                    <input type="file" class="form-control" id="logoEmpresa" name="logoEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit">Guardar datos <i class="fe fe-save"></i></button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editarInformacion" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos de la empresa</h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" enctype="multipart/form-data" method="post" action="<?= base_url(); ?>Empresa/actualizar_informacion" novalidate>
                        <div class="modal-body"> 
                            <div class="form-row mb-2">
                                <div class="col-md-5"></div>
                                <div class="col-md-2">
                                    <img class="center" src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" alt="Logo de la empresa" style="width: 250px">

                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <div class="form-row">

                                <div class="col-xl-12 mb-3">
                                    <label for="nombreEmpresa">Nombre</label>
                                    <input type="text" class="form-control" value="<?php echo $empresa->nombreEmpresa?>" id="nombreEmpresaU" name="nombreEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-6 mb-3">
                                    <label for="telefonoEmpresa">Teléfono</label>
                                    <input type="text" class="form-control" value="<?php echo $empresa->telefonoEmpresa?>" id="telefonoEmpresaU" name="telefonoEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="direccionEmpresa">Dirección</label>
                                    <input type="text" class="form-control" value="<?php echo $empresa->direccionEmpresa?>" id="direccionEmpresaU" name="direccionEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="logoEmpresa">Logo</label>
                                    <input type="file" class="form-control"  id="logoEmpresaU" name="logoEmpresa">
                                    <input type="hidden" value="" name="logoEmpresa" required>
                                    <input type="hidden" value="<?php echo $empresa->idEmpresa?>" id="idEmpresaU" name="idEmpresa" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <button class="btn btn-primary" type="submit">Actualizar datos <i class="fe fe-save"></i></button>
                            </div>
                        </div>   
                    </form>
            </div>
        </div>
    </div>
<!-- Modales -->