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

    public function getReservationsAction(){
        
        $email_post = $_POST['email'];
        $cinema_id = $_POST['cinema'];
        $movie_id = $_POST['movie'];
        $date_post = $_POST['date'];

        (empty($email_post))? $email = NULL : $email = $email_post;
        ($cinema_id == 0)? $cinema = NULL : $cinema = $cinema_id;
        ($movie_id == 0)? $movie = NULL : $movie = $movie_id;
        (empty($date_post))? $date = NULL : $date = $date_post;

        $movieReservationManager = new movieReservationManager();
        $data = $movieReservationManager->getReservations($email, $cinema, $movie, $date);

        $this->render("reservation_bloc_result", "empty", [
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

            echo "<script>alert('Reservation ajoutée avec succès');</script>";
            $message = 'Réservation ajouté avec succès';
            header('Location: /seances?message=' . urlencode($message));
        }

        $this->render("reservation", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
        ]);
    }
}