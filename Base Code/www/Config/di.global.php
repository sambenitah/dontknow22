<?php

use DontKnow\Dao\Users;
use DontKnow\Dao\Articles;
use DontKnow\Dao\Comments;
use DontKnow\Dao\Pictures;
use DontKnow\Dao\Customizer;
use DontKnow\Dao\Categories;
use DontKnow\Dao\Statistics;
use DontKnow\Dao\ErrorPage;
use DontKnow\Dao\Sitemap;
use DontKnow\Core\QueryConstructor;
use DontKnow\Controllers\UsersController;
use DontKnow\Controllers\ArticlesController;
use DontKnow\Controllers\PicturesController;
use DontKnow\Controllers\CommentsController;
use DontKnow\Controllers\CustomizerController;
use DontKnow\Controllers\CategoriesController;
use DontKnow\Controllers\StatisticsController;
use DontKnow\Controllers\ErrorPageController;
use DontKnow\Controllers\SitemapController;
use DontKnow\VO\DbDriver;
use DontKnow\VO\DbHost;
use DontKnow\VO\DbName;
use DontKnow\VO\DbUser;
use DontKnow\VO\DbPwd;
use DontKnow\Core\SPDO;
use DontKnow\VO\Env;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use DontKnow\VO\MailHost;
use DontKnow\VO\MailPassword;
use DontKnow\VO\MailPort;
use DontKnow\VO\MailUsername;
use DontKnow\Core\Email;
use DontKnow\VO\WebsiteName;



return [
    PHPMailer::class => function() {
        return new PHPMailer();
    },
    Exception::class => function() {
        return new Exception();
    },
    MailHost::class => function() {
        return new MailHost(resolve('config.mail.host'));
    },
    MailPassword::class => function() {
        return new MailPassword(resolve('config.mail.password'));
    },
    MailPort::class => function() {
        return new MailPort(resolve('config.mail.port'));
    },
    MailUsername::class => function() {
        return new MailUsername(resolve('config.mail.username'));
    },
    WebsiteName::class => function() {
        return new WebsiteName(resolve('config.website.name'));
    },
    DbDriver::class => function() {
        return new DbDriver(resolve('config.db.driver'));
    },
    Env::class => function() {
        return new Env(resolve('config.env.environment'));
    },
    DbHost::class => function() {
        return new DbHost(resolve('config.db.host'));
    },
    DbName::class => function() {
        return new DbName(resolve('config.db.name'));
    },
    DbUser::class => function() {
        return new DbUser(resolve('config.db.user'));
    },
    DbPwd::class => function() {
        return new DbPwd(resolve('config.db.pwd'));
    },
    Users::class => function() {
        return new Users(resolve(QueryConstructor::class));
    },
    QueryConstructor::class => function() {
        return new QueryConstructor(resolve(SPDO::class));
    },
    Email::class => function() {
        return new Email(resolve(MailHost::class),
            resolve(MailPort::class),
            resolve(MailUsername::class),
            resolve(MailPassword::class),
            false);
    },
    SPDO::class => function() {
        return new SPDO(resolve(DbDriver::class)
            ,resolve(DbHost::class),
            resolve(DbName::class),
            resolve(DbUser::class),
            resolve(DbPwd::class));
    },
    Pictures::class => function() {
        return new Pictures(resolve(QueryConstructor::class));
    },
    Articles::class => function() {
        return new Articles(resolve(QueryConstructor::class));
    },
    Comments::class => function() {
        return new Comments(resolve(QueryConstructor::class));
    },
    Customizer::class => function() {
        return new Customizer(resolve(QueryConstructor::class));
    },
    Categories::class => function() {
        return new Categories(resolve(QueryConstructor::class));
    },
    Statistics::class => function() {
        return new Statistics(resolve(QueryConstructor::class));
    },
    ErrorPage::class => function() {
        return new ErrorPage(resolve(QueryConstructor::class));
    },
    Sitemap::class => function() {
        return new Sitemap(resolve(QueryConstructor::class));
    },
    SitemapController::class => function() {
        $sitemapModel = resolve(Sitemap::class);
        return new SitemapController($sitemapModel);
    },
    UsersController::class => function() {
        $usersDAO = resolve(Users::class);
        return new UsersController($usersDAO);
    },
    ArticlesController::class => function() {
        $articlesModel = resolve(Articles::class);
        return new ArticlesController($articlesModel);
    },
    PicturesController::class => function() {
        $usersModel = resolve(Pictures::class);
        return new PicturesController($usersModel);
    },
    CommentsController::class => function() {
        $usersModel = resolve(Comments::class);
        return new CommentsController($usersModel);
    },
    CustomizerController::class => function() {
        $usersModel = resolve(Customizer::class);
        return new CustomizerController($usersModel);
    },
    CategoriesController::class => function() {
        $usersModel = resolve(Categories::class);
        return new CategoriesController($usersModel);
    },
    StatisticsController::class => function() {
        $usersModel = resolve(Statistics::class);
        return new StatisticsController($usersModel);
    },
    ErrorPageController::class => function() {
        $usersModel = resolve(ErrorPage::class);
        return new ErrorPageController($usersModel);
    },
];