<?php
namespace cms\controllers;

use cms\core\Controller;
use cms\managers\CommentManager;
use cms\models\Comment;
use cms\core\View;
use cms\managers\UserManager;

class CommentController extends Controller{
    private $comments;

    
    public function commentAction(){
        $commentManager = new CommentManager(Comment::class, 'Comment');
        $comments = $commentManager->read();
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("comment", "back", ['comments'=> $comments ]);

    }

    public function showCommentAction($id){
        $commentManager = new commentManager(Comment::class,'comment');
        $comment = $commentManager->read($id);
        //envoyer l'author
        $userManager = new userManager(User::class,'user');
        $userComment = $userManager->read(reset($comment)->getUser_id());

        $this->render("show-comment", "back", [
            'myComment' => $comment,
            'userComment'=> $userComment
            ]);

    }

    public function addCommentAction(){
        new View('movies');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = new Comment();

            $comment->setComment($_POST['comment']);
            $comment->setTarget($_POST['target']);

            $comment->setPost_date($_POST['date']);

            $commentManager = new commentManager(Comment::class,'comment');
            $commentManager->save($comment);
        }
    }


    //on testing
    public function deleteCommentAction($id){

        new View('confirm-page','back');

        $commentManager = new CommentManager(Comment::class,'comment');
        $commentManager->delete($id);

        echo "<script>alert('Commentaire supprimé avec succès');</script>";
    }


    public function editCommentAction($id){
        $commentManager = new commentManager(comment::class,'comment');
        $comment = $commentManager->read($id); 

        if( $_SERVER["REQUEST_METHOD"] == "POST"){

            $comment = new comment();

            $comment->setId($id);
            $comment->setComment($_POST['comment']);
            $comment->setPost_date($_POST['date']);
            $comment->setUser_id($_POST['user_id']);

            $commentManager->save($comment);

            echo "<script>alert('Film modifié avec succès');</script>";
    
        }
        
        $this->render('edit-comment','back', ['myComment' => $comment]);
    }
   
}
