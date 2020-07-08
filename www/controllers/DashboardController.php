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
        $configForm = AddFilmType::getForm();

        $errors = Validator::formAddFilmValidate( $configForm, $_POST );

        if ( $_POST) {
            //Vérification des champs
            
            /* if(empty($error)){
                $film = new Movie();
                $film->setTitle($_POST['title']);
            } */
        }
        $this->render('addfilm','back', [
            'configForm' => $configForm,
            'errors' => $errors
            ]);
    }
    public function horrairesAction(){
        new View("horraires","back");
    }

}