<?php

namespace cms\controllers;

use cms\core\View;

class DefaultController{
	public function defaultAction()
	{
		// parameter order -> vues, tpl
		$myView = new View("dashboard","back");
	}
}