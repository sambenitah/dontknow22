<?php

declare(strict_types=1);

namespace DontKnow\Models;

class Customizer{


    public function setId($id){
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setcontactMenu($contactMenu)
    {
        $this->contactMenu = $contactMenu;
    }

}