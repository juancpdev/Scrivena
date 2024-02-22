<?php 
if (isset($perfilActualizado) && $perfilActualizado) {
    // Verificar el idioma
    $lang = isset($_GET['lang']) && $_GET['lang'] === 'es' ? 'es' : 'en';

    // Definir los mensajes y redirecciones en inglés y español
    $data = array(
        'es' => array(
            'title' => 'Perfil Actualizado',
            'text' => 'El perfil fue actualizado correctamente!',
            'confirmButtonText' => 'OK',
            'redirectUrl' => '/cliente/panel?lang=es'
        ),
        'en' => array(
            'title' => 'Profile Updated',
            'text' => 'The profile was updated successfully!',
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



<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/client/change-password?lang=en">
    <i class="fa-solid fa-rotate-left"></i> 
        Change Password
    </a>
</div>

<div class="caja-contenedor-formulario">
    <div class="contenedor-formulario contenedor-formulario--cliente">
        <?php
        require_once __DIR__ . '/../../../templates/alertas.php';
        ?>

        <form method="POST" action="/client/profile?lang=en" class="formulario formulario--cliente">
            <?php include_once __DIR__ . '/formulario.php'; ?>

            <div class="contenedor-boton">
                <input class="boton boton--login" type="submit" value="Save Changes">
            </div>
        </form>
    </div>
</div>
    