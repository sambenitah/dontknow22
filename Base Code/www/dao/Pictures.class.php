<?php

declare(strict_types=1);

namespace DontKnow\Dao;

use DontKnow\Core\Routing;
use DontKnow\Models\Pictures as PictureModel;

class Pictures extends BaseDAO {

    public function deletePicture(array $delete){
        $query = $this->queryConstructor->delete('Pictures')->where($delete);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }

    public function selectAllPictureObject(){
        $query = $this->queryConstructor->select()->from('Pictures');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, PictureModel::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function selectAllPictureArray(){
        $query = $this->queryConstructor->select()->from('Pictures');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function insertPicture(array $param,PictureModel $pictures){
        $arguments = get_object_vars($pictures);
        $extension_upload = strtolower(substr(strrchr($param['name']['name'],'.'),1));
        $arguments["name_id"] = $arguments["name_id"].".".$extension_upload;
        $query =  $this->queryConstructor->table("Pictures")->insert($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
        move_uploaded_file($param["name"]['tmp_name'], $param["pathFile"].$pictures->name_id.".".$extension_upload);
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