<?php
session_start();
require "conf.inc.php";
use DontKnow\Core\Routing;
use DontKnow\Models\Users;


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

$container = [];
$container['config'] = require 'config/global.php';
$container += require 'config/di.global.php';
$cObject = $container['DontKnow\\Controllers\\' . $controller]($container);


if( method_exists($cObject, $action) ){
    if($connexion){
        $user = new Users();
        if($user->logged()) {
            $userRole = $user->getRole($_SESSION['auth']);
            $_SESSION["role"] = $userRole;
            if($userRole >= $role) {
                $token = $user->getToken();
                if ($token == ($_SESSION['token'])) {
                    $user->updateToken();
                    $cObject->$action($param);
                }
                else
                    header('Location: ' . Routing::getSlug("ErrorPage", "showErrorPage") . '');
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
    header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
}


/*if( file_exists($controllerPath) ){
	include $controllerPath;
	if( class_exists($controller)){
		$cObject = new $controller();
		if( method_exists($cObject, $action) ){
		    if($connexion){
		        $user = new Users();
		        if($user->logged()) {
		            $userRole = $user->getRole($_SESSION['auth']);
                    $_SESSION["role"] = $userRole;
		            if($userRole >= $role) {
                        $token = $user->getToken();
                        if ($token == ($_SESSION['token'])) {
                            $user->updateToken();
                            $cObject->$action($param);
                        }
                        else
                            header('Location: ' . Routing::getSlug("ErrorPage", "showErrorPage") . '');
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
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
		}

	}else{
        header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
	}
}else{
    header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
}*/


