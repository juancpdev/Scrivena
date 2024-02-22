

<h2 class="titulo-contrato dashboard__heading"> <?php echo $titulo; ?> </h2>

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

        // Array asociativo para mapear tipos de contrato en español a inglés
        $tipos_contrato = array(
            'Inversión en Minería' => 'Investment in Mining',
            'Desarrollos Inmobiliarios' => 'Real Estate Developments',
            'Fondos de Inversión USA' => 'USA Investment Funds',
            'Remates Inmobiliarios' => 'Real Estate Auctions'
        );

        // Obtener el tipo de contrato del array asociativo, si existe
        $tipo_contrato_ingles = isset($tipos_contrato[$contrato->tipo]) ? $tipos_contrato[$contrato->tipo] : $contrato->tipo;
    ?>
        <div class="contrato <?php echo $estado_contrato ?>">
            <h2>Contract Nº<?php echo $contador; ?></h2>
            <p><span>Investment:</span> $<?php echo $contrato->inversion; ?></p>
            <p><span>Monthly Interest Rate:</span> <?php echo $contrato->porcentaje; ?>%</p>
            <p><span>Type:</span> <?php echo $tipo_contrato_ingles; ?></p>
            <p><span>Start date:</span> <?php echo date("d/m/Y", strtotime($contrato->fecha_inicio)); ?></p>
            <p><span>Ending date:</span> <?php echo date("d/m/Y", strtotime($contrato->fecha_fin)); ?></p>
            <p><span>State:</span> <?php echo $estado_contrato ?></p>
            <div class="dashboard__contenedor--boton">
                <a target="_blank" class="dashboard__boton" href="/contratos/<?php echo $contrato->contrato; ?>">
                    View contract
                </a>
            </div>
        </div>
    <?php
        $contador++;
    endforeach;
    ?>
</div>

