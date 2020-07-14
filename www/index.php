<?php

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
// $test= $_ENV["HOST_DB"];
// var_dump($test);
//  print_r(get_defined_constants(true));

$uri = $_SERVER["REQUEST_URI"];

//recupère l'id de l'url si il existe # /show-movie/{{id}}
$id = substr($uri, strrpos($uri, '/') +1);

// nettoie l'uri pour retirer le param # /show-movie/2 -> /show-movie
$newUri = explode('/', $uri)[1];
$newUri = '/'.$newUri;

try{
	$listOfRoutes = yaml_parse_file("routes.yml");

	if( !empty($listOfRoutes[$newUri]) ){
		$c = 'cms\controllers\\'.ucfirst($listOfRoutes[$newUri]["controller"]."Controller");
		$a = $listOfRoutes[$newUri]["action"]."Action";

			// include "controllers/".$c.".php";
			if( class_exists($c)){

				$controller = new $c();

				if( method_exists($controller, $a)){
					try{
						$controller->$a($id);
					}catch(Exception $e){
						$controller->$a();
					}
				} else {
					throw new Exception("L'action n'existe pas");
				}
			
			} else {
				throw new Exception("La class controller ".$c." n'existe pas");
			}

	} else {
		throw new Exception("l'url n'existe pas : Error 404");
	}
}
catch (Exception $e)
{
	echo 'Exception. Message d\'erreur : '.$e->getMessage();
	//new View('404.php');
}