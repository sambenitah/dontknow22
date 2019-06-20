<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;


class Categories{

    public function setName($name)
    {
        $this->name = $name ;
    }

    public function insertCategory(){
        $insertCategorie = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $insertCategorie->table('Categories')->insert($arguments);
        $query = $insertCategorie->instance->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectCategory(){
        $selectCategorie = new QueryConstructor();
        $query = $selectCategorie->select()->from('Categories');
        $query = $selectCategorie->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteCategory(array $delete){
        $deleteCategorie = new QueryConstructor();
        $query = $deleteCategorie->delete('Categories')->where($delete);
        $query = $deleteCategorie->instance->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }


    public function getAddCategoryForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "",
                "id" => "form",
                "submit" => "Insert",
                "classSubmit" => "bouttonConfirmForm",
                "idSubmit" => "idBouttonConfirmForm",
                "cancelButton" => false,
                "enctype"=>true

            ],


            "data" => [
                "name" => [
                    "type" => "text",
                    "placeholder" => "Title of your category",
                    "required" => true,
                    "class" => "inputAddPage",
                    "id" => "i1--AddPage",
                    "minlength" => 2,
                    "maxlength" => 30,
                    "error" => "Your new category must be between two or thirtheen characters",
                ],
            ],
        ];
    }
}