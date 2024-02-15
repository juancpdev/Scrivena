<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="dashboard__contenedor--boton">
    <a class="dashboard__boton" href="/admin/clientes">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="caja-contenedor-formulario">
    <div class="contenedor-formulario contenedor-formulario--cliente">
        <?php
        require_once __DIR__ . '/../../templates/alertas.php';
        ?>

        <form method="POST" class="formulario formulario--cliente">
            <?php include_once __DIR__ . '/formulario.php'; ?>

            <div class="contenedor-boton">
                <input class="boton boton--login" type="submit" value="Actualizar Cliente">
            </div>
        </form>
    </div>