<?php
use DontKnow\Core\Routing;
?>

<div class="row">
    <div  class="col-12 col-m-12 col-l-12">
        <p id="add-PagesTitle">Customizer</p>
    </div>
</div>
<div id="sectionOneCustomizer" class="row">
    <div id="leftPartCustomizer" class="col-12 col-m-6 col-l-6">
        <a class="a-Customizer" href="#">Customize the graphic chart of your website<i class="arrowCustomizer fas fa-chevron-right"></i></a>
        <a class="a-Customizer" href="<?php echo Routing::getSlug("ErrorPage","updateErrorPage");?>">Customize your error page<i class="arrowCustomizer fas fa-chevron-right"></i></a>
    </div>
    <div id="rightPartCustomizer" class="col-12 col-m-6 col-l-6">
        <a class="a-Customizer" href="<?php echo Routing::getSlug("Categories","addCategory");?>">Add / remove a category on your website <i class="arrowCustomizer fas fa-chevron-right"></i></a>
    </div>
</div>