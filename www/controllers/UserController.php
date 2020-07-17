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

    // public function __construct()
    // {
    //     isset($_POST['email']) ? $this->email = $_POST['email'] : null;
    //     isset($_POST['password']) ? $this->password = $_POST['password'] : null;
    // }

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
        $userManager = new UserManager(User::class,'user');
        $users = $userManager->read();

        $this->render("users", "back", ['users' => $users]);
    }

    public function editUserAction($id){
        $userManager = new UserManager(User::class,'user');
        $userId = $userManager->read($id);

        $this->render("edit-user", "back", ['myUser' => $userId]);

        if( $_SERVER["REQUEST_METHOD"] == "POST"){
            $user = new User();
            
            $user->setId($id);
            $user->setLastname($_POST['lastname']);
            $user->setFirstname($_POST['firstname']);
            $user->setStatut($_POST['statut']);
            $user->setAllow($_POST['allow']);
            $user->setPassword(reset($userId)->getPassword());
            $user->setEmail(reset($userId)->getEmail());

            if(!empty($_FILES['image_profile']['name'])){
                $data_image = $this->uploadImage();
                if(isset($data_image) && !empty($data_image['image'])){
                    $user->setImage_profile($data_image['image']);
                }
            }else{
                $user->setImage_profile(reset($userId)->getImage_profile());
            }

            $userManager->save($user);

            echo "<script>alert('User modifié avec succès');</script>";
        }
    }

    public function deleteUserAction($id){
        new View('confirm-page','back');

        $userManager = new UserManager(User::class,'user');
        $userManager->delete($id);

        echo "<script>alert('User supprimé avec succès');</script>";
    }

    public function uploadImage()
    {
        if(isset($_FILES['image_profile'])){
            $output_dir = "public/images";//Path for file upload
            $RandomNum = time();
            $ImageName = str_replace(' ','-',strtolower($_FILES['image_profile']['name']));
            $ImageType = $_FILES['image_profile']['type']; //"image/png", image/jpeg etc.
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.','',$ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
            $ret[$NewImageName]= $output_dir.$NewImageName;
            move_uploaded_file($_FILES["image_profile"]["tmp_name"],$output_dir."/".$NewImageName );
            $data = array(
            'image' =>$NewImageName
            );
            return $data;
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
            
            $userManager = new UserManager(User::class,'user');
            $users = $userManager->read();
            
            $userCheck = $userManager->checkUserInDb($_POST[$form->getName().'_email'] ,$_POST[$form->getName().'_password'], $users);
            // var_dump($userCheck);
            if($userCheck){
                if($userCheck->getVerified() == 1){
                    session_start();
                    $_SESSION['user'] = $userCheck;
                    $view = Helpers::getUrl("Dashboard", "dashboard");
                    $newUrl = trim($view, "/");
                    header("Location: " . $newUrl);
                }else{
                    $view = Helpers::getUrl("User", "mailNotChecked");
                    $newUrl = trim($view, "/");
                    header("Location: " . $newUrl);
                }
            }
            else
            {
                $this->render("login", "account", [
                    "configFormUser" => $form
                ]);
            }
        }
        else
        {
            $this->render("login", "account", [
                "configFormUser" => $form
            ]);
        }
    }
	
    public function registerAction()
    {
        $form = $this->createForm(RegisterType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        { 
            $userManager = new UserManager(User::class,'user');
           
            if (!$userManager->findBy(["email"=>$_POST[$form->getName().'_email']]))
            {
                $token = bin2hex(random_bytes(50));          
                $user = new User;
                $user->setLastname($_POST[$form->getName().'_lastname']);
                $user->setFirstname($_POST[$form->getName().'_firstname']);
                $user->setEmail($_POST[$form->getName().'_email']);
                $user->setPassword($_POST[$form->getName().'_password']);
                $user->setAllow('customer');
                $user->setToken($token);
                $user->setStatut(1);

                $userManager->save($user);
                // on vérifie si le save a bien été fait et on envoie un mail
                $users = $userManager->read();
                $userCheck = $userManager->checkSave($_POST[$form->getName().'_email'], $_POST[$form->getName().'_password'], $users);
                if($userCheck){
                    $mail = new Mailer();
                    $result = $mail->sendVerifAuth($_POST[$form->getName().'_email'], $token, $_POST[$form->getName().'_firstname']);
                    if(!$result){
                        echo "<script>alert('Confirmer votre adresse en cliquant sur le lien envoyé par mail !');</script>";
                    }else {
                        print_r($result);
                    }
                }
            } else {
                $this->render("register", "account", [
                    "configFormUser" => $form
                ]);
            }
        }
        else
        {
            $this->render("register", "account", [
                "configFormUser" => $form
            ]);
        }   
    }
    
    public function buildPage()
    {

    }
}
