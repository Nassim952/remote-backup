<?php

namespace cms\controllers;

use cms\core\Controller;
use cms\managers\PageManager;
use cms\models\Page;
use cms\core\View;


class PageController extends Controller
{
    private $pages;
    
    // page action callling the view
    public function pageAction(){
        $pageManager = new PageManager(Page::class, 'Page');
        $pages = $pageManager->read();
        
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("page", "back", ['pages'=> $pages ]);
    }

    //deleting data in the database




    public function buildPageAction($params)
    {
        $pageManager = new PageManager();
        $page = $pageManager->find($params['id']);

        if (!$page) {
            throw new NotFoundException("page not found");
        }

        $this->render("default", "front", [
            "page" => $page
        ]);
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

    public function forgetPwdAction()
    {
		$myView = new View("forgetPwd", "account");
    } 

   


}