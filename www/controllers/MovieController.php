<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\controllers\DashboardController;
use cms\managers\MovieManager;
use cms\core\Controller;
use cms\models\Movie;
use cms\forms\AddFilmType;
use cms\core\Helpers;
use cms\core\View;

class MovieController extends Controller
{
    public function showMovieAction($id){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movie = $movieManager->read($id);

        $this->render('show-movie', 'back', ['myMovie' => $movie]);
    }  

    public function addFilmAction()
    {
        new View("add-film","back");
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

    public function deleteMovieAction($id){
        new View('confirm-page','back');

        $movieManager = new MovieManager(Movie::class,'movie');
        $movieManager->delete($id);

        echo "<script>alert('Film supprimé avec succès');</script>";
    }   

    public function editMovieAction($id){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movie = $movieManager->read($id);

        $this->render('edit-movie','back', ['movie' => $movie]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $movie = new Movie();

            $movie->setId($id);
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
            $movie->setImage_poster($_POST['image_url']);

            $movieManager->save($movie);

            echo "<script>alert('Film modifié avec succès');</script>";
        }
    } 
}