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

<?php
    $totalMaletas = $maletas->cantidad + $manos->cantidad;
?>

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
                        <a class="btn btn-success mt-3" href="<?php echo base_url(); ?>Ordenes/"><i class="fe fe-arrow-left"></i> Volver </a>
                        
                    </div>
                </div>
            <!-- page-header end -->

            <!-- row open -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-12 alert-info p-6">
                                    <h3 class="card-title">Detalle de la orden</h3>
                                    <table class="table table-borderless mt-3">
                                        <tr>
                                            <td class="text-black"><strong>Código : </strong></td>
                                            <td><?php echo $detalle_envio->codigoEnvio; ?></td>
                                            <td class="text-black"><strong>Gestor: </strong></td>
                                            <td><?php echo $detalle_envio->nombreEmpleado; ?></td>
                                            <td><button type="button" class="btn btn-primary btn-sm agregarMaleta" data-tipo="1"> <i class="fa fa-plus"></i> Agregar maleta</button></td>
                                            
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-black"><strong>Destino: </strong></td>
                                            <td><?php echo $detalle_envio->nombreDestino; ?></td>
                                            <td class="text-black"><strong>Fecha envio: </strong></td>
                                            <td><?php echo $detalle_envio->fechaEnvio; ?></td>
                                            <td><button type="button" class="btn btn-primary btn-sm agregarMaleta" data-tipo="2"> <i class="fa fa-plus"></i> Agregar en mano</button></td>
                                        </tr>

                                        <tr>
                                            <td class="text-black">Cantidad de maletas: </td>
                                            <td><?php echo $maletas->cantidad; ?></td>
                                            <td class="text-black">Cantidad en mano: </td>
                                            <td><?php echo $manos->cantidad; ?> <input type="hidden" value="<?php echo $envio?>" id="idEnvio"></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="card-body">

                                <?php 
                                    if($totalMaletas > 0){
                                ?>
                                <form id="frmEnvio" action="" method="post">
                                    <div class="form-row">
                            

                                        <div class="col-xl-6 mb-3">
                                            <label for="maletaEnvio"><strong>Maleta</strong></label>
                                            <select class="form-control" id="maletaEnvio" name="maletaEnvio" required>
                                                <option value="">.:: Seleccionar ::.</option>
                                                <?php
                                                    $index = 1;
                                                    foreach ($filasMaletas as $row) {
                                                        echo '<option value="'.$row->idMaleta.'">Maleta '.$index.'</option>';
                                                        $index++;
                                                    }
                                                    $index = 1;
                                                    foreach ($filasManos as $row) {
                                                        echo '<option value="'.$row->idMaleta.'">En mano '.$index.'</option>';
                                                        $index++;
                                                    }

                                                ?>
                                            </select>
                                            <div class="valid-feedback">Muy bien!</div>
                                        </div>

                                        <div class="col-xl-6 mb-3">
                                            <label for="scanPivote"><strong>Paquete</strong></label>
                                            <input type="text" class="form-control" id="scanPivote" />
                                            <input type="hidden" value="<?php echo $detalle_envio->gestorEnvio; ?>" id="gestorEnvio" name="gestorEnvio" required>
                                            <div class="valid-feedback">Muy bien!</div>
                                        </div>

                                    </div>
                                </form>
                                <?php 
                                    }else{
                                        echo '<div class="col-md-12 text-center p-3 alert-danger">
                                                <strong><p>No hay detalle que mostrar</p></strong>
                                            </div>';
                                    }
                                ?>

                                <hr>
                                <table class="table table-bordered text-nowrap border-bottom" id="detalleMaleta">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="border-bottom-0 text-center text-white"><strong>#</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Código</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Detalle</strong></th>
                                                <th class="border-bottom-0 text-center text-white"><strong>Opcion</strong></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                </table>

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
		$("#detalleMaleta").hide();
	});


    $(document).on('click', '.agregarMaleta', function () {
        var tipo = $(this).data('tipo');
        var datos = {
            envio: $("#idEnvio").val(),
            tipo: $(this).data('tipo'),
        }
        
        $.ajax({
            url: "../../guardar_maleta",
            type: "POST",
            data: datos,
            success:function(respuesta){
                var registro = eval(respuesta);
                if (Object.keys(registro).length > 0){
                    if(registro.estado == 1){
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
                        toastr.success('Agregada con exito', 'Aviso!');
                        window.location.reload();
                    }else{
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
                        toastr.error('Error al agregar', 'Aviso!');
                    }
                }else{
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
                    toastr.error('Error al agregar', 'Aviso!');
                }
            }
        });

    });

    $(document).on('change', '#maletaEnvio', function () {
        $("#detalleMaleta").show();
        var datos = {
            maleta: $(this).val()
        }
        $.ajax({
            url: "../../detalle_maleta",
            type: "POST",
            beforeSend: function() {},
            data: datos,
            success: function(respuesta) {
                var registro = eval(respuesta);
                if (Object.keys(registro).length > 0) {
                    if (registro.estado == 1) {
                        datos = registro.datos
                        html = '';
                        flag = 1;
                        for (let i = 0; i < datos.length; i++) {
                            html += '<tr>';
                            html += '    <td class="text-center">'+flag+'</td>';
                            html += '    <td class="text-center">'+datos[i]["codigoOrdenMaleta"]+'</td>';
                            html += '    <td class="text-center">'+datos[i]["strDetalle"]+'</td>';
                            html += '    <td class="text-center text-danger"><i class="fa fa-trash eliminarDetalle"></i></td>';
                            html += '</tr>';
                            flag++;
                        }

                        $("#detalleMaleta tbody").html(html);

                    }else{
                        $("#detalleMaleta tbody").html("");
                    }
                }else{
                    $("#detalleMaleta tbody").html("");
                }
            }
        });



    });

    $(document).on("keydown", "#scanPivote", function(e) {
        // Verificar si se ha presionado la tecla Enter (código 13)
        if (event.keyCode === 13 || event.key === 'Enter') {
            event.preventDefault(); // Detenemos submit
            var maleta = $("#maletaEnvio").val()
            if (maleta != '') {
                if ($(this).val() != '') {
                    var datos = {
                        orden: $(this).val(),
                        maleta: maleta
                    };
                    $("#scanPivote").val("");
                    $.ajax({
                        url: "../../agregar_orden_a_maleta",
                        type: "POST",
                        beforeSend: function() {},
                        data: datos,
                        success: function(respuesta) {
                            var registro = eval(respuesta);
                            if (Object.keys(registro).length > 0) {
                                if (registro.estado == 1) {
                                    toastr.remove();
                                    toastr.options = {
                                        "positionClass": "toast-top-left",
                                        "showDuration": "3000",
                                        "hideDuration": "3000",
                                        "timeOut": "3000",
                                        "extendedTimeOut": "50",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    },
                                    toastr.success('Paquete agregado con exito', 'Aviso!');

                                    datos = registro.datos
                                    html = '';
                                    flag = 1;
                                    for (let i = 0; i < datos.length; i++) {
                                        html += '<tr>';
                                        html += '    <td class="text-center">'+flag+'</td>';
                                        html += '    <td class="text-center">'+datos[i]["codigoOrdenMaleta"]+'</td>';
                                        html += '    <td class="text-center">'+datos[i]["strDetalle"]+'</td>';
                                        html += '    <td class="text-center text-danger"><i class="fa fa-trash eliminarDetalle"></i></td>';
                                        html += '</tr>';
                                        flag++;
                                    }

                                    $("#detalleMaleta tbody").html(html);

                                } else {
                                    toastr.remove();
                                    toastr.options = {
                                        "positionClass": "toast-top-left",
                                        "showDuration": "3000",
                                        "hideDuration": "3000",
                                        "timeOut": "3000",
                                        "extendedTimeOut": "50",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    },
                                    toastr.error(registro.mensaje, 'Aviso!');
                                }
                            } else {
                                toastr.remove();
                                toastr.options = {
                                    "positionClass": "toast-top-left",
                                    "showDuration": "3000",
                                    "hideDuration": "3000",
                                    "timeOut": "3000",
                                    "extendedTimeOut": "50",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                },
                                toastr.error(registro.mensaje, 'Aviso!');
                            }
                        }
                    });
                } else {
                    alert("Debes agregar el código de la orden");
                }
            } else {
                alert("Debes seleccionar una maleta");
            }

        }
    });



</script>






















<!-- Modales -->
    <!-- Agregar articulo -->
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="agregarArticulo" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del articulo</h5>
                        <button class="btn-close close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Ordenes/guardar_articulo" novalidate>
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="col-md-12 mb-3">
                                    <label for="nombreArticulo">Nombre del articulo</label>
                                    <input type="hidden" value="<?php echo $idOrden; ?>" id="idOrden" name="idOrden">
                                    <input type="text" class="form-control" id="nombreArticulo" name="nombreArticulo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pesoArticulo">Peso en Kilos</label>
                                    <input type="text" value="0" class="form-control" id="pesoArticulo" name="pesoArticulo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="precioKilo">Precio por Kilo</label>
                                    <input type="text" value="0" class="form-control" id="precioKilo" name="precioKilo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="totalEnvio">Total del envio</label>
                                    <input type="text" value="0" id="totalLectura" class="form-control" readonly>
                                    <input type="hidden" value="0" id="totalEnvio" name="totalEnvio" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="detallesArticulo">Detalles</label>
                                    <textarea class="form-control" id="detallesArticulo" name="detallesArticulo" rows="5" required></textarea>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="guardarDatosArticulo">Guardar datos</button>
                            <button class="btn btn-secondary close" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Agregar articulo -->

    <!-- Editar articulo -->
        <div class="modal fade" id="editarArticulo" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalle del articulo</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Ordenes/editar_articulo" novalidate>
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="col-md-12 mb-3">
                                    <label for="nombreArticuloU">Nombre del articulo</label>
                                    <input type="text" class="form-control" id="nombreArticuloU" name="nombreArticulo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="pesoArticuloU">Peso en Kilos</label>
                                    <input type="text" class="form-control" id="pesoArticuloU" name="pesoArticulo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="precioKiloU">Precio por Kilo</label>
                                    <input type="text" class="form-control" id="precioKiloU" name="precioKilo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="totalEnvioU">Total del envio</label>
                                    <input type="text" id="totalLecturaU" class="form-control" readonly>
                                    <input type="hidden" id="totalEnvioU" name="totalEnvio" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="detallesArticuloU">Detalles</label>
                                    <input type="text" class="form-control" id="detallesArticuloU" name="detallesArticulo" required>
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                                
                                
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="idDetalleU" name="idDetalleU">
                            <input type="hidden" value="<?php echo $idOrden; ?>" id="idOrdenU" name="idOrden">
                            <button class="btn btn-primary">Actualizar datos</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Editar articulo -->

    <!-- Eliminar articulo -->
        <div class="modal  fade" id="eliminarArticulo" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <form class="needs-validation" method="post" action="<?= base_url(); ?>Ordenes/eliminar_articulo" novalidate>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Advertencia</h5>
                            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center">¿Estas seguro de eliminar este articulo?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="estadoArticulo" value="0">
                            <input type="hidden" id="idArticuloE" name="idArticuloE">
                            <input type="hidden" value="<?php echo $idOrden; ?>" id="idOrdenD" name="idOrden">
                            <a href="#" class="btn btn-default" data-bs-dismiss="modal">Cancelar</a>
                            <button class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- Eliminar articulo -->

    <!-- Crear etiqueta -->
        <div class="modal fade" id="crearEtiqueta" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">¿Cuantas etiquetas se crearan?</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                    <form class="needs-validation" method="post" action="<?= base_url(); ?>Ordenes/etiquetas_articulo" novalidate>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="nombreArticulo">Cantidad</label>
                                    <input type="number" value="1" min="1" class="form-control" id="cantidadEtiquetas" name="cantidadEtiquetas" placeholder="Cantidad" required>
                                    <input type="hidden" value="<?php echo $detalle_envio->codigoOrden; ?>" id="" name="codigoOrden">
                                    <input type="hidden" value="<?php echo $idOrden; ?>" id="idOrden" name="idOrden">
                                    <div class="valid-feedback">Muy bien!</div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Crear</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- Crear etiqueta -->

<!-- Modales -->

<script>

    $(document).on('click', '#agregarFila', function() {
        // Crear una nueva fila con inputs
        var nuevaFila = '<tr>' +
                        '<td><input type="text" class="form-control" name="concepto[]" placeholder="Nombre del concepto"></td>' +
                        '<td><input type="text" class="form-control" name="monto[]" placeholder="Precio en USD"></td>' +
                        '<td class="text-center"><button type="button" class="btn btn-danger btn-sm eliminarFila"><i class="fa fa-trash"></i></button></td>' +
                   '</tr>';
        
        // Agregar la nueva fila al cuerpo de la tabla
        $('#tablaCostos tbody').append(nuevaFila);
    });

    // Eliminar la fila al hacer clic en el botón de eliminar
        $(document).on('click', '.eliminarFila', function() {
            $(this).closest('tr').remove(); // Elimina la fila correspondiente
        });


    /* $(document).on("click", "#guardarDatosArticulo", function(event) {
        event.preventDefault();
        var datos = {
            idOrden : $('#idOrden').val(),
            nombre: $('#nombreArticulo').val(),
            peso: $('#pesoArticulo').val(),
            precio : $('#precioKilo').val(),
            total : $('#totalEnvio').val(),
            detalles : $('#detallesArticulo').val(),
              
        };

        $.ajax({
            url: "../../guardar_articulo",
            type: "POST",
            data: datos,
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
                        toastr.success('Se guardo el articulo', 'Aviso!');
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
                        toastr.error('No se guardo el articulo...', 'Aviso!');
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
                    toastr.error('No se guardo el articulo...', 'Aviso!');
                }
            }
        });
    });

    $(document).on('click', '.close', function(event) {
        event.preventDefault();
        location.reload();
    });

    $(document).on("change", "#pesoArticulo", function(event) {
        event.preventDefault();
        var peso = parseFloat($(this).val());
        var precio = parseFloat($('#precioKilo').val());
        var total = peso * precio;
        $('#totalEnvio').val(total.toFixed(2));
        $('#totalLectura').val(total.toFixed(2));
    });

    $(document).on("change", "#precioKilo", function(event) {
        event.preventDefault();
        var peso = parseFloat($('#pesoArticulo').val());
        var precio = parseFloat($(this).val());
        var total = peso * precio;
        $('#totalEnvio').val(total.toFixed(2));
        $('#totalLectura').val(total.toFixed(2));
    });

    $(document).on("click", "#btnEditarDatos", function(event) {
        event.preventDefault();
        $("#nombreArticuloU").val($(this).closest('tr').find('#nombre').val());
        $("#pesoArticuloU").val($(this).closest('tr').find('#peso').val());
        $("#precioKiloU").val($(this).closest('tr').find('#precio').val());
        $("#totalLecturaU").val($(this).closest('tr').find('#total').val());
        $("#totalEnvioU").val($(this).closest('tr').find('#total').val());
        $("#detallesArticuloU").val($(this).closest('tr').find('#detalle').val());
        $("#idDetalleU").val($(this).closest('tr').find('#idDetalle').val());
    });

    $(document).on("change", "#pesoArticuloU", function(event) {
        event.preventDefault();
        var peso = parseFloat($(this).val());
        var precio = parseFloat($('#precioKiloU').val());
        var total = peso * precio;
        $('#totalEnvioU').val(total.toFixed(2));
        $('#totalLecturaU').val(total.toFixed(2));
    });

    $(document).on("change", "#precioKiloU", function(event) {
        event.preventDefault();
        var peso = parseFloat($('#pesoArticuloU').val());
        var precio = parseFloat($(this).val());
        var total = peso * precio;
        $('#totalEnvioU').val(total.toFixed(2));
        $('#totalLecturaU').val(total.toFixed(2));
    });

    $(document).on("click", "#btnEliminarDatos", function(event) {
        event.preventDefault();
        $("#idArticuloE").val($(this).closest('tr').find('#idDetalle').val()); 
    }); */

</script>

