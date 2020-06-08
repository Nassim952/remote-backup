<?php

namespace cms\controllers;

use cms\models\Users;
use cms\core\View;

class UserController{

	public function landingAction(){
        new View("landing-page","front");
    }

    public function dashboardAction(){
        new View("dashboard","back");
    }

    public function statAction(){
        new View("stat","back");
    }

    public function signupAction(){
        new View("signup","front");
    }

    public function signinAction(){
        new View("signin","front");
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

		$configForm = users::getRegisterForm();

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$error = Validator::formValidate($configForm, $_POST);
		}

		$user = new Users();
		
		$user->setFirstName("bob");
		$user->setLastName("berry");
		$user->setEmail("boberry@gmail.com");
		$user->setPwd("anonymous");
		$user->setStatus(0);

		$user->save();
		// $user->count();

		$myView = new View("register", "account");
		$myView->assign("configForm",$configForm);
	}


	public function forgetPwdAction(){
		$myView = new View("forgetPwd", "account");
	}
}