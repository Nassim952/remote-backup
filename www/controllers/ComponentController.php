<?php 
namespace cms\controllers;

use cms\core\Controller;
use cms\Managers\ComponentManager;
use cms\models\Component;

class ComponentController extends Controller{
    private $components;

    public function componentAction(){
        $componentManager = new ComponentManager(Component::class, 'component');
        $components = $componentManager->read();
        $this->render("component", "back", ['components'=> $components ]);
    }


}