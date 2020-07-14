<?php

namespace cms\controllers;

use cms\models\User;
use cms\core\View;
use cms\core\Mailer;
use cms\core\Helpers;
use cms\managers\UserManager;
use cms\managers\MovieManager;
use cms\core\NotFoundException;
use cms\core\Controller;
use cms\core\Validator;
use cms\forms\LoginType;
use cms\forms\RegisterType;

class UserController extends Controller{

    private $email;
    private $password;

    public function __construct()
    {
        isset($_POST['email']) ? $this->email = $_POST['email'] : null;
        isset($_POST['password']) ? $this->password = $_POST['password'] : null;
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
        $userManager = new UserManager(User::class,'user');

        $registerForm  = new RegisterType();
        
        $configForm = $registerForm->initForm();
        
        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            //Vérification des champs
            $errors = Validator::formValidate($configForm, $_POST);
            if(!empty($errors)){
                print_r($errors);
            }elseif(empty($errors)){  
                $token = bin2hex(random_bytes(50));          
                $user = new User;
                $user->setLastname($_POST['lastname']);
                $user->setFirstname($_POST['firstname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setAllow('customer');
                $user->setToken($token);
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

        $userManager = new UserManager(User::class,'user');
        $users = $userManager->read();
        
        $userCheck = $userManager->checkLogin($this->email, $this->password, $users);
        var_dump($userCheck);
        if($userCheck){
            $view = Helpers::getUrl("Dashboard", "dashboard");
            $newUrl = trim($view, "/");
            header("Location: " . $newUrl);
        }
    }

    public function deleteMovieAction($id){
        $userManager = new MovieManager(Movie::class, 'movie');
        $userManager->deleteMovie($id);
    } 

    public function forgetPwdAction(){
        new View("forgetPwd", "account");
    }

	public function getUserAction($params)
    {
        $userManager = new UserManager('user', 'user');

        $user = $userManager->find($params['id']);

        if(!$user) {
            throw new NotFoundException("User not found");
		}
        return $user;
    }

	public function loginAction()
    {
        $form = $this->createForm(LoginType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $userManager = new UserManager('user','user');
            $users = $userManager->read();
            
            $userCheck = $userManager->checkLogin($this->email, $this->password, $users);
            if($userCheck){
                $view = Helpers::getUrl("Dashboard", "dashboard");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            }  
        }

        $this->render("login", "account", [
            "configFormUser" => $form
        ]);
    }
	
    public function registerAction()
    {
        $form = $this->createForm(RegisterType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        { 
            $userManager = new UserManager('user','user');
           
            if (!$userManager->read() || empty($userManager->read()))
            {
                $user = new User;
                $user->setLogin($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->setAllow('customer');
                $user->setStatut(1);
                $user->setToken(uniqid());
                $userManager->save($user);
            }
           
        }

        $this->render("register", "account", [
            "configFormUser" => $form
        ]);
    }

    public function accountAcitivation()
    {
        if ($_POST['token']) {
            $user = (new UserManager('user','user'))->getUserByToken($_POST['token']);
            if ($user) {
                $user->setVerified(true);
                (new UserManager('user','user'))->save($user);
            }
        }
    }
    
    public function buildPage()
    {

    }
}
