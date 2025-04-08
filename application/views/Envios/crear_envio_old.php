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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Envios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Preparar</li>
                        </ol>
                    </div>
                    <!-- <a href="<?php echo base_url(); ?>Ordenes/" class="btn btn-primary"> Lista ordenes <i class="fe fe-file"></i></a> -->
                </div>
            <!-- page-header end -->

            <!-- row open -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Datos del envio</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmEnvio" action="" method="post">
                                <div class="form-row">
                                    <div class="col-xl-4 mb-3">
                                       <label for="gestorOrden"><strong>Gestor asignado</strong></label>
                                       <select class="form-control" id="gestorOrden" name="gestorOrden" required>
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               foreach ($gestores as $row) {
                                                   echo '<option value="'.$row->idEmpleado.'">'.$row->nombreEmpleado.'</option>';
                                               }
                                           ?>
                                       </select>
                                       <div class="valid-feedback">Muy bien!</div>
                                   </div>

                                    <div class="col-xl-4 mb-3">
                                       <label for="maletaEnvio"><strong>Maleta</strong></label>
                                       <select class="form-control" id="maletaEnvio" name="maletaEnvio" required>
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               for ($i=1; $i <= 10; $i++){
                                                    if($i == 1){
                                                        echo '<option value="'.$i.'" selected>Maleta '.$i.'</option>';
                                                    }else{
                                                        echo '<option value="'.$i.'">Maleta '.$i.'</option>';
                                                    }
                                                    
                                               }
                                           ?>
                                       </select>
                                       <div class="valid-feedback">Muy bien!</div>
                                   </div>

                                   <div class="col-xl-4 mb-3">
                                       <label for="scanPivote"><strong>Paquete</strong></label>
                                       <input type="text" class="form-control" id="scanPivote" />
                                       <div class="valid-feedback">Muy bien!</div>
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
    $(document).ready(function() {
        $("#scanPivote").focus();
    });

    $(document).on("change", "#gestorOrden, #maletaEnvio", function(event) {
        event.preventDefault();
        $("#scanPivote").focus();
    })

    $( "#frmEnvio" ).submit(function( event ) {
            event.preventDefault();
            var datos = {
                gestor : $("#gestorOrden").val(),
                maleta : $("#maletaEnvio").val(),
                paquete : $("#scanPivote").val(),
            }

            console.log(datos);
            $("#scanPivote").val("");

            

            $.ajax({
            url: "agregar_a_envio",
            type: "POST",
            beforeSend: function () { },
            data: datos,
            /* success:function(respuesta){
                    var registro = eval(respuesta);
                    if (registro.length > 0){
                        var html = "";
                        var index = 0;
                        for (var i = 0; i < registro.length; i++) {
                            index++;
                            html += "<tr>";
                            html += "    <td class='text-center'>"+index+"</td>";
                            html += "    <td class='text-center'>"+registro[i]["codigoMedicamento"]+"</td>";
                            html += "    <td class='text-center'>"+registro[i]["nombreMedicamento"]+"</td>";
                            html += "    <td class='text-center'>"+registro[i]["cantidadMedicamento"]+"</td>";
                            html += "    <td class='text-center' style='display: none'>"+registro[i]["idMedicamento"]+"</td>";
                            html += "    <td class='text-center' style='display: none'>"+registro[i]["idDetalleCuenta"]+"</td>";
                            html += "    <td class='text-center' style='display: none'>"+registro[i]["cantidadMedicamento"]+"</td>";
                            html += "</tr>";
                        }

                        $("#tablag tbody").html(html);

                        $('#tablag').Tabledit({
                            url: '../../editar_medicamento',
                            columns: {
                                identifier: [0, 'fila'],
                                editable: [[1, 'codigo'], [2, 'nombreMedicamento'], [3, 'cantidad'], [4, 'idMedicamento'], [5, 'cuentaMedicamento'], [6, 'cantidadActual']]
                            },
                            restoreButton:false,
                        });
                    }
                },
                error:function(){
                    alert("Hay un error");
                }
            }); */
            success:function(respuesta){
                var registro = eval(respuesta);
                if (Object.keys(registro).length > 0){
                    if(registro.estado == 1){
                        toastr.remove();
                        toastr.options = {
                            "positionClass": "toast-top-left",
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "1000",
                            "extendedTimeOut": "50",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            },
                        toastr.success('Paquete agregado', 'Aviso!');
                    }else{
                        toastr.remove();
                        toastr.options = {
                            "positionClass": "toast-top-left",
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "1000",
                            "extendedTimeOut": "50",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                            },
                        toastr.error('No se agrego el paquete', 'Aviso!');
                    }
                }else{
                    toastr.remove();
                    toastr.options = {
                        "positionClass": "toast-top-left",
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "1000",
                        "extendedTimeOut": "50",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        },
                    toastr.error('No se agrego el paquete', 'Aviso!');
                }
            },
            error:function(){
                toastr.remove();
                toastr.options = {
                    "positionClass": "toast-top-left",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "1000",
                    "extendedTimeOut": "50",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                },
                toastr.error('No se agrego el paquete debido a un error sql...', 'Aviso!');
            }
        });

        $("#scanPivote").focus();

    });
</script>