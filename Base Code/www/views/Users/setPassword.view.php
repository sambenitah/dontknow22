<?php
use DontKnow\Core\Routing;
use DontKnow\Dao\Users;

$user = resolve(Users::class);

if($user->logged()){
    header('Location: '.Routing::getSlug("Statistics","default").'');
}

$_SESSION['email'] = $email;

?>

<main>
    <section id="SectionOneLogUser">
        <h1 id="TitleAddLogUser">New Password</h1>
        <p>we send you the code at : <?=$email?></p>
            <?php $this->addModal("form", $form);?>
    </section>
</main>