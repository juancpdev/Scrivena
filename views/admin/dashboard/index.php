<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<main class="bloques">
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
            <div class="bloque__abajo">
                <h3 class="bloque__heading2">Inversión total de contratos:</h3>
                <div class="bloque__contenido">
                    <p class="bloque__texto2">$ <?php echo $ingresos; ?></p>
                </div>
            </div>
        </div>

    </div>
</main>