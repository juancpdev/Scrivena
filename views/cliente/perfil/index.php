<?php 
if (isset($perfilActualizado) && $perfilActualizado) {
    echo "
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Perfil Actualizado',
                text: 'El perfil fue actualizado correctamente!',
                confirmButtonText: 'OK'
            })
        };
    </script>
    ";
}
?>

<h2 class="dashboard__heading"> <?php echo $titulo ?> </h2>

<div class="caja-contenedor-formulario">
    <div class="contenedor-formulario contenedor-formulario--cliente">
        <?php
        require_once __DIR__ . '/../../templates/alertas.php';
        ?>

        <form method="POST" action="/cliente/perfil" class="formulario formulario--cliente">
            <?php include_once __DIR__ . '/formulario.php'; ?>

            <div class="contenedor-boton">
                <input class="boton boton--login" type="submit" value="Guardar Cambios">
            </div>
        </form>
    </div>
</div>
    