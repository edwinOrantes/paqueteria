<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encomiendas Campos</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 20px auto;
            padding: 10px;
        }

        /* Fila principal con el logo e información */
        .row {
            width: 100%;
            margin-bottom: 20px;
        }

        /* Estilo para las columnas, cada una con un 48% de ancho */
        .column {
            width: 48%;  
            float: left;   /* Uso de flotado para mPDF */
            margin-right: 4%; /* Espacio entre las columnas */
        }

        /* Remover el margen derecho en la última columna */
        .column:last-child {
            margin-right: 0;
        }

        .column img {
            width: 100%;
            height: auto;
        }

        .text-rows p {
            margin: 5px 0;
            font-weight: bold;
        }

        /* Borde para las cajas */
        

        .box-header {
            background-color: #01369b;
            color: white;
            padding: 5px;
            margin-left: 5px;
            font-weight: bold;
            text-align: center
        }

        .box-content {
            padding: 5px;
        }

        /* Tabla de detalles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #d8d4d4;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: rgba(1, 54, 155, 1);
            color: white;
        }

        /* Firmas */
        .firma {
            border-top: 1px solid #000;
            text-align: center;
            padding-top: 10px;
            font-weight: bold;
            margin-top: 20px;
        }

        /* Limpiar los floats */
        .clearfix {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Primera fila: Imagen y 4 líneas de texto -->
        <div class="row">
            <div class="column" style="text-align: center; width: 30%">
                <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="150" alt="Logo">
            </div>
            <div class="column" style="width: 65%">
                <p class="" style="font-size: 20px; font-weight: bold; text-align: center"><?php echo $empresa->nombreEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->direccionEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->telefonoEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->correoEmpresa; ?></p>
                <p class="" style="font-size: 14px; font-weight: bold; padding-top: -10px; text-align: center">Orden #<?php echo $orden->codigoOrden; ?></p>
                
            </div>
            <hr style="color: #01369b ">
        </div>

        <!-- Fila con datos del Emisor y Receptor a la par -->
        <div class="row clearfix">
            <!-- Emisor -->
            <div class="column">
                <div class="box">
                    <div class="box-header">Datos del Emisor</div>
                    <div class="box-content">
                        <p><b>Nombre:</b> <?php echo str_replace("-", " ", $orden->emisorOrden); ?></p>
                        <p><b>Dirección:</b> <?php echo $orden->origenOrden; ?></p>
                        <p><b>Teléfono:</b> <?php echo $orden->telefonoEmisor; ?></p>
                    </div>
                </div>
            </div>

            <!-- Receptor -->
            <div class="column">
                <div class="box">
                    <div class="box-header">Datos del Receptor</div>
                    <div class="box-content">
                        <p><b>Nombre:</b> <?php echo str_replace("-", " ", $orden->receptorOrden); ?></p>
                        <p><b>Dirección:</b> <?php echo $orden->destinoOrden; ?></p>
                        <p><b>Teléfono:</b> <?php echo $orden->telefonoReceptor; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de detalles -->
            <div class="box">
                <div class="box-header">Detalle de Productos</div>
                <div class="box-content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Unidad</th>
                                <th>Peso (Lbs)</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>1</td>
                                <td>Libras</td>
                                <td><?php echo $detalle_articulos->pesoPaquete; ?></td>
                                <td>$ <?php echo number_format($detalle_articulos->precioLibra, 2); ?> </td>
                                <td><?php echo $detalle_articulos->contenidoPaquete; ?> </td>
                                <td>$ <?php echo number_format($detalle_articulos->totalPaquete, 2); ?> </td>
                            </tr>


                            
                            <?php
                                $totalEnvio = $detalle_articulos->totalPaquete;
                                $detalle = json_decode($detalle_articulos->adicionalesPaquete);
                                if (!is_null($detalle)) {
                                $index = 2;

                                echo '<tr style="">
                                        <td colspan="6" style="text-align: center;"><strong>Detalles adicionales</strong></td>
                                    </tr>';
                                
                                foreach ($detalle as $row) {
                                    $totalEnvio += $row->monto;
                            ?>
                                <tr>
                                    <td><?php echo $index;?></td>
                                    <td></td>
                                    <td></td>
                                    <td>$ <?php echo number_format($row->monto, 2); ?> </td>
                                    <td><?php echo $row->concepto; ?> </td>
                                    <td>$ <?php echo number_format($row->monto, 2); ?> </td>
                            </tr>

                            

                            <?php
                                $index++;
                                }
                            }
                            ?>

                            <tr style="">
                                <td colspan="5" style="text-align: right"><strong>TOTAL</strong></td>
                                <td><strong>$ <?php echo number_format($totalEnvio, 2); ?></strong> </td>
                            </tr>

                            <?php
                                if($orden->abonoOrden > 0){
                                    echo '<tr style="">
                                            <td colspan="5" style="text-align: right"><strong>ABONADO</strong></td>
                                            <td><strong>$ '.number_format($orden->abonoOrden, 2).'</strong> </td>
                                        </tr>';
                                    echo '<tr style="">
                                            <td colspan="5" style="text-align: right"><strong>PENDIENTE</strong></td>
                                            <td><strong>$ '.number_format(($totalEnvio - $orden->abonoOrden), 2).'</strong> </td>
                                        </tr>';
                                }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Emisor -->
                <div class="column">
                    <div class="box">
                        <div class="box-content">
                            <p><strong>Tipo de servicio</strong></p>
                            <p><?php echo $orden->tipoServicio; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Receptor -->
                <div class="column">
                    <div class="box">
                        <div class="box-content">
                            <p><strong>Estado de pago</strong></p>
                            <p><?php echo $orden->estadoPago; ?></p>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Espacios para firmas -->
       

    </div>
</body>
</html>
