<?php

declare(strict_types=1);

namespace DontKnow\Models;

class Statistics{

    public function querySelectCountUser(){

        $selectCountUser = new QueryConstructor();
        $query = $selectCountUser->from('Users')->select("Count(id)");
        $result = $selectCountUser->instance->selectArray((string)$query);
        return $result;
    }
}