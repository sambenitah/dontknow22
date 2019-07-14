<?php

declare(strict_types=1);

namespace DontKnow\Dao;

use DontKnow\Models\Users;

class Statistics extends BaseDAO {

    public function querySelectCountUser(){

        $query = $this->queryConstructor->select()->count('id', "User")->from('Users');
        $query = $this->queryConstructor->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    public function querySelectCountArticle(){
        $query = $this->queryConstructor->select()->count('id', "Article")->from('Articles');
        $query = $this->queryConstructor->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    public function querySelectCountComments(){
        $query = $this->queryConstructor->select()->count('id', "Comment")->from('Comments');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetch();
    }

    public function querySelectGroupByUser(){
        $query = $this->queryConstructor->prepare("SELECT count(id) as NumberMember, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Users GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectGroupByArticle(){
        $query = $this->queryConstructor->prepare("SELECT count(id) as NumberArticle, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Articles GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectGroupByComment(){
        $query = $this->queryConstructor->prepare("SELECT count(id) as NumberComment, DATE_FORMAT(date_inserted, '%M %d %Y') as date FRom Comments GROUP BY date");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectAllUser(){
        $query = $this->queryConstructor->select()->from('Users');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, Users::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function querySelectDetailUser($param){
        $query = $this->queryConstructor->select()->from('Users')->where(["id"=>$param]);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute(["id"=>$param]);
        return $query->fetch();
    }

    public function updateDetailUser($arguments){
        $query = $this->queryConstructor->table('Users')->update($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        return $query->execute($arguments);
    }

}