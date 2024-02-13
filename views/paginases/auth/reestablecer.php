<?php
// Obtén el valor de la variable 'lang' desde la URL
$langParam = isset($_GET['lang']) ? $_GET['lang'] : 'es';

// Inicia la sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

if (is_admin()) {
    // Si ya ha iniciado sesión, redirige a otra página (puedes elegir la que desees)
    header("Location: /admin/dashboard");
    exit(); // Asegura que el script no continúe después de la redirección
}

// Verifica si ya ha iniciado sesión
if (is_auth()) {
    // Si ya ha iniciado sesión, redirige a otra página (puedes elegir la que desees)
    header("Location: /cliente/dashboard?lang=$langParam");
    exit(); // Asegura que el script no continúe después de la redirección
}

?>

<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Coloca tu nueva contraseña</p> 

    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--reestablecer">
        <?php
        require_once __DIR__ . '/../../templates/alertas.php';
        ?>
        
        <?php if($token_valido) { ?>
            <form method="POST" class="formulario formulario--olvide" novalidate>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-titulo">Contraseña</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input 
                                class="formulario__input input-password" 
                                type="password" 
                                name="password" 
                                id="password" 
                                placeholder="Nueva Contraseña">
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
                            <input 
                                class="formulario__input input-password" 
                                type="password" 
                                name="password2" 
                                id="password2" 
                                placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton boton--login" type="submit" value="Guardar Contraseña">
                </div>
        <?php } ?>
                <div class="acciones">
                    <a href="/acceder?lang=es" class="acciones__enlace">¿Ya tienes cuenta? Iniciar Sesión</a>
                </div>
            </form>
</main>



