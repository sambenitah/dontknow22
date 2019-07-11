<?php

declare(strict_types=1);

namespace DontKnow\Models;



class Comments{


    public function setIDBIS($id)
    {
        $this->id = $id;
    }

    public function setContent($content)
    {
        $this->content = htmlspecialchars($content);
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }
}