<?php

declare(strict_types=1);

namespace DontKnow\Models;

use DontKnow\Core\Routing;
use DontKnow\Core\QueryConstructor;

class Pictures{


    public function setNameId($name)
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $name= urlencode($name . $date);
        $this->name_id = str_replace('%','-', $name);
    }

    public function setName($title)
    {
        $this->name = $title ;
    }

    public function deletePicture(array $delete){
        $deletePicture = new QueryConstructor();
        $query = $deletePicture->delete('Pictures')->where($delete);
        $query = $deletePicture->instance->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }

    public function selectAllPictureObject(){
        $selectPicture = new QueryConstructor();
        $query = $selectPicture->select()->from('Pictures');
        $query = $selectPicture->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute();
        return $query->fetchAll();
    }

    public function selectAllPictureArray(){
        $selectPicture = new QueryConstructor();
        $query = $selectPicture->select()->from('Pictures');
        $query = $selectPicture->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function insertPicture(array $param){
        $insertPicture = new QueryConstructor();
        $arguments = get_object_vars($this);
        $extension_upload = strtolower(substr(strrchr($param['name']['name'],'.'),1));
        $arguments["name_id"] = $arguments["name_id"].".".$extension_upload;
        $query = $insertPicture->table("Pictures")->insert($arguments);
        $query = $insertPicture->instance->prepare((string)$query);
        $query->execute($arguments);
        move_uploaded_file($param["name"]['tmp_name'], $param["pathFile"].$this->name_id.".".$extension_upload);
    }





    public function getAddPictureForm()
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => Routing::getSlug("Articles", "detailArticles"),
                "class" => "",
                "id" => "form",
                "submit" => "Insert",
                "classSubmit" => "bouttonConfirmForm",
                "idSubmit" => "idBouttonConfirmForm",
                "cancelButton" => false,
                "enctype"=>true

            ],


            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Title of your picture",
                    "required" => true,
                    "class" => "inputAddPage",
                    "id" => "i1--AddPage",
                    "minlength" => 2,
                    "maxlength" => 20,
                    "error" => "Your title must be between two or fifteen characters",
                ],
            ],

             "dataFile" => [
                 "name" => ["required" => false, "id" => "file", "class" => "input-file", "type" => "file", "value"=>"Choisir une image","classLabel"=>"label-file"
                     ,"accept" => "image/png,image/jpeg", "titleFile"=>"Download your picture", "errorExtension"=>"You must upload an image with png or jpeg or jpg format",
                     "error" => "Fail to upload your picture", "errorSize" => "Your picture exceeds 1 200 000 octets"
                 ],
             ]
        ];
    }

}