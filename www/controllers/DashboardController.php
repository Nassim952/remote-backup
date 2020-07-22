<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\managers\PageManager;
use cms\managers\UserManager;
use cms\managers\MovieReservationManager;

use cms\forms\AddPageType;
use cms\forms\AddFilmType;

use cms\core\Controller;
use cms\core\View;
use cms\core\Helpers;
use cms\core\Validator;

use cms\models\Movie;
use cms\models\Page;
use cms\models\User;
use cms\models\MovieReservation;

class DashboardController extends Controller
{
    public function dashboardAction(){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movies = $movieManager->read();

        $this->render("dashboard", "back", ['movies' => $movies]);
    }

    public function statAction(){
        $movieReservationManager = new MovieReservationManager(MovieReservation::class, 'movie_reservation');
        
        $datas['month'] = $movieReservationManager->getTotalReservation('monthly');
        $datas['days'] = $movieReservationManager->getTotalReservation('daily');
        $datas['years'] = $movieReservationManager->getTotalReservation('yearly');
        
        $this->render("stat","back", ['datas' => $datas]);
    }

}