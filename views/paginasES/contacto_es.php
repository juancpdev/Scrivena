<main class="contacto">
    <?php include_once __DIR__ . "/../templates/paginas-titulo.php" ?>
    <main>
        <div class="midseccion">
            <h2>Contáctenos</h2>
            <p>2525 Ponce de Leon Boulevard, Coral Gables, Miami, FL 33134, USA.</p>
        </div>
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <div class="formulario-contenedor">
            <form action="/contacto" method="POST" class="formulario" novalidate>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-nombre">Nombre y Apellido</p>
                    </div>
                    <div class="campo_contenedor-abajo campo_contenedor-nombre">
                        <div class="campo">
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="campo">
                            <input type="text" name="apellido" id="nombre" placeholder="Apellido">
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
                        <p class="campo-email">Número de teléfono</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="input-telefono" id="telefono" type="number" name="telefono" placeholder="Escribe tu teléfono">
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
                            <textarea id="mensaje" name="mensaje" placeholder="Mensaje" rows="8"></textarea>
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