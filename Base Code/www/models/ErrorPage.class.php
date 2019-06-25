<?php

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;
use DontKnow\Core\Routing;


class ErrorPage{

    public function setIdBis($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = ucfirst(trim($content));
    }

    public function setBackgroundColor($backgroundColor)
    {
        $this->background_color = $backgroundColor;
    }

    public function setTextColor($textColor)
    {
        $this->text_color = $textColor;
    }
}