<?php 
namespace cms\controllers;

use cms\core\Controller;
use cms\Managers\ComponentManager;
use cms\models\Component;
use cms\core\View;

class ComponentController extends Controller{
    private $components;

    public function componentAction(){
        $componentManager = new ComponentManager(Component::class, 'component');
        $components = $componentManager->read();
        $this->render("component", "back", ['components'=> $components ]);
    }

    public function addComponentAction(){
        new View('add-component');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $component = new Component();

            $component->setTitle($_POST['title']);
            $component->setClass($_POST['class']);
            $component->setPosition($_POST['position']);
            $component->setStyle($_POST['style']);

            $componentManager = new componentManager(Component::class,'component');
            $componentManager->save($component);
        }
    }


    public function deleteComponentAction(){
        $componentManager = new componentManager(Component::class,'component');
        $components = $componentManager->read();

        $this->render("delete-component", "back", ['components' => $components]);

        if ( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];

            $componentManager = new ComponentManager(Component::class, 'component');
            $componentManager->delete($id);

            echo("<meta http-equiv='refresh' content='1'>");
        }
    }

    public function editComponentAction(){
        $componentManager = new componentManager(Component::class,'component');
        $components = $componentManager->read();

        $this->render("edit-component", "back", ['components' => $components]);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $component = $componentManager->findBy(['id' => $_POST['id']]);

            $this->render('edit-component-id','empty', ['component' => $component]);
        }
    }


}