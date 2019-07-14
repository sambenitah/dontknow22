<?php

declare(strict_types=1);

namespace DontKnow\Models;

class Pictures{


    public function setNameId($name)
    {
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $name= urlencode($name . $date);
        $this->name_id = str_replace('%','-', $name);
    }

    public function setName($title)
    {
        $this->name = $title ;
    }
}