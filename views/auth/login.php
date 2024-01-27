<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia sesión en DevWebcamp</p>

    <?php
    require_once __DIR__ . '/../templates/alertas.php';
    ?>
    <div class="formulario-contenedor">
        <form method="POST" action="/login" class="formulario">

            <div class="campo-contenedor">
                <div class="campo_contenedor-arriba">
                    <span class="campo-orden">1.</span>
                    <p>Email</p>
                </div>
                <div class="campo_contenedor-abajo">
                    <div class="campo">
                        <input class="formulario__input input-email" type="email" name="email" id="email" placeholder="Email">
                    </div>
                </div>
            </div>

            <div class="campo-contenedor">
                <div class="campo_contenedor-arriba">
                    <span class="campo-orden">2.</span>
                    <p>Password</p>
                </div>
                <div class="campo_contenedor-abajo">
                    <div class="campo">
                        <input class="formulario__input input-password" type="password" name="email" id="password" placeholder="Password">
                    </div>
                </div>
            </div>

            <input type="submit" class="formulario__submit" value="Iniciar Sesión">

            <div class="acciones">
                <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
            </div>
        </form>
    </div>
</main>