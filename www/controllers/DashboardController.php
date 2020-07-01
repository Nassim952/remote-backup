<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;
use cms\forms\AddFilmType;
use cms\core\Controller;

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
        if ( $_POST) {
            //Vérification des champs
            $error = Validator::formAddFilmValidate( AddFilmType::class, $_POST );
            $this->render("addfilm", "back", [
                "form" => AddFilmType::class,
                "errors" => $error
            ]);
            if(empty($error)){
                $film = new Film();
            }
        }
    }
    public function horrairesAction(){
        new View("horraires","back");
    }

}