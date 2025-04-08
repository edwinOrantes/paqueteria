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
                                <h3 class="card-title uppercase"><label for=""><strong>DATOS DEL CLIENTE</strong></label></h3>
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" method="post" action="<?= base_url(); ?>Clientes/actualizar_cliente" novalidate>
                                    <div class="form-row">

                                        <div class="col-xl-12 mb-6">
                                            <label for="codigoCliente"><strong>Código</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->codigoCliente; ?>" id="" name="" readonly>
                                            <div class="invalid-tooltip"></div>
                                        </div>
                                        
                                        <div class="col-xl-6 mb-6">
                                            <label for="documentoCliente"><strong>Documento</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->documentoCliente; ?>"  id="documentoCliente" name="documentoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de documento</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="nombreCliente"><strong>Nombre completo</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->nombreCliente; ?>" id="nombreCliente" name="nombreCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el nombre</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="telefonoCliente"><strong>Teléfono</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->telefonoCliente; ?>" id="telefonoCliente" name="telefonoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de teléfono</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="correoCliente"><strong>Correo</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->correoCliente; ?>" id="correoCliente" name="correoCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de teléfono</div>
                                        </div>

                                        <div class="col-xl-6 mb-6">
                                            <label for="paisCliente"><strong>País</strong></label>
                                            <select class="form-control select2-show-search form-select" id="paisCliente" name="paisCliente" required="">
                                                <option selected disabled value="">.::Seleccionar::.</option>
                                                <?php
                                                    foreach ($paises as $row) {
                                                        // Verifica si el país del cliente coincide con la opción
                                                        $selected = ($cliente->paisCliente == $row->idPais) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $row->idPais; ?>" <?php echo $selected; ?>> <?php echo $row->nombrePais; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">Debes seleccionar un país</div>
                                        </div>


                                        <div class="col-xl-6 mb-6">
                                            <label for="estadoCliente"><strong>Departamento/Estado</strong></label>
                                            <select class="form-control select2-show-search form-select" id="estadoCliente" name="estadoCliente" required="">
                                                <option selected disabled value="">.::Seleccionar::.</option>
                                                <?php
                                                    foreach ($estados as $row) {
                                                        // Verifica si el estado del cliente coincide con la opción
                                                        $selected = ($cliente->distritoCliente == $row->idEstado) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $row->idEstado; ?>" <?php echo $selected; ?>> <?php echo $row->nombreEstado; ?> </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">Debes seleccionar una opción</div>
                                        </div>



                                        <div class="col-xl-12 mb-6">
                                            <label for="direccionCliente"><strong>Dirección</strong></label>
                                            <input type="text" class="form-control" value="<?php echo $cliente->direccionCliente; ?>" id="direccionCliente" name="direccionCliente" required="">
                                            <div class="invalid-tooltip">Debes agregar el número de dirección</div>
                                        </div>
                                        
                                        
                                    </div>

                                    <div class="text-center mt-5">
                                        <input type="hidden" class="form-control" value="<?php echo $cliente->strPais; ?>" id="strPais" name="strPais" required="">
                                        <input type="hidden" class="form-control" value="<?php echo $cliente->strEstado; ?>" id="strEstado" name="strEstado" required="">
                                        <input type="hidden" class="form-control" value="<?php echo $cliente->idCliente; ?>" id="idCliente" name="idCliente" required="">
                                        <button class="btn btn-primary" type="submit">Actualizar datos <i class="fe fe-save"></i></button>
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
                url: "../../obtener_estados",
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


</script>

   
