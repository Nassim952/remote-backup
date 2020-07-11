<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;
use cms\forms\AddFilmType;
use cms\core\Controller;
use cms\core\Validator;

class DashboardController extends Controller
{

    public function dashboardAction(){
        new View("dashboard","back");
    }

    public function cinemaAction(){
        new View("cinema","back");
    }

    public function sallesAction(){
        new View("salles","back");
    }

    public function usersAction(){
        new View("users","back");
    }

    public function statAction(){
        new View("stat","back");
    }

    public function addFilmAction()
    {
        $form = $this->createForm(AddFilmType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            //(new UserManager())->save($user);
            // j'ai mon nouveau modele valide ($user) je peux le save
        }

        $this->render("addfilm", "account", [
            "formProfile" => $form
        ]);

    }
    public function horrairesAction(){
        new View("horraires","back");
    }

}