<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;



class Comments {


    public function setIDBIS($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }

    public function addComment(){
        $addArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $addArticle->table("Comments")->insert($arguments);
        $query = $addArticle->instance->prepare((string)$query);
        $query->execute($arguments);
    }

    public function deleteComment(array $param){
        $deletePicture = new QueryConstructor();
        $query = $deletePicture->delete('Comments')->where($param);
        $query = $deletePicture->instance->prepare((string)$query);
        $query->execute($param);
        return $query->fetch();
    }


    public function getAddCommentForm($idArticle, $idUser){


        return [
            "config"=>[
                "method"=>"POST",
                "action"=> "",
                "class"=>"",
                "id"=>"form",
                "submit"=>"Post Comment",
                "idSubmit" => "submitAddComment",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false

            ],


            "data"=>[

                "articleId"=>["type"=>"text","placeholder"=>"", "required"=>true, "id"=>"inputHiddenContent", "value"=>"$idArticle"],

                "userId"=>["type"=>"text","placeholder"=>"", "required"=>true, "id"=>"inputHiddenContent", "value"=>"$idUser"],

                "content"=>["value"=>"Your comment", "required"=>true, "id"=>"textaeraAddComment", "class"=>"","minlength"=>2,"maxlength"=>300,
                    "error"=>"Your comment must be between two or three hundred characters","type"=>""]
            ]

        ];
    }





}