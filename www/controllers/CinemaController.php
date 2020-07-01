<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;

class CinemaController
{
    public function cinemaAction(){
        new View("cinema","back");
    }

    public function sallesAction(){
        new View("salles","back");
    }
}