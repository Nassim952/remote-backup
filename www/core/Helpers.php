<?php

namespace cms\core;

use cms\managers\PageManager;
use cms\controllers\PageController;

class Helpers
{
    public static function getUrl($controller, $action)
    {
        $listOfRoutes = yaml_parse_file("routes.yml");

        foreach ($listOfRoutes as $url => $values) 
        {
            if($values["controller"]==$controller && $values["action"]==$action)
            {
                return $url;
            }
        }
        return "/";
    }

    public static function redirect_to(string $controller, string $action, array $params = null)
    {
        $listOfRoutes = yaml_parse_file("routes.yml");
        foreach ($listOfRoutes as $url => $values) 
        {
            if($values["controller"]==$controller && $values["action"]==$action)
            {
                $controller.='Controller';
                $action.='Action';
                
                (new $controller())->$action(implode(',',$params));
            }
        }
    }

    public static function alert_popup(string $msg){
        echo "<script>alert('$msg');</script>";
    }

    public static function refresh($newUri){
        $listOfRoutes = yaml_parse_file("routes.yml");
        
        foreach ($listOfRoutes as $url => $values) 
        {
            if($newUri == $url){
                echo "<meta http-equiv='refresh' content='0;url='.$newUri />";
            }
            else
            {
                $pages = (new PageManager(Page::class,'page'))->read();

                if(!empty($pages)){
                    foreach($pages as $page) {
                        if($newUri == "/".str_replace(' ','_',$page->getTitle()))
                        {	
                            (new PageController())->buildPageAction($page);
                            break;
                        }
                    }
                }
            }
        }
    }

    public static function implodeArrayKeys($array) {
        return implode(", ",array_keys($array));
    }
    
    public static function displayStars($levelString) {
        $level = intval($levelString);
        for ($i = 1; $i <= $level; $i++) { 
            echo "<img src='public/images/favorite.png'/>"; 
        };
    }

    public function displayStarsEdition($levelString) {
        $level = intval($levelString);
        for ($i = 1; $i <= $level; $i++) { 
            echo "<img class='star_home_edition' src='public/images/favorite.png'/>"; 
        };
    }

    public function displayStarsEditionRead($levelString) {
        $level = intval($levelString);
        for ($i = 1; $i <= $level; $i++) { 
            echo "<img class='star_home_edition_read' src='public/images/favorite.png'/>"; 
        };
    }

    public static function getPermission($permission) {
        switch ($permission) {
            case 0:
                return "customer";
                break;
            case 1:
                return "admin";
                break;
            case 2:
                return "superAdmin";
                break;
            case 3:
                return "owner";
                break;
        }
    }

    public static function array_unique_multidimensional($input)
    {
        $serialized = array_map('serialize', $input);
        $unique = array_unique($serialized);
        return array_intersect_key($input, $unique);
    }

    public static function array_multi_unique($src){
        $output = array_map("unserialize",
        array_unique(array_map("serialize", $src)));
    return $output;
    }
}
