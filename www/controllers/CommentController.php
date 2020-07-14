<?php
namespace cms\controllers;

use cms\core\Controller;
use cms\managers\CommentManager;
use cms\models\Comment;
use cms\core\View;

class CommentController extends Controller{
    private $comments;

    
    public function commentAction(){
        $commentManager = new CommentManager(Comment::class, 'Comment');
        $comments = $commentManager->read();
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("comment", "back", ['comments'=> $comments ]);

    }

    public function addCommentAction(){
        new View('add-comment');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = new Comment();

            $comment->setComment($_POST['comment']);
            $comment->setTarget($_POST['target']);
            $comment->setAuthor($_POST['author']);
            $comment->setPostDate($_POST['date']);

            $commentManager = new commentManager(Comment::class,'comment');
            $commentManager->save($comment);
        }
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


    public function editCommentAction(){
        $commentManager = new CommentManager(Comment::class,'comment');
        $comments = $commentManager->read();

        $this->render("edit-comment", "back", ['comments' => $comments]);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $comment = $commentManager->findBy(['id' => $_POST['id']]);

            $this->render('edit-comment-id','empty', ['comment' => $comment]);
        }
    }

   
}
