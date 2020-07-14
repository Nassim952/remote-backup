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

    public function addPageAction(){
        new View('add-page');
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $page = new Page();

            $page->setTitle($_POST['title']);
            $page->setGabarit($_POST['gabarit']);
            // replace by curentdate
            $page->setDate($_POST['date']);
            $page->setTheme($_POST['theme']);

            $pageManager = new pageManager(Page::class,'page');
            $pageManager->save($page);
        }
    }


    //deleting data in the database
    public function deletepageAction(){
        $pageManager = new pageManager(Page::class,'page');
        $pages = $pageManager->read();

        $this->render("delete-page", "back", ['pages' => $pages]);

        if ( $_SERVER["REQUEST_METHOD"] == "POST"){
            $id = $_POST['id'];

            $pageManager = new pageManager(Page::class, 'page');
            $pageManager->delete($id);

            echo("<meta http-equiv='refresh' content='1'>");
        }
    }
    //editing a row in the database by id
    public function editpageAction(){
        $pageManager = new pageManager(Page::class,'page');
        $pages = $pageManager->read();

        $this->render("edit-page", "back", ['pages' => $pages]);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $page = $pageManager->findBy(['id' => $_POST['id']]);

            $this->render('edit-page-id','empty', ['page' => $page]);
        }
    }


    public function buildPageAction($params)
    {
        $pageManager = new pageManager();
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