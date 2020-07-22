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

            $data_image = $this->uploadImage();
            if(isset($data_image) && !empty($data_image['image'])){
                $cinema->setImage_url($data_image['image']);
            }

            $cinemaManager = new cinemaManager(Cinema::class,'cinema');
            $cinemaManager->save($cinema);

            echo "<script>alert('Cinema ajouté avec succès');</script>";
        }
    }

    public function uploadImage()
    {
        if(isset($_FILES['image_url'])){
            $output_dir = "public/images";//Path for file upload
            $RandomNum = time();
            $ImageName = str_replace(' ','-',strtolower($_FILES['image_url']['name']));
            $ImageType = $_FILES['image_url']['type']; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName]= $output_dir.$NewImageName;
            move_uploaded_file($_FILES["image_url"]["tmp_name"],$output_dir."/".$NewImageName );
            $data = array(
            'image' =>$NewImageName
            );
            return $data;
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
        $cinemaId = $cinemaManager->read($id);

        $this->render("edit-cinema", "back", ['myCinema' => $cinemaId]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $cinema = new Cinema();

            $cinema->setId($id);
            $cinema->setName($_POST['name']);
            $cinema->setPlace($_POST['city']);
            $cinema->setNumber_rooms($_POST['number_rooms']);
            
            if(!empty($_FILES['image_url']['name'])){
                $data_image = $this->uploadImage();
                if(isset($data_image) && !empty($data_image['image'])){
                    $cinema->setImage_url($data_image['image']);
                }
            }else{
                $cinema->setImage_url(reset($cinemaId)->getImage_url());
            }

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