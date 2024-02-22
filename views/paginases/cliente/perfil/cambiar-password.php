<?php 
if (isset($contraActualizada) && $contraActualizada) {
    // Verificar el idioma
    $lang = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'en';

    // Definir los mensajes y redirecciones en inglés y español
    $data = array(
        'es' => array(
            'title' => 'Contraseña Actualizada',
            'text' => 'La contraseña fue actualizada correctamente!',
            'confirmButtonText' => 'OK',
            'redirectUrl' => '/cliente/panel?lang=es'
        ),
        'en' => array(
            'title' => 'Password Updated',
            'text' => 'The password was updated successfully!',
            'confirmButtonText' => 'OK',
            'redirectUrl' => '/client/dashboard?lang=en'
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


<h2 class="auth__heading"><?php echo $titulo; ?></h2>

<p class="auth__texto">Coloca tu nueva contraseña</p>
<div class="dashboard__contenedor--boton">
<a class="dashboard__boton" href="/cliente/perfil?lang=es">
    <i class="fa-solid fa-angles-left"></i>
    Volver
</a>

</div>
    <div class="caja-contenedor-formulario">
        <div class="contenedor-formulario contenedor-formulario--reestablecer">
            <?php
            require_once __DIR__ . '/../../../templates/alertas.php';
            ?>

            <form method="POST" class="formulario formulario--olvide" novalidate>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">1.</span>
                        <p class="campo-titulo">Contraseña Actual</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password_actual" id="password_actual" placeholder="Contraseña Actual">
                        </div>
                    </div>
                </div>
                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">2.</span>
                        <p class="campo-titulo">Contraseña Nueva</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password_nuevo" id="password_nuevo" placeholder="Nueva Contraseña">
                        </div>
                    </div>
                </div>

                <div class="campo-contenedor">
                    <div class="campo_contenedor-arriba">
                        <span class="campo-orden">2.</span>
                        <p class="campo-titulo">Repetir Contraseña Nueva</p>
                    </div>
                    <div class="campo_contenedor-abajo">
                        <div class="campo">
                            <input class="formulario__input input-password" type="password" name="password_nuevo2" id="password_nuevo2" placeholder="Confirmar Contraseña">
                        </div>
                    </div>
                </div>

                <div class="contenedor-boton">
                    <input class="boton boton--login" type="submit" value="Guardar Contraseña">
                </div>
            </form>
