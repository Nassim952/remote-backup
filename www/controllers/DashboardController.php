<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\managers\PageManager;
use cms\managers\UserManager;

use cms\forms\AddPageType;
use cms\forms\AddFilmType;

use cms\core\Controller;
use cms\core\View;
use cms\core\Helpers;
use cms\core\Validator;

use cms\models\Movie;
use cms\models\Page;
use cms\models\User;

class DashboardController extends Controller
{
    public function dashboardAction(){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movies = $movieManager->read();

        $this->render("dashboard", "back", ['movies' => $movies]);
    }

    public function usersAction(){
        $userManager = new UserManager(User::class,'user');
        $users = $userManager->read();

        $this->render("users", "back", ['users' => $users]);
    }

    public function statAction(){
        new View("stat","back");
    }

    public function horrairesAction(){
        new View("horraires","back");
    }
}