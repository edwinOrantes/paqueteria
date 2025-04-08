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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Envios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">datos</li>
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
                        <form class="needs-validation" method="post" action="<?= base_url(); ?>Envios/guardar_envio" novalidate>
                                <div class="form-row">

                                    <div class="col-xl-6 mb-6">
                                        <label for="codigoEnvio">Código orden</label>
                                        <input type="text" class="form-control" value="<?php echo $codigo; ?>" id="" name="" readonly>
                                        <input type="hidden" class="form-control" value="<?php echo $codigo; ?>" id="codigoEnvio" name="codigoEnvio" required>
                                        <div class="invalid-tooltip">Este campo es obligatorio</div>
                                    </div>


                                    <div class="col-xl-6 mb-3">
                                       <label for="gestorOrden"><strong>Gestor asignado</strong></label>
                                       <select class="form-control" id="gestorOrden" name="gestorOrden" required="">
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               foreach ($gestores as $row) {
                                                   echo '<option value="'.$row->idEmpleado.'">'.$row->nombreEmpleado.'</option>';
                                               }
                                           ?>
                                       </select>
                                       <div class="invalid-tooltip">Este campo es obligatorio</div>
                                   </div>

                                   <div class="col-xl-6 mb-6">
                                        <label for="fechaEnvio">Fecha de envio</label>
                                        <input type="date" class="form-control" id="fechaEnvio" name="fechaEnvio" required>
                                        <div class="invalid-tooltip">Este campo es obligatorio</div>
                                    </div>

                                    <div class="col-xl-6 mb-3">
                                       <label for="destinoOrden"><strong>Destino</strong></label>
                                       <select class="form-control" id="destinoOrden" name="destinoOrden" required>
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               foreach ($destinos as $row) {
                                                   echo '<option value="'.$row->idDestino.'">'.$row->nombreDestino.'</option>';
                                               }
                                           ?>
                                       </select>
                                       <div class="invalid-tooltip">Este campo es obligatorio</div>
                                   </div>

                                    <!-- <div class="col-xl-3 mb-3">
                                       <label for="maletasEnvio"><strong>Maletas</strong></label>
                                       <select class="form-control" id="maletasEnvio" name="maletasEnvio" required>
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               for ($i=1; $i <= 10; $i++){
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                    
                                               }
                                           ?>
                                       </select>
                                       <div class="invalid-tooltip">Este campo es obligatorio</div>
                                   </div>

                                    <div class="col-xl-3 mb-3">
                                       <label for="manosEnvio"><strong>En mano</strong></label>
                                       <select class="form-control" id="manosEnvio" name="manosEnvio" required>
                                           <option value="">.:: Seleccionar ::.</option>
                                           <?php
                                               for ($i=0; $i <= 10; $i++){
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                    
                                               }
                                           ?>
                                       </select>
                                       <div class="invalid-tooltip">Este campo es obligatorio</div>
                                   </div> -->

                                </div>

                                <div class="text-center mt-5">
                                     <button class="btn btn-primary w-25" type="submit">Crear orden <i class="fe fe-save"></i></button>
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