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
        $counter = array_merge($countUsers, $countArticles);
        $v = new View("statistics",self::nameClass, "admin");
        $v->assign("CountUser", $counter);
        exit;
    }

    public function evolutionUserAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectGroupByUser();
        echo json_encode($query);

    }

    public function evolutionArticleAction(){
        $queryBuilder = new Statistics();
        $query = $queryBuilder->querySelectGroupByArticle();
        echo json_encode($query);

    }

}