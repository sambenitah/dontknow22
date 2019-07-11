<?php

namespace DontKnow\VO;

class MailHost
{
    private $host;

    public function __construct(string $host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }
}