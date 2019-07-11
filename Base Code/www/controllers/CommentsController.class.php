<?php

declare(strict_types=1);

namespace DontKnow\Controllers;

use DontKnow\Models\Comments as CommentsModel;
use DontKnow\Dao\Comments;
use DontKnow\Core\Routing;

Class CommentsController{

    const nameClass = "Comments";

    private $commentDao;

    public function __construct(Comments $comments)
    {
        $this->commentDao = $comments;
    }

    public function deleteCommentAction(){
        $data = $GLOBALS["_POST"];
        $id = $data["id"];
        $this->commentDao->deleteComment(['id'=>$id]);
        echo json_encode("delete");

    }


}