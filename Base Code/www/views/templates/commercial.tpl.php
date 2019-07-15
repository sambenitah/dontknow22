<?php
use DontKnow\Core\Routing;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
      <title>IDK.</title>
      <meta charset="utf-8">
      <meta name="description" content="Créez un blog ou un site Web haut de gamme. Assistance en direct. Commencez ! Hébergement Gratuit. Des Centaines de Designs. Live Chat & Aide Par Mail. Stats Faciles à Lire. Prêt pour le Mobile. Évolutif et Sécurisé. SEO Intégré. Aide Rapide et Conviviale.">
      <link rel="stylesheet" type="text/css" href="../../Public/css/Commercial-css/commercial.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  </head>
  <body>
    <header>
        <div class="container">
            <nav class="menu">
                <a class="logo" href="<?php echo Routing::getSlug("Pages","default");?>"> idk. </a>
                <div class="m-left">
                    <a class="m-link" href="#premium">TEMPLATES</a>
                    <a class="m-link" href="#aide">PRICING</a>
                    <a class="m-link" href="#">OUR CUSTOMERS</a>
                </div>
                <div class="m-right">
                    <a class="m-link" href="<?php echo Routing::getSlug("Installer","download");?>">CREATE A SITE</a></li>
                </div>

        <!-- If Display < 950px -->

                <div class="m-nav-toggle">
                    <span>
                        <i class="m-nav-toggle-icon fas fa-bars fa-2x"></i>
                    </span>
                </div>
            </nav>
        </div>

        <nav class="menuHidden">
            <div id="nav-bis" class="m-bis-no-visible">
                <a class="m-link m-link-bis" href="#premium">Templates</a>
                <a class="m-link m-link-bis" href="#aide">Pricing</a>
                <a class="m-link m-link-bis" href="#">Our Customers</a>
<!--                <a class="m-link m-link-bis" href="#inscrire">Sign in</a></li>-->
                <a class="m-link m-link-bis" href="#connecter">Create a site</a></li>
            </div>
        </nav>

        <!-- End Display < 950px -->
    </header>


          <?php include $this->v;?>


    <footer>
            <div class="col-footer">
                <p class="titleFooter">Tour</p>
                <a class="linkFooter" href="#">Website Templates</a>
                <a class="linkFooter" href="#">Websites</a>
                <a class="linkFooter" href="#">Domains</a>
                <a class="linkFooter" href="#">Only stores</a>
            </div>
            <div class="col-footer">
                <p class="titleFooter">Customers</p>
                <a class="linkFooter" href="#">Featured</a>
                <a class="linkFooter" href="#">Small Buisness</a>
                <a class="linkFooter" href="#">Domains</a>
                <a class="linkFooter" href="#">Bloggers</a>

            </div>
            <div class="col-footer">
                <p class="titleFooter">Compagny</p>
                <a class="linkFooter" href="#">About</a>
                <a class="linkFooter" href="#">Careers</a>
                <a class="linkFooter" href="#">Press & Medias</a>
                <a class="linkFooter" href="#">Term of Service</a>

            </div>
            <div class="col-footer">
                <p class="titleFooter">Community</p>
                <a class="linkFooter" href="#">Help & Support</a>
                <a class="linkFooter" href="#">Workshop</a>
                <a class="linkFooter" href="#">Specialists</a>
                <a class="linkFooter" href="#">Circle</a>

            </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../public/js/commercial.tpl.js"></script>
  </body>

</html>

