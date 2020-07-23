<!-- INCLUDE VIEWS HERE -->
<?php 
    use cms\managers\UserManager;
    use cms\core\Helpers;
    session_start();
    (!isset($_SESSION['userId'])) ? header('Location: /session-not-start') : '';
    if(isset($_SESSION['userId'])){
        $current_user = (new UserManager(User::class, 'user'))->read($_SESSION['userId']);
        if(reset($current_user)->getStatut() == 0){
            header('Location: /no-permission');
        }
    }
?>
<?php include "views/".$this->view.".php" ?>
<!-- END INCLUDE VIEWS -->