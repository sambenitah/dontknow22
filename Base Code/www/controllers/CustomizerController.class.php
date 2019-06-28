<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\Container;
use DontKnow\Dao\Customizer;
use DontKnow\Core\View;
use DontKnow\Models\Customizer as CustomizerModel;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;


Class CustomizerController{

    const nameClass = "Customizer";

    private $customizerDao;

    public function __construct(Customizer $customizer)
    {
        $this->customizerDao = $customizer;
    }

    public function defaultAction(){
        $v = new View("customizer",self::nameClass, "admin");
    }

    public function customMetaAction(){
        $updateMeta = new CustomizerModel();
        $selectMeta = $this->customizerDao->selectMeta($updateMeta,["id"=>1]);
        $form = $this->customizerDao->getCustomMetaForm($selectMeta["content"],$selectMeta["title"]);
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {

            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $updateMeta->setId(1);
                $updateMeta->setContent($data["description"]);
                $updateMeta->setTitle($data["title"]);
                $this->customizerDao->updateMeta($updateMeta);
               // header('Location: '.Routing::getSlug("Customizer","customMeta").'');
                exit;
            }
        }
        $v = new View("customMeta",self::nameClass, "admin");
        $v->assign("Form", $form);
    }

}