<header class="header">
    <div class="contenedor_logo">
        <a href="/?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">
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
            <a href="?lang=es">
                <picture>
                    <source srcset="build/img/mx1.avif" type="image/avif">
                    <source srcset="build/img/mx1.webp" type="image/webp">
                    <img class="logo_lenguaje" loading="lazy" src="build/img/mx1.png">
                </picture>
            </a>
        </div>
    </div>
    <div class="caja_nav">
        <nav class="navegacion_principal">
            <ul class="lista_nav">
                <li>
                    <a href="/services?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Services</a>
                </li>
                    <hr>
                <li>
                    <a href="/about-us?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">About Us</a>
                </li>
                    <hr>
                <li>
                    <a href="/portfolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Portfolio</a>
                </li>
                    <hr>
                <li>
                    <a href="/contact?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="caja_nav-desktop">
        <nav class="navegacion_principal-desktop">
            <ul class="lista_nav-desktop">
                <li>
                    <a href="/services?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Services</a>
                </li>
                <li>
                    <a href="/about-us?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">About Us</a>
                </li>
                <li>
                    <a href="/portfolio?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Portfolio</a>
                </li>
                <li>
                    <a href="/contact?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'en' ?>">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
