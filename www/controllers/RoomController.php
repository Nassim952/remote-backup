<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\managers\RoomManager;
use cms\core\Controller;
use cms\models\Cinema;
use cms\models\Room;
use cms\forms\AddRoomType;
use cms\forms\EditRoomType;
use cms\core\Helpers;
use cms\core\View;


class RoomController extends Controller
{
    public function roomAction(){
        $roomManager = new roomManager(Room::class,'room');
        $rooms = $roomManager->read();

        $cinemaManager = new cinemaManager(Cinema::class,'cinema');
        $cinemas = $cinemaManager->read();

        foreach($rooms as $room) {
            foreach($cinemas as $cinema) {
                if($room->getCinema_id() == $cinema->getId()){
                    $datas[$cinema->getId()]['cinema_name'] = $cinema->getName();
                    $datas[$cinema->getId()]['cinema_id'] = $cinema->getId();
                    $datas[$cinema->getId()]['rooms'][$room->getId()]['name_room'] = $room->getName_room(); 
                    $datas[$cinema->getId()]['rooms'][$room->getId()]['id'] = $room->getId(); 
                    $datas[$cinema->getId()]['rooms'][$room->getId()]['nbr_places'] = $room->getNbr_places(); 
                }
            }
        }

        $this->render("salles", "back", ['datas' => $datas]);
    }

    public function addRoomAction(){
        $datas = array();

        $cinemaManager = new cinemaManager();
        $cinemas = $cinemaManager->read();

        $datas['cinemas'] = $cinemas;

        $form = $this->createForm(AddRoomType::class, $datas);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $room = new Room();
            $roomManager = new RoomManager(Room::class, 'room');

            $cinema = new Cinema();
            $cinemaManager = new cinemaManager(CinemaSession::class, 'cinema');
            $cinemaTmp = $cinemaManager->read($_POST[$form->getName().'_cinema_id']);

            $nbrRoom = $cinemaTmp[0]->getNumber_rooms();

            $room->setName_room($_POST[$form->getName().'_name_room']);
            $room->setCinema_id($_POST[$form->getName().'_cinema_id']);
            $room->setNbr_places($_POST[$form->getName().'_nbr_places']);
            
            $roomManager->save($room);
            
            $cinema->setId($_POST[$form->getName().'_cinema_id']);
            $cinema->setName($cinemaTmp[0]->getName());
            $cinema->setPlace($cinemaTmp[0]->getPlace());
            $cinema->setNumber_rooms($cinemaTmp[0]->getNumber_rooms() + 1);
            $cinema->setImage_url($cinemaTmp[0]->getImage_url());


            $cinemaManager->save($cinema);

            $message = 'Salle ajoutée avec succès';
            header('Location: /salles?message=' . urlencode($message));

        }

        $this->render("add-salle", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
        ]);
    }

    public function deleteRoomAction($datas){
        $id = explode('-', $datas)[0];
        $cinema_id = explode('-', $datas)[1];
        
        if(isset($_POST['delete']) && $_POST['delete'] === 'Oui') {
            $roomManager = new RoomManager(Room::class, 'room');
            $roomManager->deleteRoom($id);

            $cinema = new Cinema();
            $cinemaManager = new cinemaManager(Cinema::class, 'cinema');
            
            $cinemaTmp = $cinemaManager->read($cinema_id);

            $cinema->setId($cinema_id);
            $cinema->setName($cinemaTmp[0]->getName());
            $cinema->setPlace($cinemaTmp[0]->getPlace());
            $cinema->setNumber_rooms($cinemaTmp[0]->getNumber_rooms() -1);
            $cinema->setImage_url($cinemaTmp[0]->getImage_url());

            $cinemaManager->save($cinema);

            $message = 'Votre salle a été supprimée avec succès!';
            header('Location: /salles?message=' . urlencode($message));
        } else if(isset($_POST['delete']) && $_POST['delete'] === 'Non') {
            $message = 'Votre salle n\'a pas été supprimée';
            header('Location: /salles?message=' . urlencode($message));
        } else {
            $this->render("delete-salle", "back", [
                "datas" => $id 
            ]);
        }        
    }

    public function editRoomAction($datas){
        $id = explode('-', $datas)[0];
        $cinema_id = explode('-', $datas)[1];

        $roomManager = new roomManager(Room::class,'room');
        $room = $roomManager->read($id);

        $datas = array();
        $datas['room'] = $room;

        $cinemaManager = new cinemaManager();
        $cinemas = $cinemaManager->read();

        $datas['cinemas'] = $cinemas;

        $form = $this->createForm(EditRoomType::class, $datas);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {
            $room = new Room();
            $roomManager = new RoomManager(Room::class, 'room');

            $room->setId($_POST[$form->getName().'_id']);
            $room->setName_room($_POST[$form->getName().'_name_room']);
            $room->setCinema_id($_POST[$form->getName().'_cinema_id']);
            $room->setNbr_places($_POST[$form->getName().'_nbr_places']);
            
            $roomManager->save($room);

            $message = 'Salle modifiée avec succès';
            header('Location: /salles?message=' . urlencode($message));
        }

        $this->render("edit-salle", "back", [
            "configFormUser" => $form,
            "datas" => $datas 
            ]);
    }

    public function showRoomAction($id){
        $roomManager = new roomManager(Room::class,'room');
        $room = $roomManager->read($id);

        $this->render("show-room", "back", ['myRoom' => $room]);
    }

    public function sallesAction(){
        $roomManager = new roomManager(Movie::class,'movie');
        $room_rooms = $roomManager->read();

        $this->render("salles", "back", ['room_rooms' => $room_rooms]);
    }
}