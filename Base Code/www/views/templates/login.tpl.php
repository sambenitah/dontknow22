<?php
use DontKnow\Core\Routing;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>IDK.</title>
    <meta charset="utf-8">
    <meta name="description"
          content="Créez un blog ou un site Web haut de gamme. Assistance en direct. Commencez ! Hébergement Gratuit. Des Centaines de Designs. Live Chat & Aide Par Mail. Stats Faciles à Lire. Prêt pour le Mobile. Évolutif et Sécurisé. SEO Intégré. Aide Rapide et Conviviale.">
    <link rel="stylesheet" type="text/css" href="/public/css/Back-css/style.css">
    <link rel="stylesheet" type="text/css" href="/public/css/Grid/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/Commercial-css/commercial.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="/public/js/addPages.js"></script>
    <script src="/public/js/admin.tpl.js"></script>
</head>
<body>
<header>
    <div class="row">
        <div id="backgroundHeader" class="col-12 col-m-12 col-l-12">
            <a href="<?php echo Routing::getSlug("Articles", "yourWebSite"); ?>" id="headerPartMainSection">

                Dont Kn?w

            </a>
        </div>
    </div>
</header>

<?php include $this->v; ?>

</body>
</html>
