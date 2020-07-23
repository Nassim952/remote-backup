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

use cms\managers\PageManager;

use cms\controllers\PageController;

use cms\core\Exeptions\ExeptionHandler;
use cms\core\Helpers;

new ConstLoader('prod');

$url = $_SERVER["REQUEST_URI"];

$uri = parse_url($url, PHP_URL_PATH);
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
					}catch(ExeptionHandler $e){
						$controller->$a();
					}
				} else {
					throw new ExeptionHandler("L'action n'existe pas");
				}
			
			} else {
				throw new ExeptionHandler("La class controller ".$c." n'existe pas");
			}

	} else {
		$pages = (new PageManager(Page::class,'page'))->read();
		if(!empty($pages)){
			$found = false;
			foreach($pages as $page) {
				if($newUri == "/".str_replace(' ','_',$page->getTitle()))
				{	
					(new PageController)->buildPageAction($page);
					$found = true;
					break;

				}

				if ($found === true) {
					throw new ExeptionHandler("l'url n'existe pas : Error 404");
				}
			}
		}
		else
		{
			throw new ExeptionHandler("l'url n'existe pas : Error 404");
		}
	}
}
catch (Exception $e)
{
	Helpers::pageNotFound();
}