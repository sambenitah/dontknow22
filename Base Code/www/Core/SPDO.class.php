<?php

declare(strict_types=1);

namespace DontKnow\Core;
use DontKnow\VO\DbDriver;
use DontKnow\VO\DbHost;
use DontKnow\VO\DbName;
use DontKnow\VO\DbUser;
use DontKnow\VO\DbPwd;

class SPDO {

    private static $instance = null;
    private $driver;
    private $host;
    private $name;
    private $user;
    private $pwd;

    public function __construct(DbDriver $driver, DbHost $host, DbName $name, DbUser $user, DbPwd $pwd)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->pwd = $pwd;
    }

    public function getPDO()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new \PDO($this->driver->getDriver().':dbname='.$this->name->getName().';host='.$this->host->getHost()
            ,$this->user->getUser(),$this->pwd->getPwd());

        }
        return self::$instance;
    }

}