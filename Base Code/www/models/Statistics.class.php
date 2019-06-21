<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;


class Statistics{

    public function querySelectCountUser(){

        $selectCountUser = new QueryConstructor();
        $query = $selectCountUser->select()->count('id', "User")->from('Users');
        $query = $selectCountUser->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    public function querySelectCountArticle(){
        $selectCountArticle = new QueryConstructor();
        $query = $selectCountArticle->select()->count('id', "Article")->from('Articles');
        $query = $selectCountArticle->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    public function querySelectGroupByUser(){
        $selectGroupByUser = new QueryConstructor();
        $query = $selectGroupByUser->instance->prepare("SELECT count(id) as NumberMember, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Users GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectGroupByArticle(){
        $selectGroupByUser = new QueryConstructor();
        $query = $selectGroupByUser->instance->prepare("SELECT count(id) as NumberArticle, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Articles GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }
}