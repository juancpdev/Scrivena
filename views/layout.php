<!DOCTYPE html>
<html lang="en">

<script>
    (function(d, w, c) {
        w.BrevoConversationsID = '65aad6e5e1f72d4bfd439584';
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        var s = d.createElement('script');
        s.async = true;
        s.src = 'https://conversations-widget.brevo.com/brevo-conversations.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'BrevoConversations');
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrivena - <?php echo $titulo; ?></title>
    <link rel="icon" href="/build/img/favicon-scrivena.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css?v=2.1">
    <!-- HTML Meta Tags -->
    <title>Scrivena - Líder en Inversiones</title>
    <meta name="description" content="Invierte en el futuro con nuestro fondo de inversión líder, ofreciendo estrategias personalizadas y rendimientos sostenibles.">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://scrivena.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Scrivena - Líder en Inversiones">
    <meta property="og:description" content="Invierte en el futuro con nuestro fondo de inversión líder, ofreciendo estrategias personalizadas y rendimientos sostenibles.">
    <meta property="og:image" content="https://opengraph.b-cdn.net/production/documents/8ae9a36d-be4d-4d4f-8a26-aaa8bbcb386c.png?token=I74xyBWSOW3jtZ-rwojdXXcBjz-FKf7pVhMVxDx9fQM&height=630&width=1200&expires=33241576709">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="scrivena.com">
    <meta property="twitter:url" content="https://scrivena.com/">
    <meta name="twitter:title" content="Scrivena - Líder en Inversiones">
    <meta name="twitter:description" content="Invierte en el futuro con nuestro fondo de inversión líder, ofreciendo estrategias personalizadas y rendimientos sostenibles.">
    <meta name="twitter:image" content="https://opengraph.b-cdn.net/production/documents/8ae9a36d-be4d-4d4f-8a26-aaa8bbcb386c.png?token=I74xyBWSOW3jtZ-rwojdXXcBjz-FKf7pVhMVxDx9fQM&height=630&width=1200&expires=33241576709">

    <!-- Meta Tags Generated via https://www.opengraph.xyz -->

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin="" defer></script>
    <script src="https://kit.fontawesome.com/477cb6ab4e.js" crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DJ84FH707W"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-DJ84FH707W');
    </script>
</head>

<body>
    <?php
    $idioma = isset($_GET['lang']) && ($_GET['lang'] === 'en' || $_GET['lang'] === 'es') ? $_GET['lang'] : 'es';

    $headerPath = __DIR__ . "/templates/header-{$idioma}.php";
    $footerPath = __DIR__ . "/templates/footer-{$idioma}.php";

    if (file_exists($headerPath)) {
        include_once $headerPath;
    }

    echo $contenido;

    if (file_exists($footerPath)) {
        include_once $footerPath;
    }

    ?>
    <script src="/build/js/bundle.js?v=2.1" defer></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
</body>

</html>