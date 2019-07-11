<?php

namespace DontKnow\VO;

class MailUsername
{
    private $username;

    public function __construct(string $username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }
}