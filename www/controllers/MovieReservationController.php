<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\managers\MovieManager;
use cms\managers\MovieReservationManager;
use cms\managers\RoomManager;
use cms\managers\MovieSessionManager;
use cms\core\Controller;
use cms\models\Cinema;
use cms\models\Movie;
use cms\models\Room;
use cms\models\MovieSession;
use cms\models\MovieReservation;
use cms\forms\ReservationType;
use cms\core\Helpers;
use cms\core\View;

class MovieReservationController extends Controller
{

    public function seancesAction(){
        $cinemaManager = new cinemaManager();
        $cinemas = $cinemaManager->read();

        $movieManager = new movieManager();
        $movies = $movieManager->read();

        $this->render("seances", "back", [
            "cinemas" => $cinemas,
            "movies" => $movies
        ]);
    }

    public function getSeancesAction(){

        $cinema_id = $_POST['cinema'];
        $movie_id = $_POST['movie'];
        $date_post = $_POST['date'];

        ($cinema_id == 0)? $cinema = NULL : $cinema = $cinema_id;
        ($movie_id == 0)? $movie = NULL : $movie = $movie_id;
        (empty($date_post))? $date = NULL : $date = $date_post;


        $movieReservationManager = new movieReservationManager();
        $data = $movieReservationManager->getSeance($cinema, $movie, $date);
        

        $this->render("seances_bloc_result", "empty", [
            'data'=> $data
        ]);
    }

    public function reservationAction(){

        $datas = array();
        $datas['cinema'] = $_GET['cinema'];
        $datas['salle'] = $_GET['salle'];
        $datas['film'] = $_GET['film'];
        $datas['seance'] = $_GET['seance'];
        $datas['seance_id'] = $_GET['idms'];

        $form = $this->createForm(ReservationType::class, $_GET['maxticket']);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $movieReservation = new MovieReservation();
            $movieReservationManager = new MovieReservationManager(MovieReservation::class, 'movie_reservation');
            $movieSession = new MovieSession();
            $movieSessionManager = new movieSessionManager(MovieSession::class, 'movie_session');

            $movieReservation->setNbr_places($_POST[$form->getName().'_nbr_ticket']);
            $movieReservation->setUser_email($_POST[$form->getName().'_email']);
            $movieReservation->setMovie_session_id($datas['seance_id']);
            
            $movieSessionTmp = $movieSessionManager->read($datas['seance_id']);

            $nbrplacerest = $movieSessionTmp[0]['nbr_place_rest'] - $_POST[$form->getName().'_nbr_ticket'];

            $movieSession->setId($datas['seance_id']);
            $movieSession->setDate_screaning($movieSessionTmp[0]['date_screaning']);
            $movieSession->setMovie($movieSessionTmp[0]['movie_id']);
            $movieSession->setRoom($movieSessionTmp[0]['room_id']);
            $movieSession->setNbr_place_rest($nbrplacerest);


            
            $movieReservationManager->save($movieReservation);
            $movieSessionManager->save($movieSession);

            echo "<script>alert('Reservation ajouté avec succès');</script>";
            /* header('Location: /seances'); */

        }

        $this->render("reservation", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
        ]);
    }

    /* public function cinemaAction(){
        $cinemaManager = new cinemaManager(Movie::class,'movie');
        $cinemas = $cinemaManager->read();

        $this->render("cinema", "back", ['cinemas' => $cinemas]);
    } */

    /* public function addCinemaAction(){
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
    } */
}