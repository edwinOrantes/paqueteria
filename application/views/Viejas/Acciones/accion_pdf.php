<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        
    }
    #cabecera {
        text-align: left;
        width: 80%;
        margin: auto;
        }

    #lateral {
        width: 40%;  /* Este será el ancho que tendrá tu columna */
        float:left; /* Aquí determinas de lado quieres quede esta "columna" */
        }

    #principal {
        width: 49%;
        float: right;
        }


    /* Para limpiar los floats */
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
        }

    .proveedor .detalle table, .medicamentos .detalle table{
        font-size: 12px;
        margin: auto;
        width: 100%;
    }
    
    .proveedor .detalle table tr td, .medicamentos .detalle table tr td{
        padding: 2px;
        /* text-align: center; */
        /* border: 1px solid #000; */
    }

    .tabla_detalle{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font-size: 5px;
        
    }

    .tabla_detalle_paciente{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        font-size: 5px;
        line-height: 25px;
    }

    .detalle table tr{
        font-size: 1px !important
    }

    .mayusculas{
        text-transform: uppercase;
    }

</style>
<?php
    $totalISBMGlobal = 0;
    $totalCostoGlobal = 0;
?>
<div id="cabecera" class="clearfix">

    <div id="lateral">
        <p><img src="<?php echo base_url() ?>public/images/logo.png" alt="" width="250"></p>
    </div>

    <div id="principal">
        <table style="text-align: center;">
            <tr>
                <td><strong>HOSPITAL ORELLANA, USULUTAN</strong></td>
            </tr>
            <tr>
                <td><strong>Departamento de Recursos Humanos</strong></td>
            </tr>
        </table>
    </div>
</div>

<div class="contenedor">
    <div class="medicamentos">
            <p style="margin-top: 40px; font-size: 13px; "><strong>ACCIÓN DE PERSONAL</strong></p>
            <hr style="color: #000; margin-top: -10px; width: 100%;">
            <div class="detalle">
                <table class="tabla_detalle" style="margin-top: 25px; font-size: 13px; height: 30px">
                    <tr>
                        <th style=""> Fecha: </th>
                        <th style="border-bottom: 1px solid #000"> <?php echo $detalle->fechaAccionPersonal; ?> </th>
                        <th style="width: 150px;"></th>
                        <th style="width: 150px;"></th>
                        <th style="">N° de acción:</th>
                        <th style="border-bottom: 1px solid #000"><?php echo $detalle->codigoAccionPersonal; ?> </th>
                    </tr>
                </table>

                <table class="tabla_detalle_paciente" style="margin-top: 35px; font-size: 13px; height: 30px">
                    <tr>
                        <td style="border:none; height: 20px; width: 175px; text-align: left;"><strong>Nombre del empleado: </strong></td>
                        <td style="border-bottom: 1px solid #000"><?php echo $detalle->nombreEmpleado; ?></td>
                    </tr>
                    <tr>
                        <td style="border:none;  height: 20px; width: 175px; text-align: left;"><strong>Departamento: </strong></td>
                        <td style="border-bottom: 1px solid #000"><?php echo $detalle->nombreArea; ?></td>
                    </tr>
                    <tr>
                        <td style="border:none;  height: 20px; width: 175px; text-align: left;"><strong>Cargo: </strong></td>
                        <td style="border-bottom: 1px solid #000"><?php echo $detalle->cargoEmpleado; ?></td>
                    </tr>
                </table>

                <p style="margin-top: 50px; font-size: 13px"><strong>TIPO DE ACCIÓN:</strong></p>
                <hr style="color: #000; margin-top: -10px; width: 100%;">
                <div style="width: 100%; margin-top: 10px;">
                    <?php
                        foreach ($acciones as $row) {
                            echo '<div style="width: 50%; float:left">
                                <table>
                                    <tr>
                                        <td style="width: 200px; font-size: 13px; height: 30px"><strong>'.$row->nombreTipoAccion.'</strong></td>';
                            if($detalle->tipoAccionPersonal == $row->idTipoAccion){
                                echo '<td style="border-bottom: 1px solid #000; font-size: 13px; text-align: center"><strong>X</strong></td>';
                            }else{
                                echo '<td style="border-bottom: 1px solid #000; font-size: 13px; text-align: center"></td>';
                            }
                            
                            echo       ' <td style="width: 100px;"> </td>
                                    </tr>
                                </table>
                            </div>';
                        }
                    ?>
                </div>
                
                <div style="width: 100%; margin-top: 10px;">
                    <div style="">
                        <table>
                            <tr>
                                <td style="width: 200px; font-size: 13px; height: 30px"><strong>Descripción</strong></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #000; font-size: 13px; text-align: center; height: 25px" colspan="3"></td>
                            </tr>
                        </table>
                    </div>
                </div>
    </div>
</div>


    
