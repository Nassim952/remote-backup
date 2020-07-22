<?php 

namespace cms\core;

use SplObserver;
use SplObjectStorage;
use cms\core\Builder\FormBuilder;
use cms\managers\PageManager;
use cms\core\Events\ControllerEvent;

class Controller implements \SplSubject
{

    protected $observers;
    protected $event;

    public function __construct()
    {
        $this->event = new ControllerEvent(); 
        $this->observers = new SplObjectStorage();
        $this->attach($this->event);
    }

    public function createForm(string $class, $data = null, Model &$model = null): Form
    {
        $form = new $class;
        $form->configureOptions();
        $form->initForm($data);
        if($model){
            $form->setModel($model);
            $form->associateValue();
        }
        return $form;
    }

    // Permet la redirection
    public function redirectTo(string $controller, $action)
    {

    }

    // Récupère l'utilisateur connecté où retourne null
    public function getUser()
    {

    }

    public function render(string $view, string $template = "back", array $params = null)
    { 
        $myView = new View($view, $template);
        
        if ((null !== $params && !empty($params)) || $template != "back")
        {
            if($template != "back")
            {
                $params['nav']=  (new PageManager(Movie::class,'movie'))->getNav();
            }
            foreach($params as $key => $param) {
                $myView->assign($key, $param);
            }
        }

    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        // /** @var SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }


}
