<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Models\Statistics;
use DontKnow\Core\View;
use DontKnow\Models\Articles;
use DontKnow\Core\Validator;
use DontKnow\Core\Routing;
use DontKnow\Models\Comments;


class StatisticsController{

    const nameClass = "Statistics";

    public function defaultAction(){
        $queryBuilder = new Statistics();
        $countUsers = $queryBuilder->querySelectCountUser();
        $countArticles = $queryBuilder->querySelectCountArticle();
        $countComments = $queryBuilder->querySelectCountComments();
        $counter = array_merge($countUsers, $countArticles, $countComments);
        $v = new View("statistics",self::nameClass, "admin");
        $v->assign("CountUser", $counter);
        exit;
    }

    public function evolutionUserAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectGroupByUser();
        echo json_encode($query);
        exit;
    }

    public function evolutionArticleAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectGroupByArticle();
        echo json_encode($query);
        exit;
    }

    public function evolutionCommentAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectGroupByComment();
        echo json_encode($query);
        exit;
    }

    public function managementUsersAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectAllUser();
        $v = new View("userBack",self::nameClass, "admin");
        $v->assign("AllUsers", $query);
    }

    public function detailManagementUsersAction($param){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectDetailUser($param);
        $v = new View("detailUserBack",self::nameClass, "admin");
        $v->assign("DetailUsers", $query);
    }

    public function updateUserDetailAction(){
        $queryBuilder = new Statistics();
        $data = $GLOBALS["_POST"];
        $queryBuilder->updateDetailUser($data);
        $this->detailManagementUsersAction($data["id"]);

    }



}