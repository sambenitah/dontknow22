<?php

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;
use DontKnow\Core\Routing;


class ErrorPage{

    public function setIdBis($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = ucfirst(trim($content));
    }

    public function setBackgroundColor($backgroundColor)
    {
        $this->background_color = $backgroundColor;
    }

    public function setTextColor($textColor)
    {
        $this->text_color = $textColor;
    }


    public function selectDataErrorPage(){
        $selectDataErrorPage = new QueryConstructor();
        $query = $selectDataErrorPage->select()->from('ErrorPage')->where(["id"=>1]);
        $query = $selectDataErrorPage->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute(["id"=>1]);
        return $query->fetch();
    }

    public function updateErrorPage(){
        $updateArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $updateArticle->table('ErrorPage')->update($arguments);
        $query = $updateArticle->instance->prepare((string)$query);
        $query->execute($arguments);
    }


    public function showErrorPage(array $where){
        $selectSingleArticle = new QueryConstructor();
        $query = $selectSingleArticle->select()->from('ErrorPage')->where($where);
        $query = $selectSingleArticle->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute($where);
        return $query->fetchAll();
    }





    public function getUpdateErrorPageForm($content, $background_color, $text_color){
        return [
            "config"=>[
                "method"=>"POST",
                "action" => Routing::getSlug("ErrorPage", "updateErrorPage"),
                "class"=>"",
                "id"=>"form",
                "submit"=>"Update",
                "idSubmit" => "bouttonAddArticle",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false

            ],

            "data"=>[

                "content"=>["type"=>"text","placeholder"=>"Your error text", "required"=>false, "class"=>"inputAddPage", "id"=>"inputYourTexte","maxlength"=>100,"minlenght"=>5,
                    "error"=>"Your content must be between five or hundred characters", "value"=>"$content"],

                "background_color"=>["type"=>"color","label"=>"Choose your background color", "required"=>false, "class"=>"inputAddPage", "id"=>"button_change_background_color", "minlenght"=>7,"maxlength"=>7,
                    "error"=>"An error has occured", "value"=>"$background_color"],

                "text_color"=>["type"=>"color", "class"=>"inputAddPage","label"=>"Choose your text color", "id"=>"button_change_text_color", "required"=>false, "minlenght"=>7,"maxlength"=>7,
                    "error"=>"An error has occured", "value"=>"$text_color"],
            ]
        ];
    }
}