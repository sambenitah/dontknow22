<?php
use DontKnow\Core\Routing;
?>
<div class="col-l-9">
    <div class="projects">
        <article class="post">
            <div class="post-media">
                <img src="../../public/images/Front/404.jpg">
            </div>
            <div class="post-content" style="background-color: <?php echo $ErrorPage[0]->background_color;?>;">
                <div class="the-content">
                    <?php if($ErrorPage['message'] != '') :?>
                    <h2 style="color: black"> <?php echo $ErrorPage['message'] ?></h2>
                    <?php endif; ?>
                    <h2 class="title" style="color:<?php echo $ErrorPage[0]->text_color;?>;"><?php echo $ErrorPage[0]->content?></h2>
                    <div class="post_404_not_found">
                        <div class="go-to-home">
                            <a style="color:<?php echo $ErrorPage[0]->text_color;?>;"
                               href="<?php echo Routing::getSlug("Statistics","default");?>">Return to homepage</a>
                        </div>
                    </div>
                </div>
            </div>

        </article>

    </div>
</div>
