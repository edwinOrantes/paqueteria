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

<style>
    label strong{
        font-weight: bold
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Reportes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ordenes</li>         
                        </ol>
                    </div>
                </div>
            <!-- page-header end -->

            <!-- row open -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title uppercase"><label for=""><strong>SELECCIONE LOS DATOS</strong></label></h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" method="post" target="_blank" action="<?= base_url(); ?>Reportes/pivote_ordenes_fecha" novalidate>
                                    <div class="form-row">

                                        <div class="col-xl-3 mb-6">
                                            <label for="fechaInicio"><strong>Fecha inicio</strong></label>
                                            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required="">
                                            <div class="invalid-tooltip">Este campo es obligatorio</div>
                                        </div>

                                        <div class="col-xl-3 mb-6">
                                            <label for="fechaFin"><strong>Fecha fin</strong></label>
                                            <input type="date" class="form-control" id="fechaFin" name="fechaFin" required="">
                                            <div class="invalid-tooltip">Este campo es obligatorio</div>
                                        </div>

                                        <div class="col-xl-3 mb-6">
                                            <label for="tipoReporte"><strong>Tipo</strong></label>
                                            <select class="form-control" id="tipoReporte" name="tipoReporte" required="">
                                                <option selected disabled value="">.::Seleccionar::.</option>
                                                <option value="1">Excel</option>
                                                <option value="2">PDF</option>
                                                
                                            </select>
                                            <div class="invalid-tooltip">Este campo es obligatorio</div>
                                        </div>

                                        <div class="col-xl-3 mb-6">
                                            <br>
                                            <button class="btn btn-primary btn-block">Crear</button>
                                        </div>

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
    $(document).on("change", "#fechaInicio", function() {
        $("#fechaFin").val($(this).val());
    });
</script>