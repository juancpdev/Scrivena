<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Recupera tu acceso a Scrivena</p> 

    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--olvide">
            <?php
            require_once __DIR__ . '/../templates/alertas.php';
            ?>
            <form method="POST" action="/olvide" class="formulario formulario--olvide">

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-titulo">Email</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input 
                                class="formulario__input input-email" 
                                type="email" 
                                name="email" 
                                id="email" 
                                placeholder="Email">
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton boton--login" type="submit" value="Enviar Instrucciones">
                </div>
            
                <div class="acciones">
                    <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>
</main>