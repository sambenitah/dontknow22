<?php

declare(strict_types=1);

namespace DontKnow\Dao;
use DontKnow\Models\Articles as ArticleModel;

class Sitemap extends BaseDAO {

    public function selectCAllRoutes(){
        $query = $this->queryConstructor->prepare("SELECT route FROM Articles");
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute();
        return $query->fetchAll();
    }



}