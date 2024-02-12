<main class="contacto">
    <?php include_once __DIR__ . "/../templates/paginas-titulo.php" ?>
    <div class="caja_boton_consulta">
        <a class="boton_consulta" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScl3bNyS9g4F8Qv8DgZBypN9fL-johOmN-R443h-7UBF9VuqA/viewform">SCHEDULE A CONSULTATION</a>
    </div>
    </div>
    <section>
        <div class="midseccion">
            <h2>Connect with Our Investment Experts</h2>
            <p>2525 Ponce de Leon Boulevard, Coral Gables, Miami, FL 33134, USA.</p>
        </div>

        <div class="caja-contenedor-formulario">
            <div class="contenedor-formulario">
                <?php if ($mensaje) { ?>
                    <div class="contenedor-alerta">
                        <?php
                        // Verificar si la cadena $mensaje contiene la palabra "no"
                        if (strpos($mensaje, 'Failed') !== false) {
                            // La palabra "no" está presente, aplicar la clase de error
                            echo '<p class="alerta alerta__error desaparecer-alerta">' . $mensaje . '</p>';
                        } else {
                            // La palabra "no" no está presente, aplicar la clase de éxito
                            echo '<p class="alerta alerta__exito">' . $mensaje . '</p>';
                        }
                        ?>
                    </div>
                <?php } ?>
                <form method="POST" action="/contact?lang=en" class="formulario">

                    <div class="campo-contenedor">
                        <div class="campo_contenedor-arriba">
                            <span class="campo-orden">1.</span>
                            <p class="campo-nombre">Name and Last name</p>
                        </div>
                        <div class="campo_contenedor-abajo campo_contenedor-nombre">
                            <div class="campo">
                                <input type="text" name="contacto[nombre]" id="nombre" placeholder="Name" required>
                            </div>
                            <div class="campo">
                                <input type="text" name="contacto[apellido] id=" nombre" placeholder="Last name" required>
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
                            <p class="campo-email">Phone number</p>
                        </div>
                        <div class="campo_contenedor-abajo">
                            <div class="campo">
                                <input class="input-telefono" id="telefono" type="number" name="contacto[telefono]" placeholder="Phone" required>
                            </div>
                        </div>
                    </div>

                    <div class="campo-contenedor">
                        <div class="campo_contenedor-arriba">
                            <span class="campo-orden">4.</span>
                            <p class="campo-email">Message</p>
                        </div>
                        <div class="campo_contenedor-abajo">
                            <div class="campo">
                                <textarea id="mensaje" name="contacto[mensaje]" placeholder="Message" rows="8" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="contenedor-boton">
                        <input class="boton" type="submit" value="Send Message">
                    </div>
                </form>
            </div>
    </section>
</main>