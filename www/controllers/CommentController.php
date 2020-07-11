<?php
namespace cms\controllers;

use cms\core\Controller;
use cms\managers\CommentManager;
use cms\models\Comment;

class CommentController extends Controller{
    private $comments;

    
    public function commentAction(){
        $commentManager = new CommentManager(Comment::class, 'Comment');
        $comments = $commentManager->read();
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("comment", "back", ['comments'=> $comments ]);

    }

    //on testing
    public function deleteCommentAction(){

        $commentManager = new CommentManager(Comment::class, 'Comment');
        $comments = $commentManager->read();
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("comment", "back", ['comments'=> $comments ]);

        if ( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];

            $commentManager = new CommentManager(Comment::class, 'comment');
            $commentManager->delete($id);
            // refresh the page after delete
            echo("<meta http-equiv='refresh' content='1'>");
        }
       
    }
   
}
