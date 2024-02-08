<?php
// Obtén el valor de la variable 'lang' desde la URL
$langParam = isset($_GET['lang']) ? $_GET['lang'] : 'es';

// Verifica si estamos en la página de inicio
$isHomePage = ($_SERVER['REQUEST_URI'] == '/' || strpos($_SERVER['REQUEST_URI'], '/?lang=es') !== false || strpos($_SERVER['REQUEST_URI'], '/?lang=en') !== false);

// Inicia la sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}
?>

<header class="header">

    <div class="contenedor_logo">
        <a href="/?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">
            <picture>
                <source srcset="build/img/LOGOSCRIVENA.avif" type="image/avif">
                <source srcset="build/img/LOGOSCRIVENA.webp" type="image/webp">
                <img class="logo" loading="lazy" src="build/img/LOGOSCRIVENA.png">
            </picture>
        </a>
        <div class="abrir_menu">
            <i class="fa-solid fa-bars menubarra"></i>
        </div>
    </div>

    <div class="caja_nav-desktop">
        <nav class="navegacion_principal-desktop">

            <?php if (is_auth()) { ?>
                <ul class="lista_nav-desktop">
                    <li>
                        <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                    </li>
                    <li>
                        <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                    </li>
                    <li>
                        <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                    </li>
                    <li>
                        <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                    </li>
                    <li>
                        <a href="<?php echo is_admin() ? '/admin/dashboard?lang=' . (isset($_GET['lang']) ? $_GET['lang'] : 'es') : '/cliente/dashboard?lang=' . (isset($_GET['lang']) ? $_GET['lang'] : 'es') ?>" class="header__enlaces">
                            <?php echo is_admin() ? "Administrar" : "Perfil" ?>
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="POST" class="dashboard__form">
                            <div class="dashboard__submit--logout">
                                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
                            </div>
                        </form>
                    </li>
                </ul>

            <?php } else { ?>
                <ul class="lista_nav-desktop">
                    <li>
                        <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                    </li>
                    <li>
                        <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                    </li>
                    <li>
                        <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                    </li>
                    <li>
                        <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                    </li>
                    <li>
                        <a href="/login?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Iniciar Sesión</a>
                    </li>
                </ul>

            <?php } ?>
        </nav>
    </div>

    <div class="caja_nav">
        <nav class="navegacion_principal">
            <?php if (is_auth()) { ?>
                <ul class="lista_nav">
                    <li>
                        <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                    </li>
                    <li>
                        <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                    </li>
                    <li>
                        <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                    </li>
                    <li>
                        <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                    </li>
                    <li>
                        <a href="<?php echo is_admin() ? '/admin/dashboard?lang=' . (isset($_GET['lang']) ? $_GET['lang'] : 'es') : '/dashboard?lang=' . (isset($_GET['lang']) ? $_GET['lang'] : 'es') ?>" class="header__enlaces">
                            <?php echo is_admin() ? "Administrar" : "Perfil" ?>
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="POST" class="dashboard__form">
                            <div class="dashboard__submit--logout">
                                <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
                            </div>
                        </form>
                    </li>
                </ul>

            <?php } else { ?>
                <ul class="lista_nav">
                    <li>
                        <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                    </li>
                    <li>
                        <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                    </li>
                    <li>
                        <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                    </li>
                    <li>
                        <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                    </li>
                    <li>
                        <a href="/login?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Iniciar Sesión</a>
                    </li>
                </ul>

            <?php } ?>
        </nav>
    </div>



    <?php include_once __DIR__ . "/btn-idioma.php" ?>
</header>