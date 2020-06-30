<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;
use cms\managers\UserManager;

class UserController{

    private $login;
    private $password;

    // public function __construct()
    // {
    //     isset($_POST['login']) ? $this->login = $_POST['login'] : null;
    //     isset($_POST['login']) ? $this->password = $_POST['password'] : null;
    // }

    public function dashboardAction(){
        new View("dashboard","back");
    }

	public function landingAction(){
        new View("landing-page","front");
    }

    public function homeAction(){
        new View("home","empty");
    }

    public function templateAction(){
        new View("template-create","empty");
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
        new View("signin", "front");
    }

    public function forgetPwdAction(){
        new View("forgetPwd", "account");
    }


	public function getUserAction($params)
    {
        $userManager = new UserManager();

        $user = $userManager->find($params['id']);

        if(!$user) {
            throw new NotFoundException("User not found");
		}
        return $user;
    }

	public function loginAction()
    {
        new View("login","back");

        $user = new User();

        $user->setLogin($this->login);
        $user->setPassword($this->password);

        $user->checkLogin();

        if ($user) {
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
	
	public function registerAction(){

		$user = new Users();
		
		$user->setFirstName("bob");
		$user->setLastName("berry");
		$user->setEmail("boberry@gmail.com");
		$user->setPwd("anonymous");
		$user->setStatus(0);

		// $user->save();
		// $user->count();

		$myView = new View("register", "account");
	}
}
