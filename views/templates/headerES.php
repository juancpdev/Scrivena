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
        <div class="lenguaje">
            <a href="?lang=en">
                <picture>
                    <source srcset="build/img/usa1.avif" type="image/avif">
                    <source srcset="build/img/usa1.webp" type="image/webp">
                    <img class="logo_lenguaje" loading="lazy" src="build/img/usa1.png">
                </picture>
            </a>
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
            </ul>
        </nav>
    </div>
</header>