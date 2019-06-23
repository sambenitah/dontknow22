<?php

declare(strict_types=1);

namespace DontKnow\Models;
use DontKnow\Core\QueryConstructor;

class Articles{

    //Public $title;
    //Public $description;
    //Public $route;
   // Public $content;

    //Public function __construct(){
    //    parent::__construct();
    //}
    /*Public function __get($property) {
        if (property_exists($this, $property)) {
            if('date_inserted' === $property) {
                echo "test";
                return $property->format('d/m/Y H:i:s');
            }
            return $this->$property;
        }
        return null;
    }
    */

    public function setIDBIS($id)
    {
        $this->id = $id;
        //  $this->getOneBy(["title"=>"$title"], false);
    }

    public function setTitle($title)
    {
        $this->title = mb_strtoupper(trim($title));
      //  $this->getOneBy(["title"=>"$title"], false);
    }

    public function setDescription($description)
    {
        $this->description = ucfirst(trim($description));
    }

    public function setStatus($status)
    {
        $this->status = ucfirst(trim($status));
    }

    public function setRoute($route)
    {
        $this->route = urlencode(trim($route));
    }

    public function setContent($content){

        $this->content = str_replace('"', "'", $content);
    }

    public function setMainPicture($picture)
    {
        $this->main_picture = $picture;
    }

    public function setCategory($category){
        $this->category = ucfirst($category);
    }


    public function addArticle(){
        $addArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $addArticle->table("Articles")->insert($arguments);
        $query = $addArticle->instance->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectAllArticle(){
        $selectArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $selectArticle->select($arguments)->from('Articles')->where(["status"=>1]);
        $query = $selectArticle->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute(["status"=>1]);
        return $query->fetchAll();
    }

    public function selectAllArticleBis(){
        $selectArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $selectArticle->select($arguments)->from('Articles');
        $query = $selectArticle->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute();
        return $query->fetchAll();
    }

    public function selectSingleArticle(array $where){
        $selectSingleArticle = new QueryConstructor();
        $query = $selectSingleArticle->select()->from('Articles')->where($where);
        $query = $selectSingleArticle->instance->prepare((string)$query);
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        $query->execute($where);
        return $query->fetchAll();
    }

    public function deleteArticle(array $delete){
        $deleteArticle = new QueryConstructor();
        $query = $deleteArticle->delete('Articles')->where($delete);
        $query = $deleteArticle->instance->prepare((string)$query);
        $query->execute($delete);
        return $query->fetch();
    }

    public function updateArticle(){
        $updateArticle = new QueryConstructor();
        $arguments = get_object_vars($this);
        $query = $updateArticle->table('Articles')->update($arguments);
        $query = $updateArticle->instance->prepare((string)$query);
        $query->execute($arguments);
    }

    public function selectCommentArticle(array $where){
        $selectComment = new QueryConstructor();
        $query = $selectComment->instance->prepare("SELECT Comments.id, Users.lastname, Users.firstname, Comments.content,Comments.date_inserted FROM Comments, Users WHERE Comments.userId = Users.email AND Comments.articleId = :idArticle ORDER BY Comments.date_inserted DESC");
        $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
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
                    "error"=>"Your description must be between two or three hundred ten characters","type"=>""],

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
                    "class"=>"select-css",
                    "label"=>"Select your picture",
                    "option"=>[
                        [
                            "class" => "-",
                            "value" => "-"
                        ]

                        /*,
                        [
                            "class" => "efhgzjk",
                            "value" => "test"
                        ]*/
                    ],
                ],

                "category"=>[
                    "id"=>"selectCategory",
                    "class"=>"select-css",
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
                    "class"=>"select-css",
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