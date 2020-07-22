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
use cms\forms\AddSeanceType;
use cms\forms\EditSeanceType;
use cms\core\Helpers;
use cms\core\View;

class MovieSessionController extends Controller
{

    public function addSeanceAction(){
        $datas = array();

        $roomManager = new roomManager();
        $rooms = $roomManager->read();

        $movieManager = new movieManager();
        $movies = $movieManager->read();

        $datas['movies'] = $movies;
        $datas['salles'] = $rooms;

        $form = $this->createForm(AddSeanceType::class, $datas);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $room = new Room();
            $roomManager = new RoomManager(Room::class, 'room');

            $movieSession = new MovieSession();
            $movieSessionManager = new movieSessionManager(MovieSession::class, 'movie_session');

            $roomTmp = $roomManager->read($_POST[$form->getName().'_room']);

            $nbrplacerest = $roomTmp[0]->getNbr_places();

            $movieSession->setDate_screaning($_POST[$form->getName().'_date']);
            $movieSession->setMovie($_POST[$form->getName().'_movie']);
            $movieSession->setRoom($_POST[$form->getName().'_room']);
            $movieSession->setNbr_place_rest($nbrplacerest);
            
            var_dump($movieSession);
            $movieSessionManager->save($movieSession);

            $message = 'Séance ajouté avec succès';
            // header('Location: /seances?message=' . urlencode($message));
            

        }

        $this->render("add-seance", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
        ]);
    }

    public function deleteSeanceAction($datas){
        $id = explode('-', $datas)[0];
        
        if(isset($_POST['delete']) && $_POST['delete'] === 'Oui') {
            $movieSession = new MovieSession();
            $movieSessionManager = new movieSessionManager(MovieSession::class, 'movie_session');
            $movieSessionManager->deleteMovieSession($id);

            $message = 'Votre séance a été supprimée avec succès!';
            header('Location: /seances?message=' . urlencode($message));
        } else if(isset($_POST['delete']) && $_POST['delete'] === 'Non') {
            $message = 'Votre séance n\'a pas été supprimée';
            header('Location: /seances?message=' . urlencode($message));
        } else {
            $this->render("deleteSeance", "back", [
                "datas" => $id 
            ]);
        }        
    }

    public function editSeanceAction($datas){
        $id = explode('-', $datas)[0];
        $cinema_id = explode('-', $datas)[1];
        $room_id = explode('-', $datas)[2];
        $movie_id = explode('-', $datas)[3];

        $movieSessionManager = new movieSessionManager(MovieSession::class,'movie_session');
        $movieSession = $movieSessionManager->read($id);

        $cinemaManager = new cinemaManager();
        $cinemas = $cinemaManager->read();

        $roomManager = new roomManager();
        $rooms = $roomManager->read();

        $movieManager = new movieManager();
        $movies = $movieManager->read();


        $datas = array();
        $datas['id'] = $id;
        $datas['movies'] = $movies;
        $datas['salles'] = $rooms;
        $datas['cinemas'] = $cinemas;
        $datas['date_screaning'] = $movieSession[0]['date_screaning'];
        $datas['room_id'] = $room_id;
        $datas['movie_id'] = $movie_id;


        $form = $this->createForm(EditSeanceType::class, $datas);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $movieReservation = new Room();
            $roomManager = new RoomManager(Room::class, 'room');

            $movieReservation = new movieReservation();
            $movieReservationManager = new movieReservationManager(movieReservation::class, 'movie_reservation');

            $movieSession = new MovieSession();
            $movieSessionManager = new movieSessionManager(MovieSession::class, 'movie_session');
            
            $roomTmp = $roomManager->read($_POST[$form->getName().'_room']);

            $nbrplacereserved = $movieReservationManager->getNbrPlaceReserved($id);

            $nbrplacerest = $roomTmp[0]->getNbr_places() - $nbrplacereserved;

            $movieSession->setDate_screaning($_POST[$form->getName().'_date']);
            $movieSession->setMovie($_POST[$form->getName().'_movie']);
            $movieSession->setRoom($_POST[$form->getName().'_room']);
            $movieSession->setNbr_place_rest($nbrplacerest);
            $movieSession->setId($id);
            
            $movieSessionManager->save($movieSession);

            $message = 'Séance modifiée avec succès';
            header('Location: /seances?message=' . urlencode($message));

        }

        $this->render("edit-seance", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
            ]);
    }
}