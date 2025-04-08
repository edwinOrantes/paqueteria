<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Encomiendas campos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            text-align: center;
            width: 100%;
            height: 70%;
        }
        
        .columna {
            height: 44%;
            border: 2px solid #000000;
            float: left;
            width: 48%;
            margin-bottom: 10px
        }

        .row_header {
            width: 100%;
        }

        .columna_header{
            border: 2px solid #fff;
            float: left;
        }

        
    </style>
</head>
<body>

    <div class="container">
    <?php
        if($piezas == 1){
    ?>
        <div class="columna">
            
            <div class="row_header">
                <div class="columna_header" style="width: 40%;">
                    <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="90" alt="Logo">
                </div>
                <div class="columna_header" style="width: 57%; padding: 0">
                    <p class="" style="font-size: 10px; font-weight: bold; text-align: center"><?php echo $empresa->nombreEmpresa; ?></p>
                    <p class="" style="font-size: 7px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->direccionEmpresa; ?></p>
                    <p class="" style="font-size: 7px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->telefonoEmpresa; ?></p>
                    <p class="" style="font-size: 6px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->correoEmpresa; ?></p>
                    <p class="" style="font-size: 8px; font-weight: bold; padding-top: -5px; text-align: center">Orden #<?php echo $orden->codigoOrden; ?></p>
                </div>
            </div>

            <div class="row_contenido">
                <div class="columna_header" style="width: 48%">
                    <p style="font-size: 8px; text-align: center"><strong>Emisor</strong></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Nombre:</strong> <?php echo $orden->emisorOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Dirección:</strong> <?php echo $orden->origenOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Teléfono:</strong> <?php echo $orden->telefonoEmisor; ?></p>
                </div>
                <div class="columna_header" style="width: 48%;">
                    <p style="font-size: 8px; text-align: center"><strong>Receptor</strong></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Nombre:</strong> <?php echo $orden->emisorOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Dirección:</strong> <?php echo $orden->origenOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Teléfono:</strong> <?php echo $orden->telefonoEmisor; ?></p>
                </div>
            </div>

            <div class="row_contenido" style="padding: 5px">
                <p style="font-size: 10px; text-align: center"><strong>Descripción</strong></p>
                <p style="font-size: 8px; text-align: center"><strong><?php echo $detalle_articulos->contenidoPaquete; ?> </strong></p>
            </div>

            <div class="row_contenido">
                <div class="columna_header" style="width: 48%">
                    <!-- <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="90" alt="Logo"> -->
                    <?php 
                        $img = $qrs[0];
                        echo "<img src='data:image/png;base64,{$img}'  width='100' alt='Logo'/>"; 
                    ?>
                </div>
                <div class="columna_header" style="width: 48%;">
                    <h1 style="font-size: 30px"><?php echo "1/1"; ?></h1>
                    <!-- <p style="font-size: 7px; font-weight: bold; padding-top: -10px; text-align: center"><?php echo $detalle_articulos->contenidoPaquete;  ?></p> -->
                </div>
            </div>

            <div class="row_contenido" style="padding: 5px">
                <p style="font-size: 9px; text-align: left"><strong>Fecha de envio: </strong><?php echo $orden->fechaEnvio; ?> </p>
                <p style="font-size: 9px; text-align: left"><strong>Estado del pago: </strong><?php echo $orden->estadoPago; ?> </p>
            </div>
            
        </div>

    <?php
        }else{

        $ordenPaquete = json_decode($detalle_articulos->ordenPaquete, true);
        $index = 0;
        foreach($ordenPaquete as $row) { 
    ?>

        <!-- Tabla para alinear los divs correctamente en mPDF -->

        <div class="columna">
            
            <div class="row_header">
                <div class="columna_header" style="width: 40%;">
                    <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="90" alt="Logo">
                </div>
                <div class="columna_header" style="width: 57%; padding: 0">
                    <p class="" style="font-size: 10px; font-weight: bold; text-align: center"><?php echo $empresa->nombreEmpresa; ?></p>
                    <p class="" style="font-size: 7px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->direccionEmpresa; ?></p>
                    <p class="" style="font-size: 7px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->telefonoEmpresa; ?></p>
                    <p class="" style="font-size: 6px; font-weight: bold; padding-top: -5px; text-align: center"><?php echo $empresa->correoEmpresa; ?></p>
                    <p class="" style="font-size: 8px; font-weight: bold; padding-top: -5px; text-align: center">Orden #<?php echo $orden->codigoOrden; ?></p>
                </div>
            </div>

            <div class="row_contenido">
                <div class="columna_header" style="width: 48%">
                    <p style="font-size: 8px; text-align: center"><strong>Emisor</strong></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Nombre:</strong> <?php echo $orden->emisorOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Dirección:</strong> <?php echo $orden->origenOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Teléfono:</strong> <?php echo $orden->telefonoEmisor; ?></p>
                </div>
                <div class="columna_header" style="width: 48%;">
                    <p style="font-size: 8px; text-align: center"><strong>Receptor</strong></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Nombre:</strong> <?php echo $orden->emisorOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Dirección:</strong> <?php echo $orden->origenOrden; ?></p>
                    <p style="font-size: 8px; padding-top: -5px; text-align: left"><strong>Teléfono:</strong> <?php echo $orden->telefonoEmisor; ?></p>
                </div>
            </div>

            <div class="row_contenido" style="padding: 5px">
                <p style="font-size: 10px; text-align: center"><strong>Descripción</strong></p>
                <p style="font-size: 8px; text-align: center"><strong><?php echo $detalle_articulos->contenidoPaquete; ?> </strong></p>
            </div>

            <div class="row_contenido">
                <div class="columna_header" style="width: 48%">
                    <!-- <img src="<?php echo base_url(); ?>public/images/empresa/<?php echo $empresa->logoEmpresa; ?>.png" width="90" alt="Logo"> -->
                    <?php 
                        $img = $qrs[$index];
                        echo "<img src='data:image/png;base64,{$img}'  width='100' alt='Logo'/>"; 
                    ?>
                    
                </div>
                <div class="columna_header" style="width: 48%;">
                    <h1><?php echo $row["paquete"]."/".$piezas; ?></h1>
                    <p style="font-size: 7px; font-weight: bold; padding-top: -10px; text-align: center"><?php echo $row["concepto"]; ?></p>
                </div>
            </div>

            <div class="row_contenido" style="padding: 5px">
                <p style="font-size: 9px; text-align: left"><strong>Fecha de envio: </strong><?php echo $orden->fechaEnvio; ?> </p>
                <p style="font-size: 9px; text-align: left"><strong>Estado del pago: </strong><?php echo $orden->estadoPago; ?> </p>
            </div>
            
        </div>

    <?php
        $index++;
        }
    }
    ?>
    </div>

</body>
</html>
