<?php
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
        new view("landing-page","front");
    }

    public function dashboardAction(){
        new view("dashboard","back");
    }

    public function statAction(){
        new view("statistiques","back");
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
                $view = helpers::getUrl("User", "dashboard");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } elseif ($typeUser == 2) {
                $view = helpers::getUrl("#", "#");
                $newUrl = trim($view, "/");
                header("Location: " . $newUrl);
            } elseif ($typeUser == 3) {
                $view = helpers::getUrl("#", "#");
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
