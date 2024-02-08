<header class="dashboard__header dashboard__header--cliente">
    <div class="dashboard__header-grid">
    <a title="Logo" href="/?lang=<?= isset($_GET['lang']) ? $_GET['lang'] : 'es' ?>">
            <picture>
                <source srcset="/../build/img/LOGOSCRIVENA.avif" type="image/avif">
                <source srcset="/../build/img/LOGOSCRIVENA.webp" type="image/webp">
                <img class="logo" loading="lazy" src="/../build/img/LOGOSCRIVENA.png">
            </picture>
        </a>
        <nav class="dashboard__nav">
            <form action="/logout" method="POST" class="dashboard__form">
                <div class="dashboard__submit--logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <input type="submit" value="Cerrar Sesión" class="dashboard__submit--logout">
                </div>
            </form>
        </nav>
    </div>
</header>