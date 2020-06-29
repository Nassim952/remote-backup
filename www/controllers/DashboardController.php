<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\core\Controller;
use cms\core\View;

class DashboardController extends Controller
{
    public function dashboardAction(){
        $movieManager = new MovieManager('movie','movie');
        $movies = $movieManager->read();

        $this->render("dashboard", "back", ['movies' => $movies]);
    }

    public function usersAction(){
        new View("users","back");
    }

    public function statAction(){
        new View("stat","back");
    }

    public function horrairesAction(){
        new View("horraires","back");
    }

}