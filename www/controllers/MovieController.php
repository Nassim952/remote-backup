<?php

namespace cms\controllers;

use cms\managers\CinemaManager;
use cms\controllers\DashboardController;
use cms\core\Constraints\NoSpecialChar;
use cms\managers\MovieManager;
use cms\models\Comment;
use cms\core\Controller;
use cms\models\Movie;
use cms\forms\AddFilmType;
use cms\core\Helpers;
use cms\core\View;
use cms\managers\CommentManager;
use cms\managers\UserManager;
use \DateTime;

class MovieController extends Controller
{
    public function showMovieAction($id){
        
        // reading movie table
        $movieManager = new MovieManager(Movie::class,'movie');
        $movie = $movieManager->read($id);
        //reading comment table
        $commentManager = new commentManager(Comment::class,'comment');

        $commentsOfMovie = $commentManager->findBy(['target' => $id]);

        $userManager = new userManager(User::class,'user');

        //getting the user id
        $usersComment = [];
        foreach($commentsOfMovie as $commentOfMovie){
            $usersComment = array_merge($usersComment, $userManager->read($commentOfMovie->getUser_id()));
        }
        

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = new Comment();
            $checkSpecialChar = new NoSpecialChar();

            //if $comment =! empty saving the data in comment table
            if ($checkSpecialChar->isValid($_POST['content']) != null && isset($_POST['content'])){
                $comment->setComment($_POST['content']);
                $comment->setTarget($id);
                $comment->setUser_id($_POST['id_user']);
                $commentManager->save($comment);
            }else{
                Helpers::alert_popup(array_shift($checkSpecialChar->getErrors()));
            }
        }
       // session_start();
        $comment = $commentManager->getFilmComments($id);
        $this->render('show-movie', 'back', [
            'myMovie' => $movie,
            'usersComment'=> $usersComment,
            'commentsOfMovie' =>$commentsOfMovie
        ]);
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
            $movie->setRelease_date($_POST[$form->getName().'_date']);
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

            $message = 'Film ajouté avec succès';
            header('Location: /dashboard?message=' . urlencode($message));

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

        $message = 'Film supprimé avec succès';
        header('Location: /delete-movie?message=' . urlencode($message));
    }   

    public function editMovieAction($id){
        $movieManager = new MovieManager(Movie::class,'movie');
        $movieId = $movieManager->read($id);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $movie = new Movie();

            $movie->setId($id);
            $movie->setTitle($_POST['title']);
            $movie->setRelease_date($_POST['date']);
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
        }

        $this->render('edit-movie','back', ['movie' => $movieId]);
        
    } 

    public function searchMovieAction()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $checkSpecialChar = new NoSpecialChar();
            $search = $_POST['name_movie'].'%';
            
            if($checkSpecialChar->isValid($search)){
                $movieManager = new MovieManager(Movie::class, 'movie');
                $result = $movieManager->findBy(['title'=>$search]);
                $this->render('show-research', 'front-cms', ['searched'=>$result]);
            }else{
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
            
        } else {
            echo "<script>alert('Entrez un film dans la barre de recherche');</script>";
        }
    }

    public function showSearchedAction($id){
        
        // reading movie table
        $movieManager = new MovieManager(Movie::class,'movie');
        $movie = $movieManager->read($id);
        //reading comment table
        $commentManager = new commentManager(Comment::class,'comment');

        $commentsOfMovie = $commentManager->findBy(['target' => $id]);

        $userManager = new userManager(User::class,'user');

        //getting the user id
        $usersComment = [];
        foreach($commentsOfMovie as $commentOfMovie){
            $usersComment = array_merge($usersComment, $userManager->read($commentOfMovie->getUser_id()));
        }
        

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = new Comment();
            $checkSpecialChar = new NoSpecialChar();

            //if $comment =! empty saving the data in comment table
            if ($checkSpecialChar->isValid($_POST['content']) != null && isset($_POST['content'])){
                $comment->setComment($_POST['content']);
                $comment->setTarget($id);
                $comment->setUser_id($_POST['id_user']);
                $commentManager->save($comment);
            }else{
                Helpers::alert_popup(array_shift($checkSpecialChar->getErrors()));
            }
        }
       // session_start();
        $comment = $commentManager->getFilmComments($id);
        $this->render('show-searched', 'front-cms', [
            'myMovie' => $movie,
            'usersComment'=> $usersComment,
            'commentsOfMovie' =>$commentsOfMovie
        ]);
    }
}