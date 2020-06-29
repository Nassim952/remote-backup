<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\core\Controller;
use cms\core\View;
use cms\core\Helpers;

class CinemaController extends Controller
{
    public function cinemaAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinemas = $cinemaManager->read();

        $this->render("cinema", "back", ['cinemas' => $cinemas]);
    }

    public function sallesAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinema_rooms = $cinemaManager->read();

        $this->render("salles", "back", ['cinema_rooms' => $cinema_rooms]);
    }
}