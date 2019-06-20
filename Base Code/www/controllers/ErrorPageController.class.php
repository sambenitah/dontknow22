<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Models\ErrorPage;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;

Class ErrorPageController{

    const nameClass = "Errors";

    public function updateErrorPageAction(){
        $updateErrorPage = new ErrorPage();

        $selectDataForm = $updateErrorPage->selectDataErrorPage();
        $selectErrorPageForm = $updateErrorPage->getUpdateErrorPageForm($selectDataForm["content"],$selectDataForm["background_color"],$selectDataForm["text_color"]);
        $method = strtoupper($selectErrorPageForm["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {

            $validator = new Validator($selectErrorPageForm, $data);
            $form["errors"] = $validator->errors;

            if (empty($form["errors"])) {
                $updateErrorPage->setIdBis(1);
                $updateErrorPage->setContent($data["content"]);
                $updateErrorPage->setBackgroundColor($data["background_color"]);
                $updateErrorPage->setTextColor($data["text_color"]);
                $updateErrorPage->updateErrorPage();
                header('Location: '.Routing::getSlug("ErrorPage","updateErrorPage").'');
                exit;
            }
        }

        $v = new View("updatePageError", "admin", self::nameClass);
        $v->assign("ErrorPage", $selectErrorPageForm);
        exit;
    }

    public function showErrorPageAction(){
        $showErrorPage = new ErrorPage();
        $errorPage = $showErrorPage ->showErrorPage(["id"=>1]);
        $v = new View("errorPage", self::nameClass,  "errorPage");
        $v->assign("ErrorPage", $errorPage);
        exit;
    }
}