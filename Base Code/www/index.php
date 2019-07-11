<?php
session_start();
use DontKnow\Core\Routing;
use DontKnow\Dao\Users;
use DontKnow\Controllers\UsersController;
use DontKnow\Core\Container;
use DontKnow\Controllers\ErrorPageController;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function resolve($name){
    return Container::getObject()->getInstance($name);
}

require ('core/Exception.php');
require ('core/PHPMailer.php');
require ('core/SMTP.php');


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

    var_dump($file);

    throw new Exception("Fichier invalide");

});


$slug = $_SERVER["REQUEST_URI"];
$slugExploded = explode("?", $slug);
$slug = $slugExploded[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = new \DontKnow\Core\Container();

$errorPage = resolve(ErrorPageController::class);

if(!isset($controller)){
    $message['message']="Controller doesn't exist";
    $errorPage->showErrorPageAction($message);
}


$cObject = resolve('DontKnow\\Controllers\\' . $controller);
if( method_exists($cObject, $action) ){
    if($connexion){
        $user = resolve(UsersController::class);
        if($user->userDao->logged()) {
            $userRole = $user->userDao->getRole($_SESSION['auth']);
            if($_SESSION["role"] >= $role) {
                $token = $user->userDao->getToken();
                if ($token == ($_SESSION['token'])) {
                    $user->userDao->updateToken();
                    $cObject->$action($param);
                }
                else {
                    $message['message']="Wrong Token";
                    $errorPage->showErrorPageAction($message);
                }
            }
            else {
                $message['message'] = "Accès refusé";
                $errorPage->showErrorPageAction($message);
            }
        }
        else{
            $user->loginAction($cObject,$action);
        }
    }
    else{
        $cObject->$action($param);
    }

}else{
    $message['message']="Method doesn't exist";
    $errorPage->showErrorPageAction($message);
}



