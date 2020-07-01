<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\core\Controller;
use cms\core\View;
use cms\managers\UserManager;
use cms\models\Movie;
use cms\models\User;
use cms\core\Helpers;

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

    public function addFilmAction()
    {
        new View("addfilm","back");
        $movieManager = new MovieManager(Movie::class, 'movie');

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $movie = new Movie();

            $movie->setTitle($_POST['title']);
            $movie->setRelease($_POST['date']);
            $movie->setDuration($_POST['duration']);
            $movie->setSynopsis($_POST['synopsis']);
            $movie->setKind($_POST['kind']);
            $movie->setAge_require($_POST['age']);
            $movie->setDirector($_POST['director']);
            $movie->setMain_actor($_POST['actor']);
            $movie->setNationality($_POST['nationality']);
            $movie->setMovie_type($_POST['type']);
            $movie->setImage_url($_POST['image_url']);

            $movieManager->save($movie);
        }
    }

    public function statAction(){
        new View("stat","back");
    }

    public function horrairesAction(){
        new View("horraires","back");
    }

}