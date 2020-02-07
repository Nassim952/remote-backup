<?php
// session_start();

//Permet d'inclure une classe non défini
function myAutoload($class){
    if(file_exists("core/".$class.".class.php")){
        include "core/".$class.".class.php";

    }else if(file_exists("models/".$class.".model.php")){
        include "models/".$class.".model.php";
    }
    else if(file_exists("controllers/".$class.".class.php")){
        include "controllers/".$class.".class.php";
    }
}

spl_autoload_register("myAutoload");

new ConstLoader();

//récupère le lien 
$uri = $_SERVER["REQUEST_URI"];

//parse le ficher routes.yml en tableau
$listOfRoutes = yaml_parse_file("routes.yml");

if(!empty($listOfRoutes[$uri])){
    $c = $listOfRoutes[$uri]["controller"]."Controller";
    print_r($listOfRoutes[$uri]);
    $a = $listOfRoutes[$uri]["action"]."Action";

    if (file_exists("controllers/".$c.".class.php")) {
        
        include "controllers/".$c.".class.php";
        if(class_exists($c)){
            $controller = new $c();
            
            if(method_exists($controller, $a)){
                
                $controller->$a();
            }
            else {
                die("l'action n'existe pas");
            }
            
        }else {
            die("la class controller n'existe pas");
        } 
    }else {
        die("le fichier du controller n'existe pas : controllers/".$c.".class.php");
    }
    
}else {
    die("l'url n'existe pas : Error 404");
}