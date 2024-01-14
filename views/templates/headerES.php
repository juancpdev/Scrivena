<?php
// Obtén el valor de la variable 'lang' desde la URL
$langParam = isset($_GET['lang']) ? $_GET['lang'] : 'es';

// Verifica si estamos en la página de inicio
$isHomePage = ($_SERVER['REQUEST_URI'] == '/' || strpos($_SERVER['REQUEST_URI'], '/?lang=es') !== false || strpos($_SERVER['REQUEST_URI'], '/?lang=en') !== false);

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
    <div class="caja_nav">
        <nav class="navegacion_principal">
            <ul class="lista_nav">
                <li>
                    <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                </li>
                <hr>
                <li>
                    <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                </li>
                <hr>
                <li>
                    <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                </li>
                <hr>
                <li>
                    <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                </li>
                <hr>
                <li>
                    <a href="/login?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Acceder</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="caja_nav-desktop">
        <nav class="navegacion_principal-desktop">
            <ul class="lista_nav-desktop">
                <li>
                    <a href="/servicios?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Servicios</a>
                </li>
                <li>
                    <a href="/nosotros?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Nosotros</a>
                </li>
                <li>
                    <a href="/portafolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Portafolio</a>
                </li>
                <li>
                    <a href="/contacto?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">Contacto</a>
                </li>
                <li>
                    <a href="/login?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>"><i class="fa-solid fa-right-to-bracket"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    <?php if ($isHomePage): ?>
        <div class="language-toggle">
            <div class="language-option">ES</div>
            <div class="toggle-button">
                <div class="circle"></div>
            </div>
            <div class="language-option">EN</div>
        </div>
    <?php endif; ?>
</header>