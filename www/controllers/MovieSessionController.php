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
            
            $movieSessionManager->save($movieSession);

            $message = 'Séance ajouté avec succès';
            header('Location: /seances?message=' . urlencode($message));

        }

        $this->render("add-seance", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
        ]);
    }
}