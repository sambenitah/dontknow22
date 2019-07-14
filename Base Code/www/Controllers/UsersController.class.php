<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\Email;
use DontKnow\Core\View;
use DontKnow\Dao\Statistics;
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

    public function installerAction(){
        $form = $this->getInstallerForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            try {
                $pdo = new \PDO($data['Driver'].':host='.$data['host'].';dbname='.$data['DatabaseName'],$data['Login'], $data['password']);
               $query = $pdo->query("show tables");
               $result = $query->fetch();
               if(!$result){
                   $req=file_get_contents(__DIR__.'/../dontknow.sql');
                   $req=str_replace("\n","",$req);
                   $req=str_replace("\r","",$req);
                   //$pdo->exec($req);
                   $file =  file_get_contents('config.php');
                   var_dump($file);
                   die;
                   $configFile = fopen("Config/global.php",'w+');
                   $configContent = "
                   
<?php

    return [
    'db' => [
        'driver' => '".$data['Driver']."',
        'host' => '".$data['host']."',
        'name' => '".$data['DatabaseName']."',
        'user' => '".$data['Login']."',
        'pwd' => '".$data['password']."',
    ],
    'env' =>[
        'environment'=>'production'
    ],
    'mail' =>[
        'host'=>'ssl0.ovh.net',
        'username'=>'spacecowboy@dontknow.fr',
        'password'=>'samSLBSAM2282SAM',
        'port'=>'587',
    ],
    'website' =>[
        'name' => 'DontKnow'
    ]
];";
                   fwrite($configFile,$configContent);
                   die;
                   //header('Location: ' . Routing::getSlug("Users", "register") . '');
               }
               else{
                   $form["errors"][] = "Your database contains table please empty it and try again ";
               }
            } catch (\PDOException $e) {
                $form["errors"][] = "Information Incorrect Please Try Again. If you use a VPS please be sure that your ip is allowed";
            }
        }

        $v = new View("installer",self::nameClass, "login");
        $v->assign("form", $form);
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
                $count= resolve(Statistics::class)->querySelectCountUser();
                if(!$currentUser) {
                    $user->setFirstname($data["firstname"]);
                    $user->setLastname($data["lastname"]);
                    $user->setEmail($data["email"]);
                    $user->setPwd($data["pwd"]);

                    if($count['User'] == 0){
                        $user->setStatus(1);
                        $user->setRole(3);
                        $this->userDao->addUser($user);
                        die('created');
                        //Header('Location: ' . Routing::getSlug("Articles", "default") . '');
                        //exit();
                    }

                    $this->userDao->addUser($user);
                    $email = resolve(Email::class);
                    //$email->sendRegisterMail($data["email"]);
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


    public function activateAccountAction(){
        $user = $this->userDao;
        $userModel = $user->selectSingleUser(["email" => $_GET['email']]);
        $userModel->setIDBIS($userModel->id);
        $userModel->setStatus(1);
        $user->updateUser($userModel);
        echo 'account validated';
    }

    public function getInstallerForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Routing::getSlug("Users", "installer"),
                "class"=>"",
                "id"=>"form",
                "submit"=>"Connexion",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false
            ],

            "data"=>[

                "Driver"=>[
                    "type"=>"text",
                    "placeholder"=>"Driver",
                    "required"=>true,
                    "class"=>"inputAddLogUser",
                    "id"=>"i1--AddLogUser",
                    "error"=>"Driver incorrect"
                ],

                "DatabaseName"=>[
                    "type"=>"text",
                    "placeholder"=>"My Database",
                    "required"=>true,
                    "class"=>"inputAddLogUser",
                    "id"=>"i1--AddLogUser",
                    "error"=>"Nom incorrect"
                ],

                "Login"=>["type"=>"text","placeholder"=>"Login", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i2--AddLogUser",
                    "error"=>"Login Incorrect"],

                "password"=>["type"=>"password","placeholder"=>"Password", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i3--AddLogUser",
                    "error"=>"Password Incorrect"],

                "host"=>["type"=>"text","placeholder"=>"Host", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i4--AddLogUser",
                    "error"=>"Host Incorrect"],
            ]

        ];
    }



}