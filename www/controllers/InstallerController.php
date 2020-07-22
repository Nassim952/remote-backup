<?php

namespace cms\controllers;

use cms\core\Installer;
use cms\core\Helpers;
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
                $view = Helpers::getUrl("Page", "templateCreate");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } else {
                $this->render("installer", "installer", [
                    "configFormUser" => $form
                ]);
            }
        }
        else
        {
            $this->render("installer", "installer", [
                "configFormUser" => $form
            ]);
        }
    }
}
