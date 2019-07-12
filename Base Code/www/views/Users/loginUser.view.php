<?php
use DontKnow\Core\Routing;
use DontKnow\Dao\Users;
?>

<main>
    <section id="SectionOneLogUser">
        <h1 id="TitleAddLogUser">Log In</h1>
        <p id="t1--AddLogUser"><a id="a1--AddLogUser" href="<?=Routing::getSlug("Users","forgetPassword") ?>">Forget Password  </a>Or <a id="a1--AddLogUser"  href="<?=Routing::getSlug("Users","register") ?>">Create account</a></p>
            <?php $this->addModal("form", $form);?>
    </section>
</main>