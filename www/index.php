<?php
// session_start();

function myAutoload($class)
{
    $class = str_replace("cms", "", $class);

    $class = str_replace('\\', '/', $class);

    if($class[0] == '/') {
        include substr($class.'.php', 1);
        } else {
        include $class.'.php';
    }
	
}

spl_autoload_register("myAutoload");

use cms\core\ConstLoader;

new ConstLoader();

//récupère le lien 
$uri = $_SERVER["REQUEST_URI"];

//parse le ficher routes.yml en tableau
$listOfRoutes = yaml_parse_file("routes.yml");

if( !empty($listOfRoutes[$uri]) ){
    $c = 'cms\controllers\\'.ucfirst($listOfRoutes[$uri]["controller"]."Controller");
    $a = $listOfRoutes[$uri]["action"]."Action";

        // include "controllers/".$c.".php";
        if( class_exists($c)){

            $controller = new $c();
            if( method_exists($controller, $a)){

                $controller->$a();
				
            }else{
                die("L'action n'existe pas");
            }
		
        }else{
            die("Le class controller n'existe pas");
        }

}else{
    include "views/404.php";
}