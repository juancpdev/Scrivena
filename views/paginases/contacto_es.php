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

        <div class="caja-contenedor-contacto">
            <div class="contenedor-contacto">
                <?php if ($mensaje) { ?>
                    <div class="contenedor-alerta">
                        <?php
                        // Verificar si la cadena $mensaje contiene la palabra "no"
                        if (strpos(strtolower($mensaje), 'no') !== false) {
                            // La palabra "no" está presente, aplicar la clase de error
                            echo '<p class="alerta alerta__error">' . $mensaje . '</p>';
                        } else {
                            // La palabra "no" no está presente, aplicar la clase de éxito
                            echo '<p class="alerta alerta__exito">' . $mensaje . '</p>';
                        }
                        ?>
                    </div>
                <?php } ?>
                <form method="POST" action="/contacto?lang=es" class="formulario">

                    <div class="campo-contenedor">
                        <div class="campo_contenedor-arriba">
                            <span class="campo-orden">1.</span>
                            <p class="campo-titulo">Nombre y Apellido</p>
                        </div>
                        <div class="campo_contenedor-abajo campo_contenedor-nombre">
                            <div class="campo">
                                <input type="text" name="contacto[nombre]" id="nombre" placeholder="Nombre" required>
                            </div>
                            <div class="campo">
                                <input type="text" name="contacto[apellido] id=" nombre" placeholder="Apellido" required>
                            </div>
                        </div>
                    </div>

                    <div class="campo-contenedor">
                        <div class="campo_contenedor-arriba">
                            <span class="campo-orden">2.</span>
                            <p class="campo-titulo">Email</p>
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
                            <p class="campo-titulo">Número de teléfono</p>
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
                            <p class="campo-titulo">Mensaje</p>
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
        </div>
    </main>
</main>