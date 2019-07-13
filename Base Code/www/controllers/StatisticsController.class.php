<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Dao\Statistics;
use DontKnow\Core\View;
use DontKnow\Models\Articles;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;
use DontKnow\Models\Comments;


class StatisticsController{

    public function __construct(Statistics $statistics)
    {
        $this->statistics = $statistics;
    }

    const nameClass = "Statistics";

    public function defaultAction(){
        $queryBuilder = $this->statistics;
        $countUsers = $queryBuilder->querySelectCountUser();
        $countArticles = $queryBuilder->querySelectCountArticle();
        $countComments = $queryBuilder->querySelectCountComments();
        $counter = array_merge($countUsers, $countArticles, $countComments);
        $v = new View("statistics",self::nameClass, "admin");
        $v->assign("CountUser", $counter);
        exit;
    }

    public function evolutionUserAction(){
        $queryBuilder = $this->statistics;
        $query = $queryBuilder->querySelectGroupByUser();
        echo json_encode($query);
        exit;
    }

    public function evolutionArticleAction(){
        $queryBuilder = $this->statistics;
        $query = $queryBuilder->querySelectGroupByArticle();
        echo json_encode($query);
        exit;
    }

    public function evolutionCommentAction(){
        $queryBuilder = $this->statistics;
        $query = $queryBuilder->querySelectGroupByComment();
        echo json_encode($query);
        exit;
    }

    public function managementUsersAction(){
        $queryBuilder = $this->statistics;
        $query = $queryBuilder->querySelectAllUser();
        $v = new View("userBack",self::nameClass, "admin");
        $v->assign("AllUsers", $query);
    }

    public function detailManagementUsersAction($param){
        $queryBuilder = $this->statistics;
        $query = $queryBuilder->querySelectDetailUser($param);
        $v = new View("detailUserBack",self::nameClass, "admin");
        $v->assign("DetailUsers", $query);
    }

    public function updateUserDetailAction(){
        $queryBuilder = $this->statistics;
        $data = $GLOBALS["_POST"];
        $queryBuilder->updateDetailUser($data);
        header('Location: '.Routing::getSlug("Statistics","managementUsers").'');

    }



}