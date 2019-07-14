<?php

namespace DontKnow\Core;


use DontKnow\VO\DbHost;

class Container{

    private $container;
    private static $instance;


    public function __construct()
    {
        $this->init();
        self::$instance = $this;
    }

    public function init(){
        $this->container = [];
        $this->container['config'] = require __DIR__.'/../Config/global.php';
        $this->container += require __DIR__.'/../Config/di.global.php';
        $this->container[self::class]=function(){return $this;};
    }

    public function getInstance(string $instance){

        $instance = explode('.',$instance);

        $array = array_reduce($instance,function($carry,string $element){
            return $carry[$element];
        },$this->container);

        if($array instanceof \Closure)
            return $array($this);

        return $array;




    }

    public static function getObject(){
        return self::$instance;
    }

    public function  isInstall(){
        return empty($this->getInstance(DbHost::class)->getHost());
    }

}