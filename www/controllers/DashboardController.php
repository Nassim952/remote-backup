<?php

namespace cms\controllers;

use cms\managers\MovieManager;
use cms\managers\PageManager;
use cms\managers\UserManager;

use cms\forms\AddPageType;
use cms\forms\AddFilmType;

use cms\core\Controller;
use cms\core\View;
use cms\core\Helpers;
use cms\core\Validator;

use cms\models\Movie;
use cms\models\Page;
use cms\models\User;

class DashboardController extends Controller
{
    public function dashboardAction(){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movies = $movieManager->read();

        $this->render("dashboard", "back", ['movies' => $movies]);
    }

    public function usersAction(){
        $userManager = new UserManager(User::class,'user');
        $users = $userManager->read();

        $this->render("users", "back", ['users' => $users]);
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

    public function uploadImage(){

        if(isset($_POST['AddFilm_add-film']))
        {
            $output_dir = "public/images";//Path for file upload
            $RandomNum = time();
            $ImageName = str_replace(' ','-',strtolower($_FILES['AddFilm_image']['name']));
            $ImageType = $_FILES['AddFilm_image']['type']; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName]= $output_dir.$NewImageName;
            move_uploaded_file($_FILES["AddFilm_image"]["tmp_name"],$output_dir."/".$NewImageName );
            $data = array(
            'image' =>$NewImageName
            );
            return $data;
        }
        return FALSE;
    }

    public function addPageAction()
    {
        $form = $this->createForm(AddPageType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $pageManager = new PageManager(Page::class, 'page');
            $page = new Page();

            $page->setTitle($_POST[$form->getName().'_title']);
            $page->setTheme($_POST[$form->getName().'_theme']);
            $page->setGabarit($_POST[$form->getName().'_gabarit']);
            $page->setFont($_POST[$form->getName().'_font']);
            $page->setFontColor($_POST[$form->getName().'_font-color']);

            $pageManager->save($page);

            echo "<script>alert('Page crée avec succès');</script>";
        }

        $this->render("addpage", "back", [
            "configFormUser" => $form
        ]);
    }

    public function statAction(){
        new View("stat","back");
    }

    public function horrairesAction(){
        new View("horraires","back");
    }
}