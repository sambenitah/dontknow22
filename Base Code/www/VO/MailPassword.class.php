<?php

namespace DontKnow\VO;

class MailPassword
{
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}