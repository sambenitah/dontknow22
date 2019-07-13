<?php

declare(strict_types=1);

namespace DontKnow\Dao;
use DontKnow\Models\Categories as CategoriesModel;


class Categories extends BaseDAO {

    public function insertCategory(CategoriesModel $categories){
        $arguments = get_object_vars($categories);
        $query = $this->queryConstructor->table('Categories')->insert($arguments);
        $query =  $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectCategory(){
        $query = $this->queryConstructor->select()->from('Categories');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, CategoriesModel::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function deleteCategory(array $delete){
        $query = $this->queryConstructor->delete('Categories')->where($delete);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }

    public function SelectCountArticles(array $where){
        $query = $this->queryConstructor->select()->count('id', "Article")->from('Articles')->where($where);
        $query = $this->queryConstructor->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute($where);
        return $query->fetch();
    }

    public function selectSingleCategory(array $where){
        $query = $this->queryConstructor->select()->from('Categories')->where($where);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, CategoriesModel::class);
        $query->execute($where);
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