<?php

declare(strict_types=1);

namespace DontKnow\Core;

class View{

    private $v;
    private $t;
    private $data = [];

    public function __construct($v,$class, $t="back" ){
        $this->setView($v, $class);
        $this->setTemplate($t);
    }

    public function setView($v,$class){

        $viewPath = "Views/".$class."/".$v.".view.php";

        if( file_exists($viewPath)){
            $this->v=$viewPath;
        }else{
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }
    }

    public function setTemplate($t){
        $templatePath = __DIR__."/../Views/templates/".$t.".tpl.php";
        if( file_exists($templatePath)){
            $this->t=$templatePath;
        }else{
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }

    }


    //$modal = form //"Views/Modals/form.mod.php"
    //$config = [ ..... ]
    public function addModal($modal, $config){
        //form.mod.php
        $modalPath = "Views/Modals/".$modal.".mod.php";
        if( file_exists($modalPath)){
            include $modalPath;
        }else{
            echo"fhgsqjodjhknsnc";
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }
    }

    //$this->data =["pseudo"=>"prof", "age"=>30, "city"=>"Paris"]
    public function assign($key, $value){
        $this->data[$key]=$value;
    }


    public function __destruct(){
        extract($this->data);
        include $this->t;
    }
}


