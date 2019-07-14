<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Core\Routing;


class InstallerController{

    const nameClass = "Installer";


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
                   $pdo->exec($req);
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
                   header('Location: ' . Routing::getSlug("Users", "register") . '');
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



}