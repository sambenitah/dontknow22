<?php

declare(strict_types=1);

namespace DontKnow\Dao;
use DontKnow\Models\Customizer as CustomizerModel;



class Customizer extends BaseDAO {

    public function selectMeta(array $arguments){
        $query = $this->queryConstructor->select()->from('Customizer');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
        return $query->fetchColumn(1);
    }

    public function selectContact(array $arguments){
        $query = $this->queryConstructor->select()->from('Customizer');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
        return $query->fetchColumn(3);
    }

    public function selectAllMeta(array $argument){
        $query = $this->queryConstructor->select()->from('Customizer');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($argument);
        return $query->fetch();
    }

    public function selectDesc($arguments){
        $query = $this->queryConstructor->select()->from('Customizer');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
        return $query->fetchColumn(2);
    }


    public function updateMeta(\DontKnow\Models\Customizer $customizer){
        $arguments = get_object_vars($customizer);
        $query = $this->queryConstructor->table('Customizer')->update($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
    }

    public function getCustomMetaForm($content,$title){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=> "",
                "class"=>"",
                "id"=>"form",
                "submit"=>"Update Meta",
                "idSubmit" => "submitAddComment",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false

            ],

            "data"=>[

                "title"=>["type"=>"text","placeholder"=>"Your title of your webSite", "required"=>true, "class"=>"inputAddPage", "id"=>"i2--AddPage","maxlength"=>20,
                    "error"=>"Your road exceeds one hundred characters", "value"=>$title],

                "description"=>["value"=>"Your description", "required"=>true, "id"=>"textaeraAddPage", "class"=>"","minlength"=>2,"maxlength"=>300,
                    "error"=>"Your description must be between two or three hundred  characters","type"=>"", "valueTextearea"=>$content],

            ],

            "select" =>[
                "contactMenu"=>[
                    "id"=>"selectContactMenu",
                    "class"=>"select-css",
                    "name"=>"contactMenu",
                    "label"=>"Contact menu",
                    "option"=>[
                        [
                            "valueOption"=>"1",
                            "id" => "-",
                            "value" => "Utiliser"
                        ]

                        ,
                        [

                            "valueOption"=>"0",
                            "id" => "efhgzjk",
                            "value" => "Ne pas utiliser"
                        ]
                    ],
                ],

            ]

        ];
    }

}