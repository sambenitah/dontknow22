<?php foreach ($ErrorPage as $key => $error):?>
<div id="partSupErrorPage" style="background-color: <?php echo $error->background_color;?>;"></div>
        <p id="textErrorPage" style="color:<?php echo $error->text_color;?>;"><?php echo $error->content;?></p>
        <a id="returnErrorPage" style="color:<?php echo $error->text_color;?>;" href="<?php echo Routing::getSlug("Users","default");?>">Return to homepage</a>
<div id="partInfErrorPage" style="background-color: <?php echo $error->background_color;?>;"></div>
<?php endforeach;?>