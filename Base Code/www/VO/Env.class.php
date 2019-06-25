<?php

namespace DontKnow\VO;

class Env
{
    private $env;

    public function __construct(string $env)
    {
        $this->env = $env;
    }

    public function getEnv()
    {
        return $this->env;
    }
}