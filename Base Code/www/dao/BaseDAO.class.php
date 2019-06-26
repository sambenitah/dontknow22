<?php

namespace DontKnow\Dao;

use DontKnow\Core\QueryConstructor;
use DontKnow\Core\Container;



class BaseDAO
{

    protected $queryConstructor;

    public function __construct(QueryConstructor $queryConstructor)
    {
        $this->queryConstructor = $queryConstructor;
    }

}