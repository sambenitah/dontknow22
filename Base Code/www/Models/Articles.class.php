<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;

class Articles{


    public function setIDBIS($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = mb_strtoupper(trim($title));
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