<?php

use DontKnow\Dao\Users;
use DontKnow\Dao\Articles;
use DontKnow\Dao\Comments;
use DontKnow\Dao\Pictures;
use DontKnow\Models\Customizer;
use DontKnow\Dao\Categories;
use DontKnow\Dao\Statistics;
use DontKnow\Dao\ErrorPage;
use DontKnow\Core\QueryConstructor;
use DontKnow\Controllers\UsersController;
use DontKnow\Controllers\ArticlesController;
use DontKnow\Controllers\PicturesController;
use DontKnow\Controllers\CommentsController;
use DontKnow\Controllers\CustomizerController;
use DontKnow\Controllers\CategoriesController;
use DontKnow\Controllers\StatisticsController;
use DontKnow\Controllers\ErrorPageController;
use DontKnow\Core\Container;
use DontKnow\VO\DbDriver;
use DontKnow\VO\DbHost;
use DontKnow\VO\DbName;
use DontKnow\VO\DbUser;
use DontKnow\VO\DbPwd;
use DontKnow\Core\SPDO;

return [
    DbDriver::class => function(Container $container) {
        return new DbDriver($container->getinstance('config.db.driver'));
    },
    DbHost::class => function(Container $container) {
        return new DbHost($container->getinstance('config.db.host'));
    },
    DbName::class => function(Container $container) {
        return new DbName($container->getinstance('config.db.name'));
    },
    DbUser::class => function(Container $container) {
        return new DbUser($container->getinstance('config.db.user'));
    },
    DbPwd::class => function(Container $container) {
        return new DbPwd($container->getinstance('config.db.pwd'));
    },
    Users::class => function(Container $container) {
        return new Users($container->getInstance(QueryConstructor::class));
    },
    QueryConstructor::class => function(Container $container) {
        return new QueryConstructor($container->getInstance(SPDO::class));
    },
    SPDO::class => function(Container $container) {
        return new SPDO($container->getInstance(DbDriver::class)
            ,$container->getInstance(DbHost::class),
            $container->getInstance(DbName::class),
            $container->getInstance(DbUser::class),
            $container->getInstance(DbPwd::class));
    },
    Pictures::class => function(Container $container) {
        return new Pictures($container->getInstance(QueryConstructor::class));
    },
    Articles::class => function(Container $container) {
        return new Articles($container->getInstance(QueryConstructor::class));
    },
    Comments::class => function(Container $container) {
        return new Comments($container->getInstance(QueryConstructor::class));
    },
    Customizer::class => function() {
        return new Customizer();
    },
    Categories::class => function(Container $container) {
        return new Categories($container->getInstance(QueryConstructor::class));
    },
    Statistics::class => function(Container $container) {
        return new Statistics($container->getInstance(QueryConstructor::class));
    },
    ErrorPage::class => function(Container $container) {
        return new ErrorPage($container->getInstance(QueryConstructor::class));
    },
    UsersController::class => function(Container $container) {
        $usersModel = $container->getInstance(Users::class);
        return new UsersController($usersModel);
    },
    ArticlesController::class => function(Container $container) {
        $articlesModel = $container->getInstance(Articles::class);
        return new ArticlesController($articlesModel);
    },
    PicturesController::class => function(Container $container) {
        $usersModel = $container->getInstance(Pictures::class);
        return new PicturesController($usersModel);
    },
    CommentsController::class => function(Container $container) {
        $usersModel = $container->getInstance(Comments::class);
        return new CommentsController($usersModel);
    },
    CustomizerController::class => function(Container $container) {
        $usersModel = $container->getInstance(Customizer::class);
        return new CustomizerController($usersModel);
    },
    CategoriesController::class => function(Container $container) {
        $usersModel = $container->getInstance(Categories::class);
        return new CategoriesController($usersModel);
    },
    StatisticsController::class => function(Container $container) {
        $usersModel = $container->getInstance(Statistics::class);
        return new StatisticsController($usersModel);
    },
    ErrorPageController::class => function(Container $container) {
        $usersModel = $container->getInstance(ErrorPage::class);
        return new ErrorPageController($usersModel);
    },
];