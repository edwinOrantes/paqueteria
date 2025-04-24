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
            padding: 2px;
            text-align: center;
            font-size: 11px
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

<?php
    function formatearDireccion($pais, $estado, $municipio) {
        // Quitar el número y guion si existen
        $pais = preg_replace('/^\d+\-/', '', trim($pais));
        $estado = preg_replace('/^\d+\-/', '', trim($estado));
        $municipio = preg_replace('/^\d+\-/', '', trim($municipio));

        // Crear un arreglo con los valores no vacíos
        $partes = array_filter([$municipio, $estado, $pais], function($valor) {
            return !empty($valor);
        });

        // Unir con coma y espacio
        return implode(', ', $partes);
    }
?>


<body>
    <div class="container">
        <!-- Primera fila: Imagen y 4 líneas de texto -->
        <div class="row">
            <div class="column" style="text-align: center; width: 30%">
                <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="100" alt="Logo">
            </div>
            <div class="column" style="width: 65%">
                <p class="" style="font-size: 10px; font-weight: bold; text-align: center"><?php echo $empresa->nombreEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->direccionEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->telefonoEmpresa; ?></p>
                <p class="" style="font-weight: bold; padding-top: -10px; text-align: center"><?php echo $empresa->correoEmpresa; ?></p>
                
            </div>
            <!-- <hr style="color: #01369b "> -->
        </div>
        
        
        <!-- Tabla de detalles -->
            <div class="box" style="padding-top: -20px">
                <div class="box-content">
                    <p style="text-align: center"><strong><?php echo strtoupper('Detalle de las ordenes con destino a: '.$destino->nombreDestino.", durante las fechas: ".$datos["fechaInicio"]." y ".$datos["fechaFin"])?></strong></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CODIGO</th>
                                <th>FECHA</th>
                                <th style="width: 150px">EMISOR</th>
                                <th style="width: 150px">RECEPTOR</th>
                                <th>ESTADO DEL PAGO</th>
                                <th>ESTADO DEL ENVIO</th>
                                <th>DIRECCION DE ENTREGA</th>
                                <th>PESO EN LIBRAS</th>
                                <th>PRECIO POR LIBRA</th>
                                <th>TOTAL</th>
                                <th>ABONADO</th>
                                <th>PENDIENTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $flag = 1;
                                foreach($ordenes as $row){
                            ?>
                                <tr>
                                    <td><?php echo $flag; ?></td>
                                    <td><?php echo $row->codigoOrden; ?></td>
                                    <td><?php echo $row->creada; ?></td>
                                    <td><?php echo str_replace("-", " ", $row->emisorOrden); ?></td>
                                    <td><?php echo str_replace("-", " ", $row->receptorOrden); ?></td>
                                    <td><?php echo $row->estadoPago; ?></td>
                                    <td><?php echo $row->nombreEstado; ?></td>
                                    <td><?php echo $row->destinoOrden.", ".formatearDireccion($row->rPais, $row->rEstado, $row->rMunicipio) ?></td>
                                    <td><?php echo $row->pesoPaquete; ?></td>
                                    <td>$<?php echo $row->precioLibra; ?></td>
                                    
                                    <?php
                                        if($row->estadoPago == "Pagado"){
                                            echo '<td>$'.number_format($row->totalPaquete, 2).'</td>';
                                            echo '<td>$'.number_format($row->abonoOrden ,2).'</td>';
                                            echo '<td>$0.00</td>';
                                        }else{
                                            echo '<td>$'.number_format($row->totalPaquete, 2).'</td>';
                                            echo '<td>$'.number_format($row->abonoOrden ,2).'</td>';
                                            echo '<td>$'.number_format( ($row->totalPaquete-$row->abonoOrden) ,2).'</td>';

                                        }
                                    
                                    ?>

                                </tr>
                            <?php
                                $flag++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
</body>
</html>