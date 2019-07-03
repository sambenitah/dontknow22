<?php

declare(strict_types=1);

namespace DontKnow\Dao;
use DontKnow\Models\Comments as CommentsModel;
use DontKnow\Dao\BaseDAO;

class Comments extends BaseDAO {

    public function addComment(CommentsModel $comments){
        $arguments = get_object_vars($comments);
        $query = $this->queryConstructor->table("Comments")->insert($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
    }

    public function deleteComment(array $param){
        $query = $this->queryConstructor->delete('Comments')->where($param);
        $query = $this->queryConstructor->prepare((string)$query);
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
                    "error"=>"Your comment must be between two or three hundred characters","type"=>"","valueTextearea"=>""]
            ]

        ];
    }





}