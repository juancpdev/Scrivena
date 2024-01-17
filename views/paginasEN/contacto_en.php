<main class="contacto">
    <?php include_once __DIR__ . "/../templates/paginas-titulo.php" ?>
        <div class="caja_boton_consulta">
        <a class="boton_consulta" target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScl3bNyS9g4F8Qv8DgZBypN9fL-johOmN-R443h-7UBF9VuqA/viewform">SCHEDULE A CONSULTATION</a>
        </div>
    </div>
    <main>
        <div class="midseccion">
            <h2>Connect with Our Investment Experts</h2>
            <p>2525 Ponce de Leon Boulevard, Coral Gables, Miami, FL 33134, USA.</p>
        </div>
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <div class="formulario-contenedor">
            <form class="formulario" novalidate>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-nombre">First and Last Name</p>
                    </div>
                    <div class="campo_contenedor-abajo campo_contenedor-nombre">
                        <div class="campo">
                            <input type="text" name="nombre" id="nombre" placeholder="First Name">
                        </div>
                        <div class="campo">
                            <input type="text" name="apellido" id="nombre" placeholder="Last Name">
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
                            <input class="input-email" type="email" name="email" id="email" placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">3.</span>
                        <p class="campo-email">Phone Number</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="input-telefono" id="telefono" type="number" name="telefono" placeholder="Enter your phone number">
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
                            <textarea id="mensaje" name="mensaje" placeholder="Message" rows="8"></textarea>
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton" type="button" value="Send Message">
                </div>
            </form>
        </div>
    </main>
</main>
