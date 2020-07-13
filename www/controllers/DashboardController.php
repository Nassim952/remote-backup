<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\core\Controller;
use cms\core\View;
use cms\forms\AddFilmType;
use cms\managers\UserManager;
use cms\models\Movie;
use cms\models\User;
use cms\core\Helpers;
use cms\core\Validator;

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
        $form = $this->createForm(AddFilmType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $movieManager = new MovieManager(Movie::class, 'movie');
            $movie = new Movie();

            $movie->setTitle($_POST[$form->getName().'_title']);
            $movie->setRelease($_POST[$form->getName().'_date']);
            $movie->setDuration($_POST[$form->getName().'_duration']);
            $movie->setSynopsis($_POST[$form->getName().'_synopsis']);
            $movie->setKind($_POST[$form->getName().'_kind']);
            $movie->setAge_require($_POST[$form->getName().'_age']);
            $movie->setDirector($_POST[$form->getName().'_director']);
            $movie->setMain_actor($_POST[$form->getName().'_actor']);
            $movie->setNationality($_POST[$form->getName().'_nationality']);
            $movie->setMovie_type($_POST[$form->getName().'_type']);
            $movie->setImage_url($_POST[$form->getName().'_image_url']);

            $movieManager->save($movie);

            var_dump($_POST);
        }

        $this->render("add-film", "back", [
            "configFormUser" => $form
        ]);

    }

    public function deleteMovieAction(){
        $movieManager = new MovieManager(Movie::class, 'movie');
        $movies = $movieManager->read();

        $this->render("delete-movie", "back", ['movies' => $movies]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];
            $movieManager->delete($id);

            echo("<meta http-equiv='refresh' content='1'>");
        }
    }

    public function editMovieAction(){
        $movieManager = new MovieManager(Movie::class, 'movie');
        $movies = $movieManager->read();

        $this->render("edit-movie", "back", ['movies' => $movies]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];
            
            Helpers::redirect_to('Dashboard','addFilm');
        }
    }

    public function statAction(){
        new View("stat","back");
    }

    /* public function addFilmAction(){
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

    } */

    public function horrairesAction(){
        new View("horraires","back");
    }
}