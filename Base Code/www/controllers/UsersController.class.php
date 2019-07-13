<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\Email;
use DontKnow\Core\View;
use DontKnow\Dao\Users;
use DontKnow\Models\Users as UserModel;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;


class UsersController{

    const nameClass = "Users";

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
                $currentUser = $this->userDao->selectSingleUser(["email" => $data["email"]]);
                if(!$currentUser) {
                    $user->setFirstname($data["firstname"]);
                    $user->setLastname($data["lastname"]);
                    $user->setEmail($data["email"]);
                    $user->setPwd($data["pwd"]);
                    $this->userDao->addUser($user);
                    $email = resolve(Email::class);
                    $email->sendRegisterMail($data["email"]);
                    header('Location: ' . Routing::getSlug("Articles", "default") . '');
                    exit;
                }
                else{
                    $form["errors"][] = "Email already exist";
                }
            }
        }
        $v = new View("addUser",self::nameClass, "basic");
        $v->assign("form", $form);

    }


    public function loginAction($object = null,$action = null){

        if($object == null && $action == null){
            $object = resolve(StatisticsController::class);
            $action = 'defaultAction';
        }

        $user = $this->userDao;
        $form = $user->getLoginForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"] )){
                if($user->loginVerify($user,$data)) {

                    $reflection = new \ReflectionClass($object);
                    $reflection = $reflection->getShortName();
                    $reflection = explode("Controller",$reflection);
                    $action = explode("Action",$action);
                    echo Routing::getSlug($reflection[0],$action[0]);
                    header('Location: '.Routing::getSlug($reflection[0],$action[0]));
                    die();

                }else{
                    $form["errors"][] = "Login or Password not valid or activate your account by click on the email";
                }
            }

        }
        $v = new View("loginUser",self::nameClass, "basic");
        $v->assign("form", $form);

    }

    public function logoutAction(){
        session_unset();
        $this->loginAction();
    }


    public function forgetPasswordAction(){
        $user = $this->userDao;
        $form = $user->getForgotPasswordForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $mail = resolve(Email::class);
            $userDao = $this->userDao;
            $token = $userDao->generateTokenPassword();
            $user = $userDao->selectSingleUser(["email" => $data["email"]]);
            $user->setIDBIS($user->id);
            $user->setTokenPassword($token);
            $userDao->updateUser($user);
            $mail->sendForgotPasswordMail($data["email"], $token);
        }

        $v = new View("forgotPassword",self::nameClass, "basic");
        $v->assign("form", $form);
    }


    public function setPasswordAction(){
        $user = $this->userDao;
        $user->loggedRedirection();
        $form = $user->getNewPasswordForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])) {

                $userModel = $user->selectSingleUser(["email" => $_SESSION["emailPass"]]);
                $userModel->setIDBIS($userModel->id);
                $userModel->setPwd($data['pwd']);
                $user->updateUser($userModel);
            }
        }

        else{

            $email = $_GET['email'];
            $_SESSION["emailPass"] = $email;
            $currentToken = $_GET['hash'];
            $currentUser = $user->selectSingleUser(["email" => $email]);
            if(!password_verify($currentToken, $currentUser->tokenPassword))
                die('ERROR');

        }

        $v = new View("setPassword",self::nameClass, "basic");
        $v->assign("form", $form);

    }



}