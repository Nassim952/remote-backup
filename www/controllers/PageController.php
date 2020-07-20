<?php

namespace cms\controllers;

use cms\core\Builder\ElementPageBuilder;
use cms\core\Builder\PageBuilder;
use cms\core\Controller;
use cms\managers\PageManager;
use cms\managers\ComponentManager;
// use cms\core\Page;
use cms\models\Page;
use cms\core\View;
use cms\forms\AddPageType;
use cms\managers\CinemaManager;
use cms\managers\MovieManager;
use cms\models\Cinema;
use cms\core\NotFoundException;
use cms\managers\SectionManager;
use cms\models\Component;

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
            $page->setFontColor($_POST[$form->getName().'_font-color']);

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

    public function templateCreateAction(){
        $movieManager = new MovieManager(Movie::class, 'movie');
        $movies = $movieManager->read();

        $cinemaManager = new CinemaManager(Cinema::class, 'cinema');
        $cinemas = $cinemaManager->read();

        $this->render('template-create','front-cms',[
            'movies' => $movies,
            'cinemas' => $cinemas
        ]);
    }

    public function showPagesAction(){
        $pageManager = new PageManager(Page::class,'page');

        $pages = $pageManager->read();

        $this->render('show-pages', 'back', [
            'pages' => $pages
        ]);
    }

    public function showCustomPagesAction(){
        $pageManager = new PageManager(Page::class,'page');

        $pages = $pageManager->read();

        $this->render('show-pages-customizable', 'front-cms', [
            'pages' => $pages
        ]);
    }


    public function buildPageAction($page)
    {
        if (!$page) {
            throw new NotFoundException("page not found");
        }

        if(is_string($page)){ 
            $pageManager = new pageManager(Page::class, 'page');
            $page = $pageManager->findBy(['title' => $page]);
            $page = array_pop($page);
        }

        $sections = (new SectionManager(ElementPageBuilder::class, 'section'))->sectionsPage($page->getId());

        $sectionUpdate = array_map(function($section){
            return $section->setComponents((
                    new ComponentManager(Component::class, 'component'))
                    ->componentsSection($section->getId())
            );
        }, $sections);

        $page->setSections($sectionUpdate);

        $this->render("default", "front-cms", [
            "page" => $page
        ]);
    }
}