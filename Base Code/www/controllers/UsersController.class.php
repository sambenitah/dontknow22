<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\SPDO;
use DontKnow\Core\View;
use DontKnow\Models\Users;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;
use DontKnow\VO\DbDriver;
use DontKnow\VO\DbHost;
use DontKnow\VO\DbName;
use DontKnow\VO\DbPwd;
use DontKnow\VO\DbUser;


class UsersController{

    const nameClass = "Users";

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function defaultAction(){
        $v = new View("homepage",self::nameClass, "commercial");

    }

    public function registerAction(){

        $user = new Users();
        $form = $user->getRegisterForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $user->setFirstname($data["firstname"]);
                $user->setLastname($data["lastname"]);
                $user->setEmail($data["email"]);
                $user->setPwd($data["pwd"]);
                $user->addUser();
                header('Location: '.Routing::getSlug("Articles","default").'');
                exit;
            }
        }
        $v = new View("addUser",self::nameClass, "basic");
        $v->assign("form", $form);

    }

    public function installerAction(){

        //$file = file_get_contents("var/www/html/Config/global.php)");

        $file = "t";

        if($file == null) {

            $user = new Users();
            $form = $user->getInstallerForm();
            //Est ce qu'il y a des données dans POST ou GET($form["config"]["method"])
            $method = strtoupper($form["config"]["method"]);
            $data = $GLOBALS["_" . $method];

            if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {

                $validator = new Validator($form, $data);
                $form["errors"] = $validator->errors;
                initializeApplication($data);
            }
            $v = new View("installer", self::nameClass, "login");
            $v->assign("form", $form);
        }
        else{
            $this->defaultAction();
        }
    }


    public function loginAction(){
        $user = $this->users;
        $form = $user->getLoginForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"] )){
                if($user->loginVerify($user,$data)) {
                    header('Location: '.Routing::getSlug("Articles","yourWebSite").'');
                }else{
                        echo"error";
                }
            }

        }
        $v = new View("loginUser",self::nameClass, "login");
        $v->assign("form", $form);

    }

    public function loginFrontAction(){

        $user = new Users();
        $form = $user->getLoginForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"] )){
                if($user->loginVerify($user,$data))
                    header('Location: '.Routing::getSlug("Articles","default").'');
                else
                    echo "toto";
            }

        }

        $v = new View("loginUser",self::nameClass, "basic");
        $v->assign("form", $form);

    }

    public  function initializeApplication(array $data){

        //$file = file_get_contents("var/www/html/dontknow.sql)");

        new DbDriver($data["Driver"]);
        new DbHost($data["Host"]);
        new DbName($data["Name"]);
        new DbUser($data["User"]);
        new DbPwd($data["Pwd"]);

        $PDO = new SPDO();

        $PDO::getPDO();

        if(!$PDO instanceof \PDO){
            $this->installerAction();
        }

        //$PDO->exec($file);

    }


}