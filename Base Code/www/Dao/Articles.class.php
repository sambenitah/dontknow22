<?php

declare(strict_types=1);

namespace DontKnow\Dao;
use DontKnow\Models\Articles as ArticleModel;


class Articles extends BaseDAO{

    public function addArticle(ArticleModel $articles){
        $arguments = get_object_vars($articles);
        $query = $this->queryConstructor->table("Articles")->insert($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectAllArticle(){
        $arguments = get_object_vars($this);
        $query = $this->queryConstructor->select($arguments)->from('Articles')->where(["status"=>1]);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute(["status"=>1]);
        return $query->fetchAll();
    }

    public function selectAllArticleBis(){
        $arguments = get_object_vars($this);
        $query = $this->queryConstructor->select($arguments)->from('Articles');
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function selectArticleWithCategory(array $argument){

        $query = $this->queryConstructor->select()->from('Articles')->where(["status"=>1,"category"=>$argument]);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute(["status"=>1,"category"=>$argument["category"]]);
        return $query->fetchAll();

    }

    public function selectArticleWithWord(array $argument){
        $query = $this->queryConstructor->prepare("SELECT * FROM Articles WHERE content LIKE :content ");
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->bindValue(':content', '%'.$argument["content"].'%', \PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();

    }

    public function selectSingleArticle(array $where){
        $query = $this->queryConstructor->select()->from('Articles')->where($where);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute($where);
        return $query->fetchAll();
    }

    public function deleteArticle(array $delete){
        $query =  $this->queryConstructor->delete('Articles')->where($delete);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }

    public function updateArticle(ArticleModel $articles){
        $arguments = get_object_vars($articles);
        $query =  $this->queryConstructor->table('Articles')->update($arguments);
        $query = $this->queryConstructor->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectCommentArticle(array $where){
        $query = $this->queryConstructor->prepare("SELECT Comments.id, Users.lastname, Users.firstname, Comments.content,Comments.date_inserted FROM Comments, Users WHERE Comments.userId = Users.email AND Comments.articleId = :idArticle ORDER BY Comments.date_inserted DESC");
        $query->setFetchMode(\PDO::FETCH_CLASS, ArticleModel::class);
        $query->execute($where);
        return $query->fetchAll();
    }




    public function getAddArticleForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"",
                "id"=>"form",
                "submit"=>"Create",
                "idSubmit" => "bouttonAddArticle",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false
            ],


            "data"=>[

                "title"=>[
                    "type"=>"text",
                    "placeholder"=>"Title of your page",
                    "required"=>true,
                    "class"=>"inputAddPage",
                    "id"=>"i1--AddPage",
                    "minlength"=>2,
                    "maxlength"=>100,
                    "error"=>"Your title must be between two or one hundred characters",
                ],

                "description"=>["value"=>"Your description", "required"=>true, "id"=>"textaeraAddPage", "class"=>"","minlength"=>2,"maxlength"=>310,
                    "error"=>"Your description must be between two or three hundred ten characters","type"=>"", "valueTextearea"=>""],

                "route"=>["type"=>"text","placeholder"=>"Your url of your page", "required"=>true, "class"=>"inputAddPage", "id"=>"i2--AddPage","maxlength"=>50,
                    "error"=>"Your road exceeds one hundred characters"]
            ]

        ];
    }

    public function getDetailArticleForm(){
        return [
            "config"=>[
                "method"=>"POST",
                "action" => "",
                "class"=>"",
                "id"=>"form",
                "idSubmit" => "bouttonDetailArticle",
                "submit"=>"Update",
                "classSubmit" =>"bouttonConfirmForm",
                "cancelButton"=>false,
                "enctype"=>false

            ],


            "data"=>[
                "content"=>["value"=> "",
                    "id"=>"textareaUpdateArticle",
                    "class"=>"",
                    "minlength"=>8,
                    "maxlength"=>10000,
                    "error"=>"Your content must be between two or ten thousand characters","type"=>""
                ],
            ],

            "select" =>[
                "main_picture"=>[
                    "id"=>"selectPicture",
                    "name"=>"selectPicture",
                    "class"=>"select-css",
                    "label"=>"Select your picture",
                    "option"=>[
                        [
                            "class" => "-",
                            "value" => "-"
                        ]
                    ],
                ],

                "category"=>[
                    "id"=>"selectCategory",
                    "name"=>"selectCategory",
                    "class"=>"select-css",
                    "value"=>"",
                    "label"=>"Select your category",
                    "option"=>[

                        [
                            "id" => "-",
                            "value" => "-"
                        ]
                    ]
                ],

                "status"=>[
                    "id"=>"selectStatus",
                    "name"=>"selectStatus",
                    "class"=>"select-css",
                    "value"=>"",
                    "label"=>"Is Activate",
                    "option"=>[

                        [
                            "id" => "-",
                            "value" => "-"
                        ],

                        [
                            "id" => "0",
                            "value" => "0"
                        ],

                        [
                            "id" => "1",
                            "value" => "1"
                        ]
                    ]
                ]
            ]
        ];
    }
}