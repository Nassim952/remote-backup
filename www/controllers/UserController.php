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
        
        $configForm = $registerForm->getForm();

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
                $user->setStatut(1);

                $userManager->save($user);
                
                // on vérifie si le save a bien été fait et on envoie un mail
                $users = $userManager->read();
                $userCheck = $userManager->checkSave($this->email, $this->password, $users);
                if($userCheck){
                    $mail = new Mailer();
                    $result = $mail->sendVerifAuth($_POST['email'], $token, $_POST['firstname']);
                    if(!$result){
                        echo "<script>alert('Confirmer votre adresse en cliquant sur le lien envoyé par mail !');</script>";
                    }else {
                        print_r($result);
                    }
                }
            }
        }
    }

    public function accountActivationAction($token)
    {
        $user = (new UserManager(User::class,'user'))->getUserByToken($token);
        if ($user) {
            reset($user)->setVerified(1);
            (new UserManager(User::class,'user'))->save(reset($user));
            new View('mail-check', 'front');
        }else{
            echo "<script>alert('user inconnu');</script>";
        }
    }

    public function mailNotCheckedAction(){
        new View('mail-not-checked', 'front');
    }

    public function loginAction(){
        $form = $this->createForm(LoginType::class);
        $form->handle();
        
        $this->render("login", "account", [
            "configFormUser" => $form
        ]);

        if($form->isSubmit() && $form->isValid())
        {
            $userManager = new UserManager(User::class,'user');
            $users = $userManager->read();

            $userChecked = $userManager->checkUserInDb($_POST['Login_username'], $_POST['Login_pwd'], $users);
            if($userChecked)
            {
                if($userChecked->getVerified() == 1){
                    $_SESSION['user'] = $userChecked;
                    
                    $view = Helpers::getUrl("Dashboard", "dashboard");
                    $newUrl = trim($view, "/");
                    echo "<meta http-equiv='refresh' content='0;url='.$newUrl />";
                }else{
                    $view = Helpers::getUrl("User", "mailNotChecked");
                    $newUrl = trim($view, "/");
                    echo "<meta http-equiv='refresh' content='0;url='.$newUrl />";
                }
            }
        }
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
	
    public function registerAction()
    {
        $form = $this->createForm(RegisterType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        { 
            $userManager = new UserManager(User::class,'user');

            // on peuple l'objet user et on save
            $token = bin2hex(random_bytes(50)); 
            $user = new User;
            $user->setLastname($_POST['Register_lastname']);
            $user->setFirstname($_POST['Register_firstname']);
            $user->setEmail($_POST['Register_email']);
            $user->setPassword($_POST['Register_pwd']);
            $user->setAllow('customer');
            $user->setStatut(1);
            $user->setToken($token);

            $userManager->save($user);

            // on vérifie que le save a bien été fait et on envoie le mail
            $users = $userManager->read();
            $userCheck = $userManager->checkSave($this->email, $this->password, $users);
            if($userCheck){
                $mail = new Mailer();
                $result = $mail->sendVerifAuth($_POST['email'], $token, $_POST['firstname']);
                if(!$result){
                    echo "<script>alert('Confirmer votre adresse en cliquant sur le lien envoyé par mail !');</script>";
                }else {
                    print_r($result);
                }
            }
            
        }

        $this->render("register", "account", [
            "configFormUser" => $form
        ]);
    }
    
    public function buildPage()
    {

    }
}
