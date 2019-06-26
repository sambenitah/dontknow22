<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Dao\Pictures;
use DontKnow\Models\Pictures as PictureModel;
use DontKnow\Core\ValidatorFiles;
use DontKnow\Core\Routing;

Class PicturesController{

    const nameClass = "Pictures";

    private $picturesDao;

    public function __construct(Pictures $pictures)
    {
        $this->picturesDao = $pictures;
    }

    public function addPictureAction(){
        $form = $this->picturesDao->getAddPictureForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        $file = $GLOBALS["_FILES"];
        $pathFile = ["pathFile" => "Public/imagesUpload/"];
        $array = array_merge($data, $file , $pathFile);


        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) && !empty($file) ){

            $validator = new ValidatorFiles($form,$data,$file);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){

                $file = new PictureModel;
                $file->setNameId($array["title"]);
                $file->setName($array["title"]);
                $this->picturesDao->insertPicture($array,$file);
                header('Location: '.Routing::getSlug("Pictures","showPictures").'');
                exit;
            }
        }
        $v = new View("addPicture",self::nameClass, "admin");
        $v->assign("addPicture", $form);
    }


    public function showPicturesAction(){
        $pictures = $this->picturesDao->selectAllPictureObject();
        $v = new View("showPictures",self::nameClass, "admin");
        $v->assign("ListPicture", $pictures);
        exit;
    }

    public function showPictureInSelecteAction(){
        $pictures = $this->picturesDao->selectAllPictureArray();
        echo json_encode($pictures);
        exit;
    }

    public  function deletePictureAction(){

        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $this->picturesDao->deletePicture(["id"=>$id]);
        unlink(substr($data["url"],1));
        echo json_encode("Delete");
        exit;
    }


}