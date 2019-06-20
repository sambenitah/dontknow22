<?php

declare(strict_types=1);

namespace DontKnow\Controllers;

use DontKnow\Models\Comments;

Class CommentsController{

    const nameClass = "Comments";

    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }



}