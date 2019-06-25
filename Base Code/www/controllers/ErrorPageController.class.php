<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Models\ErrorPage as ErrorPageModel;
use DontKnow\Dao\ErrorPage;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;

Class ErrorPageController{

    const nameClass = "Errors";

    private $errorPageDao;

    public function __construct(ErrorPage $errorPage)
    {
        $this->errorPageDao = $errorPage;
    }

    public function updateErrorPageAction(){
        $updateErrorPage = new ErrorPageModel();
        $selectDataForm = $this->errorPageDao->selectDataErrorPage();
        $selectErrorPageForm = $this->errorPageDao->getUpdateErrorPageForm($selectDataForm["content"],$selectDataForm["background_color"],$selectDataForm["text_color"]);
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
                $this->errorPageDao->updateErrorPage($updateErrorPage);
                header('Location: '.Routing::getSlug("ErrorPage","updateErrorPage").'');
                exit;
            }
        }

        $v = new View("updatePageError", self::nameClass,"admin" );
        $v->assign("ErrorPage", $selectErrorPageForm);
        exit;
    }

    public function showErrorPageAction(){
        $errorPage = $this->errorPageDao->showErrorPage(["id"=>1]);
        $v = new View("errorPage", self::nameClass,  "login");
        $v->assign("ErrorPage", $errorPage);
        exit;
    }
}