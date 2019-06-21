<?php

use DontKnow\Models\Users;
use DontKnow\Models\Articles;
use DontKnow\Models\Comments;
use DontKnow\Models\Pictures;
use DontKnow\Models\Customizer;
use DontKnow\Models\Categories;
use DontKnow\Models\Statistics;
use DontKnow\Controllers\UsersController;
use DontKnow\Controllers\ArticlesController;
use DontKnow\Controllers\PicturesController;
use DontKnow\Controllers\CommentsController;
use DontKnow\Controllers\CustomizerController;
use DontKnow\Controllers\CategoriesController;
use DontKnow\Controllers\StatisticsController;
use DontKnow\VO\DbDriver;
use DontKnow\VO\DbHost;
use DontKnow\VO\DbName;
use DontKnow\VO\DbUser;
use DontKnow\VO\DbPwd;

return [
    DbDriver::class => function($container) {
        return new DbDriver($container['config']['db']['driver']);
    },
    DbHost::class => function($container) {
        return new DbHost($container['config']['db']['host']);
    },
    DbName::class => function($container) {
        return new DbName($container['config']['db']['name']);
    },
    DbUser::class => function($container) {
        return new DbUser($container['config']['db']['user']);
    },
    DbPwd::class => function($container) {
        return new DbPwd($container['config']['db']['pwd']);
    },
    Users::class => function($container) {
        return new Users();
    },
    Pictures::class => function($container) {
        return new Pictures();
    },
    Articles::class => function($container) {
        return new Articles();
    },
    Comments::class => function($container) {
        return new Comments();
    },
    Customizer::class => function($container) {
        return new Customizer();
    },
    Categories::class => function($container) {
        return new Categories();
    },
    Statistics::class => function($container) {
        return new Statistics();
    },
    UsersController::class => function($container) {
        $usersModel = $container[Users::class]($container);
        return new UsersController($usersModel);
    },
    ArticlesController::class => function($container) {
        $usersModel = $container[Articles::class]($container);
        return new ArticlesController($usersModel);
    },
    PicturesController::class => function($container) {
        $usersModel = $container[Pictures::class]($container);
        return new PicturesController($usersModel);
    },
    CommentsController::class => function($container) {
        $usersModel = $container[Comments::class]($container);
        return new CommentsController($usersModel);
    },
    CustomizerController::class => function($container) {
        $usersModel = $container[Customizer::class]($container);
        return new CustomizerController($usersModel);
    },
    CategoriesController::class => function($container) {
        $usersModel = $container[Categories::class]($container);
        return new CategoriesController($usersModel);
    },
    StatisticsController::class => function($container) {
        $usersModel = $container[Statistics::class]($container);
        return new StatisticsController($usersModel);
    },
];