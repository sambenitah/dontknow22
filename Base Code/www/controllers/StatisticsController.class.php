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
        //$countArticles = $queryBuilder->querySelectCountArticle();
        var_dump($countUsers);

        /*
        $v = new View("statistics", "admin");
        $v->assign("CountUser", $countUsers);
        exit;*/
    }

}