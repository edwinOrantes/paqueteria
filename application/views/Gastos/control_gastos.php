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
    $totalGastos = 0;
    foreach ($lista_gastos as $cuenta) {
        $totalGastos += $cuenta->montoGasto;
    }
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
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Gastos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">lista</li>
                            </ol>
                        </div>
						<a href="#agregarGasto" data-bs-toggle="modal" class="btn btn-primary btn-sm"title="Agregar cuenta"><i class="fa fa-plus"></i> Agregar gasto</a>
                    </div>
                <!-- page-header end -->

                <!-- row open -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title text-dark">Lista de gastos</h3>
                            </div>
                            <div class="card-body">
                                <div class="">
                                    <?php
                                        if(sizeof($lista_gastos) > 0){
                                    ?>
                                    <table class="table table-bordered text-nowrap border-bottom basic-datatable" id="tbl_clientes">
                                        <thead>
                                            <tr class="bg-primary">
                                            <th class="text-center text-white">Código</th>
                                            <th class="text-center text-white">Detalle</th>
                                            <th class="text-center text-white">Monto</th>
                                            <th class="text-center text-white">Fecha</th>
                                            <th class="text-center text-white">Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
                                                $index = 1;
                                                foreach ($lista_gastos as $row) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?= $index;?></td>
                                                        <td class="text-center"><?= $row->descripcionGasto;?></td>
                                                        <td class="text-center">$ <?= number_format($row->montoGasto, 2);?></td>
                                                        <td class="text-center"><?= $row->fechaGasto;?></td>
                                                        <td class="text-center">
                                                            <input type="hidden" class="idGasto" value="<?= $row->idGasto;?>">
                                                            <input type="hidden" class="idCuentaGasto" value="<?= $row->idCuentaGasto;?>">
                                                            <input type="hidden" class="entregadoGasto" value="<?= $row->entregadoGasto;?>">
                                                            <input type="hidden" class="montoGasto" value="<?= $row->montoGasto;?>">
                                                            <input type="hidden" class="pagoGasto" value="<?= $row->pagoGasto;?>">
                                                            <input type="hidden" class="descripcionGasto" value="<?= $row->descripcionGasto;?>">

                                                            <a href="<?php echo base_url(); ?>Gastos/recibo_gasto/<?php echo $row->idGasto; ?>" class="text-danger" title="Ver gasto"><i class="fa fa-file iconoPlus"></i></a>
                                                            <a href="#editarGasto" id="btnEditarGasto" data-bs-toggle="modal"  class="text-primary" title="Editar gasto"><i class="fa fa-edit iconoPlus"></i></a>
                                                            <a href="#eliminarGasto" id="btnEliminarGasto" data-bs-toggle="modal" class="text-danger" title="Eliminar gasto"><i class="fa fa-trash iconoPlus"></i></a>
                                                        </td>
                                                    </tr>
                
                                            <?php
                                                     $index++;
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

<!-- Modal para agregar datos del gasto-->
    <div class="modal fade" id="agregarGasto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Datos de la cuenta</strong></h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" id="" method="post" action="<?php echo base_url() ?>Gastos/guardar_gasto" novalidate>
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="col-md-12">
                                    <label for=""><strong>Código:</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control numeros" value="<?php echo $cod; ?>" required readonly>
                                    </div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="cuentaGasto"><strong>Cuenta:</strong></label>
                                    <select class="form-control" id="cuentaGasto" name="cuentaGasto" required>
                                        <option value="">.:: Seleccionar ::.</option>
                                        <?php
                                            foreach ($cuentas as $row) {
                                        ?>
                                            <option value="<?php echo $row->idCuenta?>"><?php echo $row->nombreCuenta?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="entregadoGasto"><strong>Entregado:</strong></label>
                                    <input type="text" class="form-control" id="entregadoGasto" name="entregadoGasto" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="montoGasto"><strong>Monto:</strong></label>
                                    <input type="text" class="form-control" id="montoGasto" name="montoGasto" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="formaPago"><strong>Forma de pago:</strong></label>
                                    <select class="form-control" id="formaPago" name="formaPago" required>
                                        <option value="">.:: Seleccionar ::.</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Caja chica">Caja chica</option>
                                        <option value="Cargo a cuenta">Cargo a cuenta</option>
                                    </select>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="descripcionGasto"><strong> Descripción: </strong></label>
                                    <textarea class="form-control" id="descripcionGasto" name="descripcionGasto" rows="5" required></textarea>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <input type="hidden" name="codigoGasto" value="<?php echo $cod; ?>">
                                <button class="btn btn-primary" type="submit"> Guardar gasto <i class="fe fe-save"></i></button>
                            </div>
                        </div>  
                    </form>

					
            </div>
        </div>
    </div>
<!-- Fin Modal para agregar datos del gasto-->

<!-- Modal para editar Gasto-->
<div class="modal fade" id="editarGasto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Datos de la cuenta</strong></h5>
                    <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                    <form class="needs-validation" id="" method="post" action="<?php echo base_url() ?>Gastos/editar_gasto" novalidate>
                        <div class="modal-body">
                            <div class="form-row">

                                <div class="col-xl-12 mb-3">
                                    <label for="cuentaGasto"><strong>Cuenta:</strong></label>
                                    <select class="form-control" id="cuentaGastoU" name="cuentaGasto" required>
                                        <option value="">.:: Seleccionar ::.</option>
                                        <?php
                                            foreach ($cuentas as $row) {
                                        ?>
                                            <option value="<?php echo $row->idCuenta?>"><?php echo $row->nombreCuenta?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="entregadoGasto"><strong>Entregado:</strong></label>
                                    <input type="text" class="form-control" id="entregadoGastoU" name="entregadoGasto" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                                
                                <div class="col-xl-12 mb-3">
                                    <label for="montoGasto"><strong>Monto:</strong></label>
                                    <input type="text" class="form-control" id="montoGastoU" name="montoGasto" required>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="formaPago"><strong>Forma de pago:</strong></label>
                                    <select class="form-control" id="formaPagoU" name="formaPago" required>
                                        <option value="">.:: Seleccionar ::.</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Caja chica">Caja chica</option>
                                        <option value="Cargo a cuenta">Cargo a cuenta</option>
                                    </select>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label for="descripcionGasto"><strong> Descripción: </strong></label>
                                    <textarea class="form-control" id="descripcionGastoU" name="descripcionGasto" rows="5" required></textarea>
                                    <div class="invalid-feedback">Debes llenar este campo</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <div class="text-center mt-5">
                                <input type="hidden" id="idGasto" name="idGasto">
                                <button class="btn btn-primary" type="submit"> Actualizar gasto <i class="fe fe-save"></i></button>
                            </div>
                        </div>  
                    </form>

					
            </div>
        </div>
    </div>
<!-- Fin Modal para editar Gasto-->


<!-- Modal eliminar gasto -->
    <div class="modal  fade" id="eliminarGasto" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="needs-validation" method="post" action="<?= base_url(); ?>Gastos/eliminar_gasto" novalidate>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Advertencia</h5>
                        <a class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </a>
                    </div>
                    <div class="modal-body">
                        <p class="text-center h4"><strong>¿Estas seguro de eliminar este registro?</strong></p>
                        <div class="col-xl-12 mb-3">
                            <label for="descripcionGasto"><strong> Motivo: </strong></label>
                            <input type="text" class="form-control" id="" name="motivoEliminar" required>
                            <div class="invalid-feedback">Debes llenar este campo</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idGastoD" name="idGasto">
                        <button class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modal eliminar gasto -->

<script>
    $(document).ready(function() {

        $('.controlInteligente').select2({
            theme: "bootstrap4",
            dropdownParent: $("#agregarGasto")
        });

        $('.controlInteligente2').select2({
            theme: "bootstrap4",
            dropdownParent: $("#editarGasto")
        });


        $("#idProveedorGasto").prop('disabled', true); //Bloqueando la entidad
        $("#entidadGasto").change(function() {
            $("#idProveedorGasto").prop('disabled', false); // Desbloqueando la entidad
            $('#idProveedorGasto').each(function() {
                $('#idProveedorGasto option').remove();
            })
            var flag = $(this).val();
            $.ajax({
                url: "tipo_entidad",
                type: "GET",
                data: {id: flag},
                success: function(respuesta) {
                    var registro = eval(respuesta);
                    if (registro.length > 0) {
                        var entidad = "";
                        for (var i = 0; i < registro.length; i++) {
                            if (flag == "1") {
                                entidad += "<option value='" + registro[i]["idMedico"] + "'>" + registro[i]["nombreMedico"] + "</option>";
                            } else {
                                entidad += "<option value='" + registro[i]["idProveedor"] + "'>" + registro[i]["empresaProveedor"] + "</option>";
                            }
                        }
                        $("#idProveedorGasto").append(entidad);
                    }

                    console.log(entidad);
                }
            });

        });

        // Actualizar
            $("#idProveedorGastoA").prop('disabled', true); //Bloqueando la entidad
            $("#entidadGastoA").change(function() {
                $("#idProveedorGastoA").prop('disabled', false); // Desbloqueando la entidad
                $('#idProveedorGastoA').each(function() {
                    $('#idProveedorGastoA option').remove();
                })
                var flag = $(this).val();
                $.ajax({
                    url: "tipo_entidad",
                    type: "GET",
                    data: {id: flag},
                    success: function(respuesta) {
                        var registro = eval(respuesta);
                        if (registro.length > 0) {
                            var entidad = "";
                            for (var i = 0; i < registro.length; i++) {
                                if (flag == "1") {
                                    entidad += "<option value='" + registro[i]["idMedico"] + "'>" + registro[i]["nombreMedico"] + "</option>";
                                } else {
                                    entidad += "<option value='" + registro[i]["idProveedor"] + "'>" + registro[i]["empresaProveedor"] + "</option>";
                                }
                            }
                            $("#idProveedorGastoA").append(entidad);
                        }

                    }
                });

            });

    });

    // Ocultando y mostrando campo para cheque
    $(document).on('change', '#pagoGasto', function(event) {
        event.preventDefault();
        var valor = $(this).val();
        var html = '';
        var banco = '';
        html += '<label for=""><strong>Número de cheque:</strong></label>';
        html += '<div class="input-group">';
        html += '    <input type="text" class="form-control" id="chequeGasto" name="chequeGasto" required>';
        html += '    <div class="invalid-tooltip">';
        html += '        Ingrese el numero de cheque.';
        html += '    </div>';
        html += '</div>';

        // Informacion del banco
        banco += '<div class="col-md-6">';
        banco += '    <label for=""><strong>Banco:</strong></label>';
        banco += '    <div class="input-group">';
        banco += '        <select class="form-control" id="bancoGasto" name="bancoGasto" required>';
        banco += '            <option value="">.:: Seleccionar ::.</option>';
        banco += '            <option value="Hipotecario">Hipotecario</option>';
        banco += '            <option value="Davivienda">Davivienda</option>';
        banco += '            <option value="Agricola">Agricola</option>';
        banco += '            <option value="Promerica">Promerica</option>';
        banco += '        </select>';
        banco += '        <div class="invalid-tooltip">';
        banco += '            Ingrese quien recibe el $.';
        banco += '        </div>';
        banco += '    </div>';
        banco += '</div>';
        banco += '<div class="col-md-6">';
        banco += '    <label for=""><strong>N° de cuenta:</strong></label>';
        banco += '    <div class="input-group">';
        banco += '        <input type="text" class="form-control numeros" id="cuentaGasto" name="cuentaGasto" placeholder="Ingrese la cuenta del banco" onKeyPress="return soloNumeros(event)" required>';
        banco += '        <div class="invalid-tooltip">';
        banco += '            Ingrese un nombre.';
        banco += '        </div>';
        banco += '    </div>';
        banco += '</div>';

        // Informacion del banco
        if (valor == 2) {
            $("#numeroCheque").append(html);
            $("#detallesBanco").append(banco);
        } else {
            $("#numeroCheque").html('');
            $("#detallesBanco").html('');
        }

    });

    $(document).on('change', '#pagoGastoA', function(event) {
        event.preventDefault();
        var valor = $(this).val();
        var html = '';
        var banco = '';
        html += '<label for=""><strong>Número de cheque:</strong></label>';
        html += '<div class="input-group">';
        html += '    <input type="text" class="form-control" id="chequeGastoA" name="chequeGasto" required>';
        html += '    <div class="invalid-tooltip">';
        html += '        Ingrese el numero de cheque.';
        html += '    </div>';
        html += '</div>';

        banco += '<div class="col-md-6">';
        banco += '    <label for=""><strong>Banco:</strong></label>';
        banco += '    <div class="input-group">';
        banco += '        <select class="form-control" id="bancoGastoU" name="bancoGasto">';
        banco += '            <option value="">.:: Seleccionar ::.</option>';
        banco += '            <option value="Hipotecario">Hipotecario</option>';
        banco += '            <option value="Davivienda">Davivienda</option>';
        banco += '            <option value="Agricola">Agricola</option>';
        banco += '            <option value="Promerica">Promerica</option>';
        banco += '        </select>';
        banco += '        <div class="invalid-tooltip">';
        banco += '            Ingrese quien recibe el $.';
        banco += '        </div>';
        banco += '    </div>';
        banco += '</div>';
        banco += '<div class="col-md-6">';
        banco += '    <label for=""><strong>N° de cuenta:</strong></label>';
        banco += '    <div class="input-group">';
        banco += '        <input type="text" class="form-control numeros" id="cuentaGastoU" name="cuentaGasto" placeholder="Ingrese la cuenta del banco" onKeyPress="return soloNumeros(event)">';
        banco += '        <div class="invalid-tooltip">';
        banco += '            Ingrese un nombre.';
        banco += '        </div>';
        banco += '    </div>';
        banco += '</div>';
        
        if (valor == 2) {
            $("#numeroChequeA").show();
            $("#detallesBancoU").show();
        } else {
            $("#numeroChequeA").hide();
            $("#detallesBancoU").hide();
        }

    });
</script>


<script>
    $(document).ready(function() {
        $("#verPorFechas").click(function() {
            var valor = $('input:checkbox[name=porFecha]:checked').val();
            if (valor == "porFecha") {
                $("#detalleGeneralGastos").hide();
                $("#divBotonera").hide();
                $("#formularioFechas").fadeIn();
                $("#titleLista").hide();
                $("#titleFecha").fadeIn();
            } else {
                $("#formularioFechas").hide();
                $("#detalleGeneralGastos").fadeIn();
                $("#divBotonera").fadeIn();
                $("#titleLista").fadeIn();
                $("#titleFecha").hide();
            }
        });
    });
</script>

<script>
    function editarGasto(id, tipo, monto, entregado, idCuenta, fecha, entidad, idProveedor, pago, numero, descripcion, codigo, efectuo, banco, cuenta){
        //console.log(id, tipo, monto, entregado, idCuenta, fecha, entidad, idProveedor, pago, numero, descripcion, codigo, efectuo);
        document.getElementById("idGastoA").value = id;
        document.getElementById("tipoGastoA").value = tipo;
        document.getElementById("entregadoGastoA").value = entregado;
        document.getElementById("idCuentaGastoA").value = idCuenta;
        document.getElementById("montoGastoA").value = monto;
        document.getElementById("fechaGastoA").value = fecha;
        document.getElementById("entidadGastoA").value = entidad;
        document.getElementById("bancoGastoU").value = banco;
        document.getElementById("cuentaGastoU").value = cuenta;
        
        document.getElementById("pagoGastoA").value = pago;
        if(pago == 1){
            $("#numeroChequeA").hide();
            $("#detallesBancoU").hide();
        }else{
            $("#numeroChequeA").show();
            $("#detallesBancoU").show();
        }
        document.getElementById("chequeGastoA").value = numero;
        document.getElementById("descripcionCuentaA").value = descripcion;
        document.getElementById("codigoGastoA").value = codigo;
        document.getElementById("codigoGastoA2").value = codigo;
        document.getElementById("efectuoGasto").value = efectuo;

        $("#idProveedorGastoA").prop('disabled', false); // Desbloqueando la entidad
        $('#idProveedorGastoA').each(function() {
            $('#idProveedorGastoA option').remove();
        })
        $.ajax({
            url: "tipo_entidad",
            type: "GET",
            data: {id: entidad},
            success: function(respuesta) {
                var registro = eval(respuesta);
                if (registro.length > 0) {
                    var entidadHTML = "";
                    for (var i = 0; i < registro.length; i++) {
                        if (entidad == 1) {
                            if(registro[i]["idMedico"] == idProveedor){
                                entidadHTML += "<option value='" + registro[i]["idMedico"] + "' selected>" + registro[i]["nombreMedico"] + "</option>";
                            }else{
                                entidadHTML += "<option value='" + registro[i]["idMedico"] + "'>" + registro[i]["nombreMedico"] + "</option>";
                            }
                        } else {
                            if(registro[i]["idProveedor"] == idProveedor){
                                entidadHTML += "<option value='" + registro[i]["idProveedor"] + "' selected>" + registro[i]["empresaProveedor"] + "</option>";
                            }else{
                                entidadHTML += "<option value='" + registro[i]["idProveedor"] + "'>" + registro[i]["empresaProveedor"] + "</option>";
                            }
                        }
                    }
                    $("#idProveedorGastoA").append(entidadHTML);
                }

            }
        });
        document.getElementById("idProveedorGastoA").value = idProveedor;
       
    }


    $(document).on("click", "#btnEditarGasto", function(){
        $("#cuentaGastoU").val($(this).closest('tr').find(".idCuentaGasto").val());
        $("#entregadoGastoU").val($(this).closest('tr').find(".entregadoGasto").val());
        $("#montoGastoU").val($(this).closest('tr').find(".montoGasto").val());
        $("#formaPagoU").val($(this).closest('tr').find(".pagoGasto").val());
        $("#descripcionGastoU").val($(this).closest('tr').find(".descripcionGasto").val());
        $("#idGasto").val($(this).closest('tr').find(".idGasto").val());

    });

    $(document).on("click", "#btnEliminarGasto", function(){
        $("#idGastoD").val($(this).closest('tr').find(".idGasto").val());

    });

    

    $(document).on('click', '.btnEliminarGasto', function(event) {
        event.preventDefault();
        
        motivo = window.prompt("Motivo por el cual se eliminara el gasto: ");
        if(motivo == ""){
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
            toastr.error('El gasto no puede ser eliminado sin motivo...', 'Aviso!');
        }else{
            var gasto = {
                motivo: motivo,
                estado: 0,
                idGasto: $(this).closest('tr').find(".identificadorGasto").val(),
            }
            $.ajax({
                url: "eliminar_gasto",
                type: "POST",
                data: gasto,
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
                            toastr.success('Gasto eliminado', 'Aviso!');
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
                            toastr.error('El gasto no puede ser eliminado...', 'Aviso!');
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
                        toastr.error('No se actualizo el medicamento...', 'Aviso!');
                    }
                }
            });
            $(this).closest('tr').remove();
        }


    });

    $(document).ready(function() {
        $("#entregadoGasto").val("");
        $("#montoGasto").val("");
        $("#entidadGasto").val("");
        $("#pagoGasto").val("");
        $("#descripcionCuenta").val("");
        $("#idCuentaGasto").val("");
        $("#idProveedorGasto").val("");
    });
</script>