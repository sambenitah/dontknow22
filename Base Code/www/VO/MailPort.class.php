<?php

namespace DontKnow\VO;

class MailPort
{
    private $port;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getPort()
    {
        return $this->port;
    }
}