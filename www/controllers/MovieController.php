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

            $data_image = $this->uploadImage();
            if(isset($data_image) && !empty($data_image['image'])){
                $movie->setImage_poster($data_image['image']);
            }
            
            $movieManager->save($movie);

            echo "<script>alert('Film ajouté avec succès');</script>";

        }

        $this->render("add-film", "back", [
            "configFormUser" => $form
        ]);

    }

    public function uploadImage()
    {
        if(isset($_FILES['Movie_image'])){
            $output_dir = "public/images";//Path for file upload
            $RandomNum = time();
            $ImageName = str_replace(' ','-',strtolower($_FILES['Movie_image']['name']));
            $ImageType = $_FILES['Movie_image']['type']; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName]= $output_dir.$NewImageName;
            move_uploaded_file($_FILES["Movie_image"]["tmp_name"],$output_dir."/".$NewImageName );
            $data = array(
            'image' =>$NewImageName
            );
            return $data;
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
        $movieId = $movieManager->read($id);

        $this->render('edit-movie','back', ['movie' => $movieId]);

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
            
            if(!empty($_FILES['Movie_image']['name'])){
                $data_image = $this->uploadImage();
                if(isset($data_image) && !empty($data_image['image'])){
                    $movie->setImage_poster($data_image['image']);
                }
            }else{
                $movie->setImage_poster(reset($movieId)->getImage_poster());
            }
            
            $movieManager->save($movie);

            echo "<script>alert('Film modifié avec succès');</script>";
        }
    } 
}