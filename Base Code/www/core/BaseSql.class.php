<?php

namespace DontKnow\Core;

class BaseSQL{

    private $table;
    private $instance;


    public function __construct(){
        $this->instance = SPDO::getPDO();
        $this->table = get_called_class();
        if(!$this->instance instanceof \PDO)
            throw new \Exception('Aucune connection');
    }



    public function setId($id, $delete = false){
        $this->id = $id;
        //va récupérer en base de données les élements pour alimenter l'objet
        $this->getOneBy(["id"=>$id]);
        if ($delete == true)
            $this->deleteOneBy(["id"=>$id]);

    }

    public function getAll(array $where, $object = false){

            $sqlWhere = [];
            foreach ($where as $key => $value) {
                $sqlWhere[] = $key . "=:" . $key;
            }

            $sql = " SELECT * FROM " . $this->table . (!empty($where) ? ' WHERE ': '') . implode(" AND ", $sqlWhere) . ";";
            $query = $this->instance->prepare($sql);

            if ($object) {
                //modifier l'objet $this avec le contenu de la bdd
                $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
            } else {
                //on retourne un simple table php
                $query->setFetchMode(\PDO::FETCH_ASSOC);
            }

            $query->execute($where);

        return $query->fetchAll();
    }


    public function select(array $where){

        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . "=:" . $key;
        }
        $sql = " SELECT * FROM " . $this->table . (!empty($where) ? ' WHERE ': '') . implode(" AND ", $sqlWhere) . ";";
        $query = $this->instance->prepare($sql);
        return $query;
    }


    public function selectObject(array $where){
        $query = $this->select($where);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute($where);
        return $query->fetchAll();
    }

    public function selectArray(array $where = null){
        if (isset($where))
        $query = $this->select($where);
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute($where);
        return $query->fetchAll();
    }


    public function getOneBy(array $where){
            // $where = ["id"=>$id, "email"=>"y.skrzypczyk@gmail.com"];
            $sqlWhere = [];
            foreach ($where as $key => $value) {
                $sqlWhere[] = $key . "=:" . $key;
            }
            $sql = "SELECT * FROM " . $this->table . " WHERE  " . implode(" AND ", $sqlWhere) . ";";
            $query = $this->instance->prepare($sql);
            $query->setFetchMode(\PDO::FETCH_INTO, $this);
            $query->execute($where);
            return $query->fetch();
    }

    public function save($files = array()){

        if (!empty($files))
        $extension_upload = strtolower(substr(strrchr($files['name']['name'],'.'),1));

        $dataObject = get_object_vars($this);
        $dataChild = array_diff_key($dataObject, get_class_vars(get_class()));

        if (!empty($files))
            $dataChild["name_id"] = $dataChild["name_id"].".".$extension_upload;

        if( is_null($dataChild["id"])){

            $sql ="INSERT INTO ".$this->table." ( ".
                implode(",", array_keys($dataChild) ) .") VALUES ( :".
                implode(",:", array_keys($dataChild) ) .")";

            $query = $this->instance->prepare($sql);
            $query->execute( $dataChild );


        if (!empty($files))
            move_uploaded_file($files["name"]['tmp_name'], $files["pathFile"].$this->name_id.".".$extension_upload);
        }else{

        $sqlUpdate = [];
        foreach ($dataChild as $key => $value) {
            if( $key != "id")
                $sqlUpdate[]=$key."=:".$key;
            }
            $sql ="UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id";
            $query = $this->instance->prepare($sql);
            $query->execute($dataChild);
        }
    }

    public function deleteOneBy(array $where){
        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . "=:" . $key;
        }
        $sql = " DELETE  FROM " . $this->table . " WHERE  " . implode(" AND ", $sqlWhere) . ";";
        $query = $this->instance->prepare($sql);
        $query->execute($where);
        return $query->fetch();
    }

}




