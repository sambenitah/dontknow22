<?php

declare(strict_types=1);

namespace DontKnow\Controllers;

use DontKnow\Core\Email;
use DontKnow\Models\Comments;

Class EmailController{

    const nameClass = "Comments";

    private $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }



}