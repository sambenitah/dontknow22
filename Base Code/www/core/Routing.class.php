<?php

declare(strict_types=1);
namespace DontKnow\Core;
class Routing{
    public static $routeFile = "routes.yml";
    public static function getRoute($slug){
        $slug = explode("/", $slug);
        if(!isset($slug[3])){
            $slugPartOne = "/".$slug[1];
            $routes = yaml_parse_file(self::$routeFile);
            if(isset($routes[$slugPartOne])){
                if(empty($routes[$slugPartOne]["controller"]) || empty($routes[$slugPartOne]["action"])){
                    header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
                }
                $controller = ucfirst($routes[$slugPartOne]["controller"])."Controller";
                $action = $routes[$slugPartOne]["action"]."Action";
                $controllerPath = "controllers/".$controller.".class.php";
                $connexion =  $routes[$slugPartOne]["connexion"];
                $role =  $routes[$slugPartOne]["role"];
                $param = null;
            }else if(isset($slug[1]) && isset($slug[2])){
                $controller = ucfirst($slug[1])."Controller";
                $action = $slug[2]."Action";
                $controllerPath = "controllers/".$controller.".class.php";
                $connexion = null;
                $role = null;
                $param = null;
            }else{
                return ["c"=>null, "a"=>null,"cPath"=>null ];
            }
        }else{
            $controller = ucfirst($slug[1])."Controller";
            $action = $slug[2]."Action";
            $controllerPath = "controllers/".$controller.".class.php";
            $param = $slug[3];
            $connexion = null;
            $role = null;
        }
        return ["controller"=>$controller, "action"=>$action,"controllerPath"=>$controllerPath, "param"=>$param,"connexion"=>$connexion,"role"=>$role ];
    }
    public static function getSlug($c, $a){
        $routes = yaml_parse_file(self::$routeFile);
        foreach ($routes as $slug => $cAndA) {
            if( !empty($cAndA["controller"]) &&
                !empty($cAndA["action"]) &&
                $cAndA["controller"] == $c &&
                $cAndA["action"] == $a){
                return $slug;
            }
        }
        return null;
    }
}









