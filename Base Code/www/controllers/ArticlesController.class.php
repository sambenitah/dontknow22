<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\Container;
use DontKnow\Core\QueryConstructor;
use DontKnow\Core\View;
use DontKnow\Dao\Articles;
use DontKnow\Models\Articles as ArticleModel;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;
use DontKnow\Models\Comments as CommentsModel;
use DontKnow\Dao\Comments as CommentsDao;

class ArticlesController{

    const nameClass = "Articles";

    private $articleDao;

    public function __construct(Articles $articles)
    {
        $this->articleDao = $articles;
    }

    public function defaultAction(){

        $selectArticle = $this->articleDao->selectAllArticle();
        $v = new View("listFrontPages",self::nameClass, "basic");
        $v->assign("ListPage", $selectArticle);

    }

    public function addArticleAction(){ //ok
        $addArticle = new ArticleModel();
        $form = $this->articleDao->getAddArticleForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];


        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $addArticle->setDescription($data["description"]);
                $addArticle->setTitle($data["title"]);
                $addArticle->setRoute($data["route"]);
                $this->articleDao->addArticle();
               header('Location: '.Routing::getSlug("Articles","showArticles").'');
               exit;
            }
        }
            $v = new View("addArticle", self::nameClass, "admin");
            $v->assign("Form", $form);
    }

    public function showArticlesAction(){ //ok
        $selectArticle = $this->articleDao->selectAllArticleBIS();
        $v = new View("showArticle", self::nameClass, "admin");
        $v->assign("ListPage", $selectArticle);
        exit;
    }


    public function detailArticlesAction($param){ //ok
        $formArticle = $this->articleDao->getDetailArticleForm();
        $detail = $this->articleDao->selectSingleArticle(["route"=>$param]);
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

        $updateArticle = new ArticleModel();
        $formArticle = $this->articleDao->getDetailArticleForm();
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
                $updateArticle->setStatus($data["status"]);
                $this->articleDao->updateArticle($updateArticle);
                echo json_encode("Update");
                exit;
            }
        }
    }

    public function deleteArticleAction(){ //ok

        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $this->articleDao->deleteArticle(['id'=>$id]);

    }


    public function singleArticleAction($param){ // ok
        $container = new Container();
        $commentModel = new CommentsModel();
        $commentDao = new CommentsDao($container->getInstance(QueryConstructor::class));
        $selectDetailArticle = $this->articleDao->selectSingleArticle(["route"=>$param]);
        $idArticle =  $selectDetailArticle[0]->id;
        $idUser = $_SESSION["auth"];
        $formComment = $commentDao->getAddCommentForm($idArticle, $idUser);
        $method = strtoupper($formComment["config"]["method"]);
        $data = $GLOBALS["_".$method];

        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($formComment,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $commentModel->setArticleId($data["articleId"]);
                $commentModel->setUserId($data["userId"]);
                $commentModel->setContent($data["content"]);
                $commentDao->addComment($commentModel);
            }
        }

        if (empty($selectDetailArticle)) {
            header('Location: '.Routing::getSlug("ErrorPage","showErrorPage").'');
        }else{

            $messages = $this->articleDao->selectCommentArticle(["idArticle"=>$idArticle]);
            $v = new View("singleArticle", self::nameClass , "basic");
            $v->assign("ListPage", $selectDetailArticle);
            $v->assign("CommentForm", $formComment);
            $v->assign("Messages", $messages);
            exit;

        }
    }


}