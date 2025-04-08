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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Datos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista clientes</li>
                        </ol>
                    </div>
                    <a href="<?php echo base_url(); ?>Clientes/" class="btn btn-primary"> Lista clientes <i class="fe fe-file"></i></a>
                </div>
            <!-- page-header end -->

            <!-- row open -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title uppercase"><label for=""><strong>DATOS DEL CLIENTE</strong></label></h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" method="post" action="<?= base_url(); ?>Clientes/guardar_cliente" novalidate>
                                    <div class="form-row">

                                        <div class="col-xl-12 mb-6">
                                            <label for="codigoCliente"><strong>Código</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $codigo; ?>" id="" name="" readonly>
                                            <input type="hidden" class="form-control" value="<?php echo $codigo; ?>" id="codigoCliente" name="codigoCliente" required="">
                                            <div class="invalid-tooltip"></div>
                                        </div>
                                        
                                        <div class="col-xl-6 mb-6">
                                            <label for="documentoCliente"><strong>Documento</strong></label>
                                            <input type="text" class="form-control" id="documentoCliente" name="documentoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de documento</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="nombreCliente"><strong>Nombre completo</strong></label>
                                            <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el nombre</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="telefonoCliente"><strong>Teléfono</strong></label>
                                            <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de teléfono</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="correoCliente"><strong>Correo</strong></label>
                                            <input type="text" class="form-control" id="correoCliente" name="correoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de teléfono</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="paisCliente"><strong>Pais</strong></label>
                                            <select class="form-control select2-show-search form-select" id="paisCliente" name="paisCliente" required="">
                                                <option selected disabled value="">.::Seleccionar::.</option>
                                                <?php
                                                    foreach ($paises as $row) {
                                                ?>
                                                    <option value="<?php echo $row->idPais;?>"><?php echo $row->nombrePais;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">Debes seleccionar un pais</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="estadoCliente"><strong>Departamento/Estado</strong></label>
                                            <select class="form-control select2-show-search form-select" id="estadoCliente" name="estadoCliente" required="">
                                                <option selected disabled value="">.::Seleccionar::.</option>
                                                <?php
                                                    foreach ($estados as $row) {
                                                ?>
                                                    <option value="<?php echo $row->idEstado;?>"><?php echo $row->nombreEstado;?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">Debes seleccionar una opcion</div>
                                        </div>


                                        <div class="col-xl-12 mb-6">
                                            <label for="direccionCliente"><strong>Dirección</strong></label>
                                            <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de dirección</div>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="text-center mt-5">
                                        <input type="hidden" class="form-control" id="strPais" name="strPais" required="">
                                        <input type="hidden" class="form-control" id="strEstado" name="strEstado" required="">
                                        <button class="btn btn-primary" type="submit">Guardar datos <i class="fe fe-save"></i></button>
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
    $(function() {
        $("#estadoCliente").prop("disabled", true);
        
        // $('#telefonoCliente').mask('9999-9999');
        
    });

    $(document).on("change", "#paisCliente", function(){
        var value = $(this).val(); // Obtiene el value seleccionado
        var text = $("#paisCliente option:selected").text(); // Obtiene el texto visible
        var strPais = value  +"-"+text;
        $("#strPais").val(strPais);


        // Obteneiendo estados
            $('#estadoCliente').each(function(){
                $('#estadoCliente option').remove();
            })
            $.ajax({
                url: "../obtener_estados",
                type: "GET",
                data: {id:value},
                success:function(respuesta){
                    var registro = eval(respuesta);
                        if (registro.length > 0)
                        {
                            var estado = '<option selected disabled value="">.::Seleccionar::.</option>';
                            for (var i = 0; i < registro.length; i++) 
                            {
                                estado += "<option value='"+ registro[i]["idEstado"] +"'>"+ registro[i]["nombreEstado"]+"</option>";
                            }
                            $("#estadoCliente").append(estado);
                        }
                    }
                });
        // Obteneiendo estados

        $("#estadoCliente").prop("disabled", false);
    });

    $(document).on("change", "#estadoCliente", function(){
        var value = $(this).val(); // Obtiene el value seleccionado
        var text = $("#estadoCliente option:selected").text(); // Obtiene el texto visible
        var strPais = value  +"-"+text;
        $("#strEstado").val(strPais);

    });

    $(document).on("change", "#documentoCliente", function(){
        event.preventDefault();
        var datos = {
            documento: $(this).val(),
        }

        $.ajax({
            url: "../validar_cliente",
            type: "POST",
            data: datos,
            success:function(respuesta){
                var registro = eval(respuesta);
                if (registro.length > 0){
                    // alert("El cliente que deseas ingresar ya existe!!!");
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
                    toastr.error('Ya existe un cliente registrado con este documento', 'Aviso!');

                    $("#documentoCliente").val("");
                }
            }
        });

    });


   

</script>