<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;
use cms\managers\UserManager;

class UserController extends Controller{

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

    public function addFilmAction()
    {
        new View("addfilm","back");
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

        $registerType = new LoginType();

        if ( $_SERVER["REQUEST_METHOD"] == "POST") {
            //Vérification des champs
            $this->render("register", "account", [
                "form" => $registerType,
                "errors" => Validator::formLoginValidate( $registerType, $_POST )
            ]);
        } else {
            $this->render("register", "account", [
                "form" => $registerType
            ]);
        }
      
	}
	
    public function registerAction()
    {
        $registerType = new RegisterType();

        if ( $_SERVER["REQUEST_METHOD"] == "POST") {
            //Vérification des champs
            $this->render("register", "account", [
                "form" => $registerType,
                "errors" => Validator::formRegisterValidate( $registerType, $_POST )
            ]);
        } else {
            $this->render("register", "account", [
                "form" => $registerType
            ]);
        }
    }
    
    public function buildPage()
    {

    }


	public function forgetPwdAction(){
		$myView = new View("forgetPwd", "account");
	}
}
