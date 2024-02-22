<?php if($cambiopass === "0") { ?>
    <div class="cambiopass">
        <p>
            <i class="fa-solid fa-triangle-exclamation"></i> 
            For security reasons it is important that you change the password provided by the administrator
            <a href="/cliente/cambiar-password?lang=<?php echo $idioma; ?>">Click here.</a>
        </p>
    </div>
<?php } ?>

<h2 class="titulo-area dashboard__heading"> <?php echo $titulo; ?> </h2>

<main class="main--area_cliente">
    <div class="area_cliente">
        <div class="info-grafico--clientes">
            <div class="contenedor-datos-gafica">
                <div class="color-inversion"></div>
                <p>Investments</p>
            </div>
            <div class="contenedor-datos-gafica">
                <div class="color-interes"></div>
                <p>Interests</p>
            </div>
        </div>
        <div class="area-cliente">
            <div class="dashboard__grafica__cliente">
                <canvas id="inversion-grafica" width="400" height="400"></canvas>
                <div class="dashboard__grafica__cliente--balance">
                    <p class="titulo">Balance Total</p>
                    <p class="balance" id="balance-total"></p>
                </div>
            </div>
        </div>

        <div class="cliente__contratos">
          
            <a class="cliente__contratos--activos" href="/cliente/contratos?lang=es">
                <div>
                    <p>Active Contracts: <span><?php echo $contratosActivos; ?></span></p>
                </div>
            </a>
           
            <div>
                <div>
                    <h4 class="cliente__contratos--titulo">Next Payments</h4>
                    <table class="table table--clientes">
                        <thead class="table__thead table__thead--pagos">
                            <tr class="table__tr">
                                <th scope="col" class="table__th table__th--n-cliente">Nº</th>
                                <th scope="col" class="table__th table__th--fecha-cliente">Date</th>
                                <th scope="col" class="table__th table__th--interes-cliente">Interest</th>
                            </tr>
                        </thead>
                        <tbody class="table__tbody table__tbody">
                            <?php
                                $contador = 1;
                                foreach($contratos as $contrato) {
                                    if ($contrato->estado === "Activo") {
                            ?>
                            <tr class="table__tr table__tr--body table__tr--colores">
                                <td class="table__td table__td--id">
                                    <?php echo $contador; ?>
                                </td>
                                <td class="table__td table__td--monto">
                                    <?php echo date("d/m/Y", strtotime($contrato->proximo_pago)); ?>
                                </td>
                                <td class="table__td table__td--id">
                                    $<?php echo $contrato->inversion * ($contrato->porcentaje / 100); ?>
                                </td>
                            </tr>
                            <?php } $contador++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</main>