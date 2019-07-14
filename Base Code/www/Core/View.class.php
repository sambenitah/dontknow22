<?php

declare(strict_types=1);

namespace DontKnow\Core;

use DontKnow\Controllers\ErrorPageController;

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
            $errorPage = resolve(ErrorPageController::class);
            $message['message']="View doesn't exist";
            $errorPage->showErrorPageAction($message);
        }
    }

    public function setTemplate($t){
        $templatePath = __DIR__."/../Views/templates/".$t.".tpl.php";
        if( file_exists($templatePath)){
            $this->t=$templatePath;
        }else{
            $errorPage = resolve(ErrorPageController::class);
            $message['message']="Templates doesn't exist";
            $errorPage->showErrorPageAction($message);
        }

    }


    public function addModal($modal, $config){
        $modalPath = "Views/Modals/".$modal.".mod.php";
        if( file_exists($modalPath)){
            include $modalPath;
        }else{
            $errorPage = resolve(ErrorPageController::class);
            $message['message']="Modal doesn't exist";
            $errorPage->showErrorPageAction($message);
        }
    }

    public function assign($key, $value){
        $this->data[$key]=$value;
    }


    public function __destruct(){
        extract($this->data);
        include $this->t;
    }
}


