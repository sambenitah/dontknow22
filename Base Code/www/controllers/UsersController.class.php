<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Dao\Users;
use DontKnow\Models\Users as UserModel;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;


class UsersController{

    const nameClass = "Users";

    private $userDao;

    public function __construct(Users $users)
    {
        $this->userDao = $users;
    }

    public function defaultAction(){
        $v = new View("homepage",self::nameClass, "commercial");

    }

    public function registerAction(){

        $user = new UserModel();
        $form = $this->userDao->getRegisterForm();
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
                $this->userDao->addUser();
                header('Location: '.Routing::getSlug("Articles","default").'');
                exit;
            }
        }
        $v = new View("addUser",self::nameClass, "basic");
        $v->assign("form", $form);

    }


    public function loginAction(){
        $user = $this->userDao;
        $form = $user->getLoginForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"] )){
                if($user->loginVerify($user,$data)) {
                    header('Location: '.Routing::getSlug("Statistics","default").'');
                }else{
                        echo"error";
                }
            }

        }
        $v = new View("loginUser",self::nameClass, "login");
        $v->assign("form", $form);

    }

    public function logoutAction(){
        session_unset();
    }

    public function loginFrontAction(){

        $user = $this->userDao;
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



}