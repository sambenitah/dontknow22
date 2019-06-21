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
}