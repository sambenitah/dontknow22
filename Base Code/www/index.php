<?php
session_start();
use DontKnow\Core\Routing;
use DontKnow\Dao\Users;

function resolve($name){
    return \DontKnow\Core\Container::getObject()->getInstance($name);
}


spl_autoload_register(function ($class) {
    $prefix = 'DontKnow\\';
    $base_dir = __DIR__ . '/';
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.class' . '.php';

    if (file_exists($file)) {
        require $file;
        return;
    }

    throw new Exception("Fichier invalide");

});


$slug = $_SERVER["REQUEST_URI"];
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = new \DontKnow\Core\Container();

$errorPage = $container->getInstance(\DontKnow\Controllers\ErrorPageController::class);

if(!isset($controller)){
    $message['message']="Controller doesn't exist";
    $errorPage->showErrorPageAction($message);
}

$cObject = $container->getInstance('DontKnow\\Controllers\\' . $controller);

if( method_exists($cObject, $action) ){
    if($connexion){
        $user = $container->getInstance(Users::class);
        if($user->logged()) {
            $userRole = $user->getRole($_SESSION['auth']);
            $_SESSION["role"] = $userRole;
            if($userRole >= $role) {
                $token = $user->getToken();
                if ($token == ($_SESSION['token'])) {
                    $user->updateToken();
                    $cObject->$action($param);
                }
                else {
                    $message['message']="Wrong Token";
                    $errorPage->showErrorPageAction($message);
                }
            }
            else
                header('Location: '.Routing::getSlug("Users","login").'');
        }
        else{
            header('Location: '.Routing::getSlug("Users","login").'');
        }
    }
    else{
        $cObject->$action($param);
    }

}else{
    $message['message']="Method doesn't exist";
    $errorPage->showErrorPageAction($message);
}



