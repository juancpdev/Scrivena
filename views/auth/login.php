<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Inicia sesión en Scrivena</p>

    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--login">
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>
            <form method="POST" action="/login" class="formulario formulario--login">

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-titulo">Email</p>
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
                        <p class="campo-titulo">Password</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton boton--login" type="submit" value="Iniciar Sesión">
                </div>
            
                <div class="acciones">
                    <a href="/olvide" class="acciones__enlace">¿Olvidaste tu Password?</a>
                </div>
            </form>
        </div>
    </div>
</main>