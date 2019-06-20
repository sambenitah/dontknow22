<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Models\Categories;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;

Class CategoriesController{

    const nameClass = "Categories";

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function addCategoryAction(){ //ok
        $addCategory = new Categories();
        $form = $addCategory->getAddCategoryForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];


        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ){

            $validator = new Validator($form,$data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $addCategory->setName($data["name"]);
                $addCategory->insertCategory();
                header('Location: '.Routing::getSlug("Customizer","default").'');
                exit;
            }
        }
        $v = new View("addCategory",self::nameClass, "admin");
        $v->assign("ListForm", $form);
    }

    public function showCategoryAction(){
        $showCategory = new Categories();
        $selectCategory = $showCategory->selectCategory();
        echo json_encode($selectCategory);
        exit;
    }

    public function deleteCategoryAction(){
        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $deletePicture = new Categories();
        $deletePicture->deleteCategory(["id"=>$id]);
        echo json_encode("Delete");
        exit;
    }


}