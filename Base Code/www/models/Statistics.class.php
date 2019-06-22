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

    public function querySelectCountComments(){
        $selectCountComments = new QueryConstructor();
        $query = $selectCountComments->select()->count('id', "Comment")->from('Comments');
        $query = $selectCountComments->instance->prepare((string)$query);
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

    public function querySelectGroupByComment(){
        $selectGroupByComment = new QueryConstructor();
        $query = $selectGroupByComment->instance->prepare("SELECT count(id) as NumberComment, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Comments GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectAllUser(){
        $selectAllUser = new QueryConstructor();
        $query = $selectAllUser->select()->from('Users');
        $query = $selectAllUser->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectDetailUser($param){
        $selectAllUserDetail = new QueryConstructor();
        $query = $selectAllUserDetail->select()->from('Users')->where(["id"=>$param]);
        $query = $selectAllUserDetail->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute(["id"=>$param]);
        return $query->fetch();
    }

}