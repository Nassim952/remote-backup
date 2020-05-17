<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;

class UserController
{
    private $login;
    private $password;

    // public function __construct()
    // {
    //     isset($_POST['login']) ? $this->login = $_POST['login'] : null;
    //     isset($_POST['login']) ? $this->password = $_POST['password'] : null;
    // }
        
    public function landingAction(){
        new View("landing-page","front");
    }

    public function dashboardAction(){
        new View("dashboard","back");
    }

    public function statAction(){
        new View("stat","back");
    }

    public function usersAction(){
        new View("users","back");
    }

    public function signupAction(){
        new View("signup","front");
    }

    public function signinAction(){
        new View("signin","front");
    }

    public function loginAction()
    {
        new View("login","back");

        $user = new User();

        $user->setLogin($this->login);
        $user->setPassword($this->password);

        $user->checkLogin();

        if ($user == true) {
            $typeUser = $user->getTypeUser();

            if ($typeUser == 1) {
                $view = Helpers::getUrl("User", "dashboard");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } elseif ($typeUser == 2) {
                $view = Helpers::getUrl("#", "#");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } elseif ($typeUser == 3) {
                $view = Helpers::getUrl("#", "#");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } elseif ($typeUser == 4) {
                $view = Helpers::getUrl("#","#");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            }
        }
    }
}
