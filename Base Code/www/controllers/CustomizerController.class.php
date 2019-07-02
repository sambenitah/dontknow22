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
        $selectMeta = $this->customizerDao->selectAllMeta(["id"=>1]);
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
                $updateMeta->setcontactMenu($data["contactMenu"]);
                $this->customizerDao->updateMeta($updateMeta);
                header('Location: '.Routing::getSlug("Customizer","customMeta").'');
                exit;
            }
        }
        $v = new View("customMeta",self::nameClass, "admin");
        $v->assign("Form", $form);
    }


    public function customColorAction(){
        $updateCustomColor = new CustomizerModel();
        $selectCustomColor = $this->customizerDao->selectDataCustomizer();
        $selectErrorPageForm = $this->customizerDao->getUpdateTemplate($selectCustomColor["colorFront"],$selectCustomColor["postContentColor"],$selectCustomColor["aColor"]);
        $method = strtoupper($selectErrorPageForm["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {

            $validator = new Validator($selectErrorPageForm, $data);
            $form["errors"] = $validator->errors;

            if (empty($form["errors"])) {
                $updateCustomColor->setId(1);
                $updateCustomColor->setPostContentColor($data["postContentColor"]);
                $updateCustomColor->setAColor($data["aColor"]);
                $updateCustomColor->setColorFront($data["colorFront"]);
                $this->customizerDao->updateCustomColor($updateCustomColor);
                header('Location: '.Routing::getSlug("Customizer","customColor").'');
                exit;
            }
        }

        $v = new View("customizerColor", self::nameClass,"admin" );
        $v->assign("CustomColor", $selectErrorPageForm);
        exit;
    }

}