<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Models\Articles;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;
use DontKnow\Models\Comments;

class ArticlesController{

    const nameClass = "Articles";

    public function __construct(Articles $articles)
    {
        $this->articles = $articles;
    }

    public function defaultAction(){ //ok

        $showArticle = new Articles();
        $selectArticle = $showArticle->selectAllArticle();
        $v = new View("listFrontPages",self::nameClass, "basic");
        $v->assign("ListPage", $selectArticle);

    }

    public function addArticleAction(){ //ok
        $addArticle = new Articles();
        $form = $addArticle->getAddArticleForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];


        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $addArticle->setDescription($data["description"]);
                $addArticle->setTitle($data["title"]);
                $addArticle->setRoute($data["route"]);
                $addArticle->addArticle();
               header('Location: '.Routing::getSlug("Articles","showArticles").'');
               exit;
            }
        }
            $v = new View("addArticle", self::nameClass, "admin");
            $v->assign("Form", $form);
    }

    public function showArticlesAction(){ //ok
        $showArticle = new Articles();
        $selectArticle = $showArticle->selectAllArticle();
        $v = new View("showArticle", self::nameClass, "admin");
        $v->assign("ListPage", $selectArticle);
        exit;
    }


    public function detailArticlesAction($param){ //ok
        $detailArticle = new Articles();
        $formArticle = $detailArticle->getDetailArticleForm();
        $detail = $detailArticle->selectSingleArticle(["route"=>$param]);
        if (empty($detail)) {
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }else {
           $v = new View("detailArticle", self::nameClass, "admin");
           $v->assign("DetailArticle", $detail);
           $v->assign("formArticle", $formArticle);
           exit;
        }
    }

    public function updateArticleAction(){ //pasok

        $updateArticle = new Articles();
        $formArticle = $updateArticle->getDetailArticleForm();
        $method = strtoupper($formArticle["config"]["method"]);
        $data = $GLOBALS["_".$method];
        $id = array_shift($data);
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($formArticle,$data);
            $form["errors"] = $validator->errors;
            if (!empty($form["errors"]))
                echo json_encode($form["errors"]);


            if(empty($form["errors"])){
                $updateArticle->setIDBIS($id);
                $updateArticle->setContent($data["content"]);
                $updateArticle->setMainPicture($data["main_picture"]);
                $updateArticle->setCategory($data["category"]);
                $updateArticle->updateArticle();
                echo json_encode("Update");
                exit;
            }
        }
    }

    public function deleteArticleAction(){ //ok
        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $deletePicture = new Articles();
        $deletePicture->deleteArticle(['id'=>$id]);
        echo json_encode("Delete");
        exit;
    }


    public function singleArticleAction($param){ // ok
        $showDetailArticle = new Articles();
        $comment = new Comments();
        $selectDetailArticle = $showDetailArticle->selectSingleArticle(["route"=>$param]);
        $idArticle =  $selectDetailArticle[0]->id;
        $idUser = $_SESSION["auth"];
        $formComment = $comment->getAddCommentForm($idArticle, $idUser);
        $method = strtoupper($formComment["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($formComment,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $comment->setArticleId($data["articleId"]);
                $comment->setUserId($data["userId"]);
                $comment->setContent($data["content"]);
                $comment->addComment();
            }
        }

        if (empty($selectDetailArticle)) {
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }else{

            $messages = $showDetailArticle->selectCommentArticle(["idArticle"=>$idArticle]);
            $v = new View("singleArticle", self::nameClass , "basic");
            $v->assign("ListPage", $selectDetailArticle);
            $v->assign("CommentForm", $formComment);
            $v->assign("Messages", $messages);
            exit;

        }
    }

    public function yourWebsiteAction(){ //ok
        $showArticle = new Articles();
        $selectArticle = $showArticle ->selectAllArticle();
        $v = new View("listFrontPages", self::nameClass, "front");
        $v->assign("ListPage", $selectArticle);
        exit;
    }

}