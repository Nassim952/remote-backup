<?php

namespace cms\controllers;

use cms\core\Builder\ElementPageBuilder;
use cms\core\Builder\PageBuilder;
use cms\core\Controller;
use cms\managers\PageManager;
use cms\core\Page;
use cms\core\View;
use cms\forms\AddPageType;

class PageController extends Controller
{   
    // page action callling the view
    public function pageAction(){
        $pageManager = new PageManager(Page::class, 'Page');
        $pages = $pageManager->read();
        
        // This send comment data to the view thanks to the Commentmanager read function
        $this->render("page", "back", ['pages'=> $pages ]);
    }

    public function addPageAction()
    {
        $form = $this->createForm(AddPageType::class);
        $form->handle();

        if($form->isSubmit() && $form->isValid())
        {  
            $pageManager = new PageManager(Page::class, 'page');
            $page = new Page();

            $page->setTitle($_POST[$form->getName().'_title']);
            $page->setTheme($_POST[$form->getName().'_theme']);
            $page->setGabarit($_POST[$form->getName().'_gabarit']);
            $page->setFont($_POST[$form->getName().'_font']);
            $page->setFont_color($_POST[$form->getName().'_font-color']);

            $pageManager->save($page);

            echo "<script>alert('Page crée avec succès');</script>";
        }

        $this->render("addpage", "back", [
            "configFormUser" => $form
        ]);
    }


    //deleting data in the database
    public function deletepageAction($id){
        new View('confirm-page','back');

        $pageManager = new pageManager(Page::class,'page');
        $pageManager->delete($id);

        echo "<script>alert('Page supprimé avec succès');</script>";
    }
    //editing a row in the database by id
    public function editpageAction($id){
        $pageManager = new pageManager(Page::class,'page');
        $pages = $pageManager->read($id);

        $this->render("edit-page", "back", ['pages' => $pages]);
    }


    public function buildPageAction($params)
    {
        // $pageManager = new pageManager();
        // $page = $pageManager->find($params['id']);

        // if (!$page) {
        //     throw new NotFoundException("page not found");
        // }

        // recuperation  en BDD
        $page = new Page();//find page PageManager()

        $sections = new ElementPageBuilder(); //sectionManager return Element page builder
        ///
        
        // $page->setBuilder(((new PageBuilder()->setSections($sections))));
        
        $this->render("default", "front", [
            "page" => $page
        ]);
    }
}