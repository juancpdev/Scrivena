
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    
    <p class="auth__texto">Coloca tu nueva contraseña</p>
    <div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/cliente/perfil">
        <i class="fa-solid fa-angles-left"></i>
        Volver
    </a>
</div>
    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--reestablecer">
            <?php
            require_once __DIR__ . '/../../templates/alertas.php';
            ?>

            <form method="POST" class="formulario formulario--olvide" novalidate>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-titulo">Contraseña</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password" id="password" placeholder="Nueva Contraseña">
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">2.</span>
                        <p class="campo-titulo">Repetir Contraseña</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password2" id="password2" placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton boton--login" type="submit" value="Guardar Contraseña">
                </div>
            </form>
