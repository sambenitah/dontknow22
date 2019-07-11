<?php
use DontKnow\Core\Routing;
use DontKnow\Dao\Users;

$user = resolve(Users::class);

if($user->logged()){
    header('Location: '.Routing::getSlug("Statistics","default").'');
}

?>

<main>
    <section id="SectionOneLogUser">
        <h1 id="TitleAddLogUser">New Password</h1>
            <?php $this->addModal("form", $form);?>
    </section>
</main>