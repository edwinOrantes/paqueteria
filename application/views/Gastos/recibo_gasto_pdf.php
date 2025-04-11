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
            text-transform: uppercase
        }

        .container {
            width: 100%;
            margin: 20px auto;
        }

        /* Fila principal con el logo e información */
        .row {
            width: 100%;
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
            <div class="column" style="text-align: center; width: 20%">
                <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="150" alt="Logo">
            </div>
            <div class="column" style="width: 75%">
                <p class="" style="font-size: 15px; font-weight: bold; text-align: center"><?php echo $empresa->nombreEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->direccionEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->telefonoEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->correoEmpresa; ?></p>
                
            </div>
            <hr style="color: #01369b ">
        </div>
    </div>


    <div class="paciente">
        <table class="tabla_paciente" style="font-family: Times New Roman; padding-left: -4px; width: 100%">
            <tr>
                <td style="text-align: left;"><strong>Fecha: </strong> <?php echo $gasto->fechaGasto; ?></td>
                <td style="text-align: right;"><strong>Recibo de egreso:</strong> <?php echo str_pad($gasto->codigoGasto, 4, '0', STR_PAD_LEFT);; ?></td>
            </tr>
        </table>
        <p><strong>Entregue a: </strong> <?php echo $gasto->entregadoGasto; ?></p>
        <p><strong>Forma de pago: </strong> <?php echo $gasto->pagoGasto; ?></p>
        <p><strong>En concepto de: </strong> <?php echo $gasto->descripcionGasto; ?></p>
    </div>

    <div class="detalle">
        <table class="tabla_num_recibo" style="padding-top: 40px; font-family: Times New Roman; width: 100%">
            <tr>
                <td colspan="2" style="text-align: right; padding-right: 205px; padding-bottom: 55px"><strong>Total: $ <?php echo number_format($gasto->montoGasto, 2); ?></strong> </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <p style="text-decoration: underline;">F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php 
                    if(isset($entregado)){ 
                        // echo $entregado;
                    }
                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <h5><strong>RECIBI CONFORME</strong></h5>
                </td>
                <td style="text-align: center;">
                    <p style="text-decoration: underline;">F.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                            if(isset($efectuoGasto)){
                                // echo $efectuoGasto;
                            }                        
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <h5><strong>ELABORADO POR</strong></h5>
                </td>
            </tr>
        </table>
    </div>



</body>
</html>
