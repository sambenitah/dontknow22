<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;

class Articles{

    //Public $title;
    //Public $description;
    //Public $route;
   // Public $content;

    //Public function __construct(){
    //    parent::__construct();
    //}
    /*Public function __get($property) {
        if (property_exists($this, $property)) {
            if('date_inserted' === $property) {
                echo "test";
                return $property->format('d/m/Y H:i:s');
            }
            return $this->$property;
        }
        return null;
    }
    */


    public function setIDBIS($id)
    {
        $this->id = $id;
        //  $this->getOneBy(["title"=>"$title"], false);
    }

    public function setTitle($title)
    {
        $this->title = mb_strtoupper(trim($title));
      //  $this->getOneBy(["title"=>"$title"], false);
    }

    public function setDescription($description)
    {
        $this->description = ucfirst(trim($description));
    }

    public function setStatus($status)
    {
        $this->status = ucfirst(trim($status));
    }

    public function setRoute($route)
    {
        $this->route = urlencode(trim($route));
    }

    public function setContent($content){

        $this->content = str_replace('"', "'", $content);
    }

    public function setMainPicture($picture)
    {
        $this->main_picture = $picture;
    }

    public function setCategory($category){
        $this->category = ucfirst($category);
    }

}