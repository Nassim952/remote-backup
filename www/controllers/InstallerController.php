<?php

namespace cms\controllers;

use cms\core\Installer;
use cms\core\NotFoundException;
use cms\core\Controller;
use cms\forms\InstallerType;
use cms\forms\LoginType;

class InstallerController extends Controller{

	public function installerAction()
    {
        $form = $this->createForm(InstallerType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            if((new Installer())->connectDatabase())
            {
                $form = $this->createForm(LoginType::class);
                $form->handle();
                $this->render("login", "account", [
                    "configFormUser" => $form
                ]);
            } else {
                $this->render("login", "account", [
                    "configFormUser" => $form
                ]);
            }
        }
        else
        {
            $this->render("login", "account", [
                "configFormUser" => $form
            ]);
        }

       
    }
}
