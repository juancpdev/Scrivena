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
    if ($langParam === 'es') {
        header('Location: /cliente/panel?lang=es');
        exit();
    } else if ($langParam === 'en') {
        header('Location: /client/dashboard?lang=en');
        exit();
    }
}

if (isset($contraActualizada) && $contraActualizada) {
    // Verificar el idioma
    $lang = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'en';

    // Definir los mensajes y redirecciones en inglés y español
    $data = array(
        'es' => array(
            'title' => 'Contraseña Actualizada',
            'text' => 'La contraseña fue actualizada correctamente!',
            'confirmButtonText' => 'OK',
            'redirectUrl' => '/acceder?lang=es'
        ),
        'en' => array(
            'title' => 'Password Updated',
            'text' => 'The password was updated successfully!',
            'confirmButtonText' => 'OK',
            'redirectUrl' => '/login?lang=en'
        )
    );

    // Obtener los datos según el idioma
    $info = $data[$lang];

    // Mostrar el mensaje en el idioma correspondiente
    echo "
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: '{$info['title']}',
                text: '{$info['text']}',
                confirmButtonText: '{$info['confirmButtonText']}'
            }).then(function() {
                window.location.href = '{$info['redirectUrl']}';
            });
        };
    </script>
    ";
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



