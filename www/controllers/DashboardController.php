<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;

class DashboardController
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
        $addFilmType = new AddFilmType();

        if ( $_POST) {
            //Vérification des champs
            $error = Validator::formAddFilmValidate( $addFilmType, $_POST );
            $this->render("register", "account", [
                "form" => $addFilmType,
                "errors" => $error
            ]);
            if(empty($error)){
                $film = new Film();
            }
        } else {
            $this->render("addFilm", "Dashboard", [
                "form" => $addFilmType
            ]);
        }
    }
}