<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Models\Customizer;


Class CustomizerController{

    const nameClass = "Customizer";

    public function __construct(Customizer $customizer)
    {
        $this->customizer = $customizer;
    }

    public function defaultAction(){
        $v = new View("customizer",self::nameClass, "admin");
    }

}