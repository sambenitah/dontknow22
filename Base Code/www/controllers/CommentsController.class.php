<?php

declare(strict_types=1);

namespace DontKnow\Controllers;

use DontKnow\Models\Comments;
use DontKnow\Core\Routing;

Class CommentsController{

    const nameClass = "Comments";

    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    public function deleteCommentAction(){
        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $comment = new Comments();
        $comment->deleteComment(['id'=>$id]);
        echo json_encode("delete");

    }


}