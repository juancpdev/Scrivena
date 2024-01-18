<main class="contacto">
    <?php include_once __DIR__ . "/../templates/paginas-titulo.php" ?>
        <div class="caja_boton_consulta">
            <a class="boton_consulta" target="_blank" href="https://forms.gle/fXpATXWUu17pNrFu7">AGENDA UNA CONSULTA</a>
        </div>
    </div>
    <main>
        <div class="midseccion">
            <h2>Conéctese con Nuestros Expertos en Inversión</h2>
            <p>2525 Ponce de Leon Boulevard, Coral Gables, Miami, FL 33134, USA.</p>
        </div>

        <div class="formulario-contenedor">
            <form method="POST" action="/contacto?lang=es" class="formulario">
            <?php if($mensaje) { ?>
                <div class="contenedor-alerta">
                    <p class="alerta-correcto"> <?php echo $mensaje; ?> </p>
                </div>
            <?php } ?>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-nombre">Nombre y Apellido</p>
                    </div>
                    <div class="campo_contenedor-abajo campo_contenedor-nombre">
                        <div class="campo">
                            <input type="text" name="contacto[nombre]" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="campo">
                            <input type="text" name="contacto[apellido] id="nombre" placeholder="Apellido" required>
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">2.</span>
                        <p class="campo-email">Email</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="input-email" type="email" name="contacto[email]" id="email" placeholder="Email" required>
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">3.</span>
                        <p class="campo-email">Número de teléfono</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="input-telefono" id="telefono" type="number" name="contacto[telefono]" placeholder="Teléfono" required>
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">4.</span>
                        <p class="campo-email">Mensaje</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <textarea id="mensaje" name="contacto[mensaje]" placeholder="Mensaje" rows="8" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton" type="submit" value="Enviar Mensaje">
                </div>
            </form>
        </div>
    </main>
</main>