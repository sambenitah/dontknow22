<?php

declare(strict_types=1);

namespace DontKnow\Models;


class Categories{

    public function setName($name)
    {
        $this->name = ucfirst(strtolower($name)) ;
    }
}