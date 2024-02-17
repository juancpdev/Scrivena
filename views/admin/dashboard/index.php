<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<main class="bloques">
<div class="dashboard__contenedor--contratos">
    <?php if (!empty($contratos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <th scope="col" class="table__th table__th--id">ID</th>
                    <th scope="col" class="table__th table__th--inversor">Inversor</th>
                    <th scope="col" class="table__th table__th--monto">Proximo Pago</th>
                </tr>
            </thead>

            <tbody class="table__tbody table__tbody">
                <?php
                foreach ($proximo_pagos as $proximo_pago) {
                    // Convertir la fecha de finalización del contrato a timestamp
                    $fecha_fin_timestamp = strtotime($proximo_pago->fecha_fin);
                    // Obtener el tiempo actual en timestamp
                    $tiempo_actual_timestamp = time();
                    // Verificar si la fecha de finalización ha pasado
                    $fecha_fin_pasada = $fecha_fin_timestamp < $tiempo_actual_timestamp;
                    // Agregar una clase condicional según si la fecha de finalización ha pasado o no
                    $clase_fecha_pasada = $fecha_fin_pasada ? 'fecha-pasada' : '';
                ?>
                    <tr class="table__tr table__tr--body <?php echo $clase_fecha_pasada; ?>">
                        <td class="table__td table__td--id">
                            <?php echo $proximo_pago->id; ?>
                        </td>
                        <td class="table__td table__td--inversor">
                            <?php echo $proximo_pago->inversionista->nombre . " " . $proximo_pago->inversionista->apellido ?>
                        </td>
                        <td class="table__td table__td--monto">
                            <?php echo date("d/m/Y", strtotime($proximo_pago->proximo_pago)); ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No Hay Contratos Aún</p>
    <?php } ?>
</div>
    <div class="bloques__grid">
        <div class="bloque">
            <h3 class="bloque__heading">Total Clientes</h3>
            <div class="bloque__contenido">
                <p class="bloque__texto">
                    <?php echo count($clientes); ?>
                </p>
            </div>
            <div class="bloque__abajo">
                <h3 class="bloque__heading2">Ultimos Registros:</h3>
                <div class="bloque__contenido">
                    <div class="bloque__registros">
                        <?php foreach($registros as $registro) { ?>
                            <?php if($registro->admin === "0") { ?>
                                <p><?php echo $registro->nombre . " " . $registro->apellido; ?></p>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bloque">
            <h3 class="bloque__heading">Contratos</h3>
            <div class="bloque__contenido">
                <div class="bloque__flex">
                    <div>
                        <div class="bloque__flex--contenedor">
                            <h3 class="bloque__heading2">Total:</h3>
                            <p class="bloque__texto2"><?php echo count($contratos); ?></p>
                        </div>
                    </div>
                    <div>
                        <div class="bloque__flex--contenedor">
                            <h3 class="bloque__heading2">Activos:</h3>
                            <p class="bloque__texto2"><?php echo $contratos_activos; ?></p>
                        </div>
                    </div>
                    <div>
                        <div class="bloque__flex--contenedor">
                            <h3 class="bloque__heading2">Vencidos:</h3>
                            <p class="bloque__texto2"><?php echo $contratos_vencidos; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloque__abajo bloque__abajo--contratos">
                <div>
                    <h3 class="bloque__heading2">Inversión total de contratos:</h3>
                    <div class="bloque__contenido">
                        <p class="bloque__texto2">$ <?php echo number_format($ingresos, 2); ?></p>
                    </div>
                </div>
                <div>
                    <h3 class="bloque__heading2">Interés total en contratos:</h3>
                    <div class="bloque__contenido">
                        <p class="bloque__texto2">$ <?php echo number_format($interes, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</main>