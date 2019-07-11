<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\Routing;
use DontKnow\Core\QueryConstructor;

class Users{


    public $id = null;
    /*Public $firstname;
    Public $lastname;
    Public $email;
    Public $token;
    Public $pwd;
    Public $role=1;
    Public $status=0;*/



    public function setIDBIS($id)
    {
        $this->id = $id;
    }

    public function setFirstname($firstname){
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }
    public function setLastname($lastname){
        $this->lastname = strtoupper(trim($lastname));
    }
    public function setEmail($email){
        $this->email = strtolower(trim($email));
    }
    public function setPwd($pwd){
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
    public function setToken($token){
        $this->token = $token;
    }

    public function setTokenPassword($tokenPassword){
        $this->tokenPassword = password_hash((string)$tokenPassword, PASSWORD_DEFAULT);;
    }
    public function setRole($role){
        $this->role = $role;
    }
    public function setStatus($status){
        $this->status = $status;
    }

}
