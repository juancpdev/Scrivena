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
    <p class="auth__texto">Login Clients in Scrivena</p>

    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--login">
            <?php
            require_once __DIR__ . '/../../templates/alertas.php';
            ?>
            <form method="POST" action="/login?lang=en" class="formulario formulario--login" novalidate>

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
                    <input class="boton boton--login" type="submit" value="Login">
                </div>
            
                <div class="acciones">
                    <a href="/forget?lang=en" class="acciones__enlace">¿Did you forget your password?</a>
                </div>
            </form>
        </div>
    </div>
</main>