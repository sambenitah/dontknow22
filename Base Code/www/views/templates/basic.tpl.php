<?php
use DontKnow\Core\Routing;
use DontKnow\Dao;
use DontKnow\Dao\Users;


$categories = resolve(\DontKnow\Controllers\CategoriesController::class);
$categories = $categories->listAllCategoriesAction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo resolve(Dao\Customizer::class)->selectMeta(["id"=>1]) ?></title>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo resolve(Dao\Customizer::class)->selectMeta(["id"=>2]) ?>">
    <link rel="stylesheet" type="text/css" href="/../../Public/css/Front-css/style.css">
    <link rel="stylesheet" type="text/css" href="/../../Public/css/Back-css/style.css">
    <link rel="stylesheet" type="text/css" href="/../../Public/css/Grid/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="/public/js/addPages.js"></script>
    <script src="/public/js/admin.tpl.js"></script>
    <script src="/public/js/script.js"></script>
</head>
<body>
<?php  $style = resolve(Dao\Customizer::class)->tableWithStyle();?>
<style>
    .front{
        background-color: <?php echo $style["colorFront"];?> !important;
    }
    .post-content{
        background-color: <?php echo $style["postContentColor"];?> !important;
    }

    a{
        color: <?php echo $style["aColor"];?>; !important;
    }
</style>
<header>
    <?php if(isset($_SESSION['auth']) && ($_SESSION["role"] >= 2)): ?>
    <div class="row">
        <div id="backgroundHeader" class="col-12 col-m-12 col-l-12">
            <div id="menu">
                <ul>
                    <li><a href="<?php echo Routing::getSlug("Statistics","default");?>" id="headerPartMainSection">Dont Kn?w</a>
                        <ul>
                            <li><a href="<?php echo Routing::getSlug("Customizer","default");?>">Customizer</a></li>
                            <li><a href="<?php echo Routing::getSlug("Articles","addArticle");?>">Add Article</a></li>
                            <li><a href="<?php echo Routing::getSlug("Articles","showArticles");?>">Your Articles</a></li>
                            <li><a href="<?php echo Routing::getSlug("Pictures","showPictures");?>">Your pictures</a></li>
                            <li><a href="<?php echo Routing::getSlug("Pictures","addPicture");?>">Add picture</a></li>
                            <li><a href="<?php echo Routing::getSlug("Categories","addCategory");?>">Add Category</a></li>
                            <li><a href="<?php echo Routing::getSlug("Categories","showCategory");?>">Your Categories</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <a href="<?php echo Routing::getSlug("Users","logout");?>" style="float: right;margin: 0.5em; margin-right: 1em; font-size: 1.5em; color: #FFF;"><i class="far fa-user-circle"></i></a>
            <a id="welcomePartMainSection">Welcome <?php echo $_SESSION['auth']; ?> on your website</a>
        </div>
    </div>
    <?php endif; ?>
</header>

<div class="front">
    <div id="main-content">
        <div class="mobile">
            <div class="container">
                <div class="menu-mobile">
                    <span class="item item-1"></span>
                    <span class="item item-2"></span>
                    <span class="item item-3"></span>
                </div>
                <div class="logo">
                    <a href="<?php echo Routing::getSlug("Articles", "default"); ?>"><?php echo resolve(Dao\Customizer::class)->selectMeta(["id"=>1]) ?></a>
                </div>
            </div>
        </div>
        <div class="hide-menu"></div>
        <div class="container">
            <div class="row">
                <div class="col-l-3">
                    <div class="header" style="position: fixed">
                        <div class="table">
                            <div class="table-cell">
                                <div class="logo">
                                    <a href="<?php echo Routing::getSlug("Articles", "default"); ?>"><?php echo resolve(Dao\Customizer::class)->selectMeta(["id"=>1]) ?></a>
                                </div>
                                <div class="main-menu">
                                    <nav>
                                        <ul class="menu-list">
                                            <li class="active">
                                                <a href="<?php echo Routing::getSlug("Articles", "default"); ?>">Home</a>
                                            </li>
                                            <?php foreach ($categories as $key => $category):?>
                                                <li>
                                                    <a href="/Articles/showArticleWithCategory?category=<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
                                                </li>
                                            <?php endforeach;?>
                                            <?php if (resolve(Dao\Customizer::class)->selectContact(["id"=>1]) != "0"):?>
                                            <li>
                                                <a href="#">Contact</a>
                                            </li>
                                            <?php endif;?>
                                            <?php if (!resolve(Users::class)->logged()):?>
                                                <li>
                                                    <a href="<?php echo Routing::getSlug("Users", "register"); ?>">Sign In</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo Routing::getSlug("Users", "login"); ?>">Sign Up</a>
                                                </li>
                                            <?php endif;?>
                                            <?php if (resolve(Users::class)->logged()):?>
                                                <li>
                                                    <a href="<?php echo Routing::getSlug("Users", "logout"); ?>">Logout</a>
                                                </li>
                                            <?php endif;?>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="socials">
                                    <a href="#" title="Facebook">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                    <a href="#" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" title="Search this site">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                                <div class="box-search">
                                    <div class="table">
                                        <div class="table-cell">
                                            <div class="container">

                                                    <form method="post" action="/Articles/showArticleWithContent">
                                                        <input style="margin-bottom: 20px" class="search-field" type="text" name="like" placeholder="Search content">

                                                        <button class="bouttonConfirmForm" type="submit">Search</button>
                                                    </form>
                                                <div class="kd-close">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include $this->v; ?>
            </div>
        </div>
    </div>
</body>
</html>

