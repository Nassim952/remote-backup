<?php

namespace cms\core;

use cms\controllers;
use cms\controllers\CinemaController;

class Helpers{

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
                $myController = $controller.'Controller';
                $action.='Action';
                
                $myObject = new $myController();
                
                $myObject->$action(implode(',',$params));
                
                break;
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

    function displayStarsEdition($levelString) {
        $level = intval($levelString);
        for ($i = 1; $i <= $level; $i++) { 
            echo "<img class='star_home_edition' src='public/images/favorite.png'/>"; 
        };
    }

    function displayStarsEditionRead($levelString) {
        $level = intval($levelString);
        for ($i = 1; $i <= $level; $i++) { 
            echo "<img class='star_home_edition_read' src='public/images/favorite.png'/>"; 
        };
    }

    function displayState($number_state) {
        switch ($number_state) {
            case 1:
                echo "Pas fait";
                break;
            case 2:
                echo "A corriger";
                break;
            case 3:
                echo "Corrigé";
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
