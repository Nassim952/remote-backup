<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Helpers;
use cms\managers\UserManager;
use cms\core\NotFoundException;
use cms\core\Controller;
use cms\core\Request;
use cms\forms\RegisterType;
use cms\core\Validator;

class UserController extends Controller{

    private $email;
    private $password;

    public function __construct()
    {
        isset($_POST['email']) ? $this->email = $_POST['email'] : null;
        isset($_POST['password']) ? $this->password = $_POST['password'] : null;
    }

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
        $userManager = new UserManager('user','user');

        $configForm  = RegisterType::getForm();

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            //Vérification des champs
            $errors = Validator::formValidate( $configForm, $_POST );
            if(!empty($errors)){
                print_r($errors);
            }elseif(empty($errors)){            
                $user = new User;
                $user->setLogin($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setAllow('customer');
                $user->setStatut(1);
                $userManager->save($user);

                // on vérifie si le save a bien été fait et on redirige le user
                $users = $userManager->read();
                $userCheck = $userManager->checkLogin($this->email, $this->password, $users);
                if($userCheck){
                    $view = Helpers::getUrl("Dashboard", "dashboard");
                    $newUrl = trim($view, "/");
                    header("Location: " . $newUrl);
                }
            }
        }
        
    }

    public function signinAction(){
        new View('signin','front');

        $userManager = new UserManager('user','user');
        $users = $userManager->read();
        
        $userCheck = $userManager->checkLogin($this->email, $this->password, $users);
        if($userCheck){
            $view = Helpers::getUrl("Dashboard", "dashboard");
            $newUrl = trim($view, "/");
            header("Location: " . $newUrl);
        }
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
