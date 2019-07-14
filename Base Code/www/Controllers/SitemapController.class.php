<?php

declare(strict_types=1);

namespace DontKnow\Controllers;
use DontKnow\Core\View;
use DontKnow\Dao\Sitemap;



Class SitemapController{

    const nameClass = "Customizer";

    private $sitemapDao;

    public function __construct(Sitemap $sitemap)
    {
        $this->sitemapDao = $sitemap;
    }

    public function generateXml(string $route, bool $article){
        $xml= "<url>";
        $xml.= "<loc>";
        $xml.=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
        $xml .= $article ? '/articles/'.'singleArticle/'.$route : $route;
        $xml.= "</loc>";
        $xml.= "</url>";
        return $xml;

    }

    public function defaultAction(){


        $xml= '<?xml version="1.0" encoding="UTF-8"?>';
        $xml.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $myroute = file( __DIR__.'/../routes.yml');

        $i = 0;
        $j = 3;

        for($c = 0; $c < count($myroute)/6;$c ++){
            if(trim($myroute[$j]) == "connexion: false") {
                $myroute[$i] = str_replace(':','',$myroute[$i]);
                $myroute[$i] = str_replace('"','',$myroute[$i]);
                $xml.= $this->generateXml(trim($myroute[$i]),false);
            }
            $i+=6;
            $j+=6;
        }

        $routes = $this->sitemapDao->selectCAllRoutes();

        foreach ($routes as $route){
            $xml.= $this->generateXml($route->route,true);
        }

        $xml.='</urlset>';


        header("Content-type: application/xml");

        echo $xml;
    }

}