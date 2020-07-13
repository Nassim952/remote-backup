<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\managers\MovieManager;
use cms\core\Controller;
use cms\models\Cinema;
use cms\core\Helpers;
use cms\core\View;

class CinemaController extends Controller
{
    public function cinemaAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinemas = $cinemaManager->read();

        $this->render("cinema", "back", ['cinemas' => $cinemas]);
    }

    public function addCinemaAction(){
        new View('add-cinema');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $cinema = new Cinema();

            $cinema->setName($_POST['name']);
            $cinema->setplace($_POST['city']);
            $cinema->setNumber_rooms($_POST['number_rooms']);
            $cinema->setImage_url($_POST['image_url']);

            $cinemaManager = new cinemaManager(Cinema::class,'cinema');
            $cinemaManager->save($cinema);
        }
    }

    public function deleteCinemaAction(){
        $cinemaManager = new cinemaManager(Cinema::class,'cinema');
        $cinemas = $cinemaManager->read();

        $this->render("delete-cinema", "back", ['cinemas' => $cinemas]);

        if ( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];

            $cinemaManager = new CinemaManager(Cinema::class, 'cinema');
            $cinemaManager->delete($id);

            echo("<meta http-equiv='refresh' content='1'>");
        }
    }

    public function editCinemaAction(){
        $cinemaManager = new cinemaManager(Cinema::class,'cinema');
        $cinemas = $cinemaManager->read();

        $this->render("edit-cinema", "back", ['cinemas' => $cinemas]);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $cinema = $cinemaManager->findBy(['id' => $_POST['id']]);

            $this->render('edit-cinema-id','empty', ['cinema' => $cinema]);
        }
    }

    public function sallesAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinema_rooms = $cinemaManager->read();

        $this->render("salles", "back", ['cinema_rooms' => $cinema_rooms]);
    }
}