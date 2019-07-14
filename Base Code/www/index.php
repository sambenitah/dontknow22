<?php
session_start();
use DontKnow\Core\Routing;
use DontKnow\Controllers\UsersController;
use DontKnow\Core\Container;
use DontKnow\Controllers\ErrorPageController;


function resolve($name)
{
    return Container::getObject()->getInstance($name);
}

require('Core/PHPMailer.php');
require('Core/SMTP.php');
require('Core/Exception.php');


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

    throw new \Exception("Fichier invalide");

});

try{
    $container = new Container();
    $slug = $_SERVER["REQUEST_URI"];
    $slugExploded = explode("?", $slug);
    $slug = $slugExploded[0];
    $routes = Routing::getRoute($slug);
    extract($routes);


    if ($container->isInstall() && $slug != '/installer' && $slug != '/installerEmail') {
        header('Location: ' . Routing::getSlug("Installer", "installerDatabase") . '');
        exit;
    }

    if (!isset($controller) && $slug !='/installer' && $slug != '/installerEmail') {
        $errorPage = resolve(ErrorPageController::class);
        $errorPage->showErrorPageAction("Controller doesn't exist");
    }

    $cObject = resolve('DontKnow\\Controllers\\' . $controller);
    if (method_exists($cObject, $action)) {
        if ($connexion) {
            $user = resolve(UsersController::class);
            if ($user->userDao->logged()) {
                $userRole = $user->userDao->getRole($_SESSION['auth']);
                if ($_SESSION["role"] >= $role) {
                    $token = $user->userDao->getToken();
                    if ($token == ($_SESSION['token'])) {
                        $user->userDao->updateToken();
                        $cObject->$action($param);
                    } else {
                        $errorPage->showErrorPageAction("Wrong Token");
                    }
                } else {
                    $errorPage->showErrorPageAction("Accès refusé");
                }
            } else {
                $user->loginAction($cObject, $action);
            }
        } else {
            $cObject->$action($param);
        }

    } else {
        $errorPage->showErrorPageAction("Method doesn't exist");
    }
} catch (Exception $e){
    var_dump($e->getMessage());
    require '404.html';
}



