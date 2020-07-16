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

            echo "<script>alert('Cinema ajouté avec succès');</script>";
        }
    }

    public function deleteCinemaAction($id){
        new View('confirm-page','back');
        $cinemaManager = new cinemaManager(Cinema::class,'cinema');

        $cinemaManager->delete($id);
        echo "<script>alert('Cinema supprimé avec succès');</script>";
    }

    public function editCinemaAction($id){
        $cinemaManager = new cinemaManager(Cinema::class,'cinema');
        $cinema = $cinemaManager->read($id);

        $this->render("edit-cinema", "back", ['myCinema' => $cinema]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $cinema = new Cinema();

            $cinema->setId($id);
            $cinema->setName($_POST['name']);
            $cinema->setPlace($_POST['city']);
            $cinema->setNumber_rooms($_POST['number_rooms']);
            $cinema->setImage_url($_POST['image_url']);

            $cinemaManager->save($cinema);

            echo "<script>alert('Film modifié avec succès');</script>";
        }
    }

    public function showCinemaAction($id){
        $cinemaManager = new cinemaManager(Cinema::class,'cinema');
        $cinema = $cinemaManager->read($id);

        $this->render("show-cinema", "back", ['myCinema' => $cinema]);
    }

    public function sallesAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinema_rooms = $cinemaManager->read();

        $this->render("salles", "back", ['cinema_rooms' => $cinema_rooms]);
    }
}