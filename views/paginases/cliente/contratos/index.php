<h2 class="titulo-contrato dashboard__heading"> <?php echo $titulo; ?> </h2>


<?php if(empty($contratos)) { ?>
    <p class="">No hay contratos Aún</p>
<?php } ?>

<div class="contratos-container" id="contratos-container">
    <?php
    $contador = 1;
    foreach ($contratos as $contrato):
        // Convertir la fecha de finalización del contrato a timestamp
        $fecha_fin_timestamp = strtotime($contrato->fecha_fin);
        // Obtener el tiempo actual en timestamp
        $tiempo_actual_timestamp = time();
        // Verificar si la fecha de finalización ha pasado
        $fecha_fin_pasada = $fecha_fin_timestamp < $tiempo_actual_timestamp;
        // Agregar una clase condicional según si la fecha de finalización ha pasado o no
        $estado_contrato = $fecha_fin_pasada ? 'Vencido' : 'Activo';
    ?>
        <div class="contrato <?php echo $estado_contrato ?>">
            <h2>Contrato Nº<?php echo $contador; ?></h2>
            <p><span>Inversión:</span> $<?php echo $contrato->inversion; ?></p>
            <p><span>Tasa de Interés Mensual:</span> <?php echo $contrato->porcentaje; ?>%</p>
            <p><span>Tipo:</span> <?php echo $contrato->tipo; ?></p>
            <p><span>Fecha de inicio:</span> <?php echo date("d/m/Y", strtotime($contrato->fecha_inicio)); ?></p>
            <p><span>Fecha de fin:</span> <?php echo date("d/m/Y", strtotime($contrato->fecha_fin)); ?></p>
            <p><span>Estado:</span> <?php echo $estado_contrato ?></p>
            <div class="dashboard__contenedor--boton">
                <a target="_blank" class="dashboard__boton" href="/contratos/<?php echo $contrato->contrato; ?>">
                    Ver Contrato
                </a>
            </div>
        </div>
    <?php
        $contador++;
    endforeach;
    ?>
</div>
