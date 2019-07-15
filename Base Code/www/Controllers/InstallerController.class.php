<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Core\Routing;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class InstallerController{

    const nameClass = "Installer";


    public function installerDatabaseAction(){
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
                   $pdo->exec($req);
                   $_SESSION['database'] = $data;
                   header('Location: ' . Routing::getSlug("Installer", "installerEmail") . '');
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
        $v->assign("type","database");
    }


    public function downloadAction(){
        $v = new View("download",self::nameClass, "empty");
    }



    public function  installerEmailAction(){
        $form = $this->getInstallerEmailForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            try{
                $email  = new  PHPMailer(true);
                $email->Host = $data['Host'];
                $email->Username = $data['Login'];
                $email->Password = $data['password'];
                $email->Port = $data['Port'];
                $email->SMTPAuth = TRUE;
                $email->SMTPSecure ='tls';
                $email->isSMTP();
                $email->setFrom($data['Login']);
                $email->addAddress($data['Login']);
                $email->Subject= 'New Installation';
                $email->Body= 'New Installation today';
                $email->send();
                $_SESSION['email'] = $data;
                $this->generateConfigFile();
                header('Location: ' . Routing::getSlug("Users", "register") . '');
            }
            catch (Exception $exception){
                $form["errors"][] = "Information Incorrect Please Try Again.";
            }


        }

        $v = new View("installer",self::nameClass, "login");
        $v->assign("form", $form);
        $v->assign("type","email");
    }


    public function generateConfigFile(){
        $configFile = fopen("Config/global.php",'w+');
        $configContent = "
                   
<?php

    return [
    'db' => [
        'driver' => '".$_SESSION["database"]["Driver"]."',
        'host' => '".$_SESSION["database"]["host"]."',
        'name' => '".$_SESSION["database"]["DatabaseName"]."',
        'user' => '".$_SESSION["database"]['Login']."',
        'pwd' => '".$_SESSION["database"]['password']."',
    ],
    'env' =>[
        'environment'=>'production'
    ],
    'mail' =>[
        'host'=>'".$_SESSION["email"]["Host"]."',
        'username'=>'".$_SESSION["email"]["Login"]."',
        'password'=>'".$_SESSION["email"]["password"]."',
        'port'=>'".$_SESSION["email"]["Port"]."',
    ],
    'website' =>[
        'name' => '".$_SESSION["email"]["Website_Name"]."'
    ]
];";
        fwrite($configFile,$configContent);
    }


    public function getInstallerForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Routing::getSlug("Users", "installer"),
                "class"=>"",
                "id"=>"form",
                "submit"=>"Connexion",
                "idSubmit" => "Connexion",
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


    public function getInstallerEmailForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>Routing::getSlug("Users", "installer"),
                "class"=>"",
                "id"=>"form",
                "submit"=>"Connexion",
                "idSubmit" => "Connexion",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false
            ],

            "data"=>[

                "Host"=>[
                    "type"=>"text",
                    "placeholder"=>"Host",
                    "required"=>true,
                    "class"=>"inputAddLogUser",
                    "id"=>"i1--AddLogUser",
                    "error"=>"Nom incorrect"
                ],

                "Login"=>["type"=>"text","placeholder"=>"Login", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i2--AddLogUser",
                    "error"=>"Login Incorrect"],

                "password"=>["type"=>"password","placeholder"=>"Password", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i3--AddLogUser",
                    "error"=>"Password Incorrect"],

                "Port"=>["type"=>"text","placeholder"=>"Port", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i4--AddLogUser",
                    "error"=>"Port Incorrect"],

                "Website Name"=>["type"=>"text","placeholder"=>"Website Name", "required"=>true, "class"=>"inputAddLogUser", "id"=>"i4--AddLogUser",
                    "error"=>"Website Name Incorrect"],
            ]

        ];
    }



}