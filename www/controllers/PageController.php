<?php

namespace cms\controllers;

use cms\core\Builder\ElementPageBuilder;
use cms\core\Builder\ElementPageBuilderInterface;
use cms\core\Builder\PageBuilder;
use cms\core\Controller;
use cms\core\Helpers;
use cms\managers\PageManager;
use cms\managers\ComponentManager;
// use cms\core\Page;
use cms\models\Page;
use cms\models\Section;
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
            $page->setGabarit($_POST[$form->getName().'_gabarit']);

            $pageManager->save($page);

            echo "<script>alert('Page crée avec succès');</script>";
        }

        $this->render("addpage", "back", [
            "configFormUser" => $form
        ]);
    }


    //deleting data in the database
    public function deletePageAction($id){
        new View('confirm-page','back');

        $pageManager = new pageManager(Page::class,'page');
        $pageManager->delete($id);

        echo "<script>alert('Page supprimé avec succès');</script>";
    }

    //editing a row in the database by id
    public function editPageAction($id){
        $pageManager = new pageManager(Page::class,'page');
        $page = $pageManager->read($id);

        //  je récupère les sections qui appartient à la page
        $sectionManager = new SectionManager(ElementPageBuilder::class, 'section');
        $sections = $sectionManager->sectionsPage($id);

        // je récupère les components qui appartient aux sections de la page
        $componentManager = new ComponentManager(Component::class, 'component');
        $components = $componentManager->read();

        $this->render("edit-page", "back", [
            'page' => $page,
            'components' => $components,
            'sections' => $sections
        ]);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $page = new Page();

            $page->setId($id);
            $page->setTitle($_POST['title']);
            $page->setGabarit($_POST['gabarit']);

            $pageManager->save($page);

            echo "<script>alert('Film modifié avec succès');</script>";
        }
    }

    public function showComponentsPageAction($id){
        // je récupère les components qui appartient aux sections de la page
        $componentManager = new ComponentManager(Component::class, 'component');
        $components = $componentManager->componentsSection($id);

        $sectionManager = new SectionManager(ElementPageBuilder::class, 'section');
        $sections = $sectionManager->sectionsPage($id);

        $this->render('show-component-page', 'back', [
            'components' => $components,
            'sections' => $sections
            ]);
    }

    public function editComponentPageAction($id){
        // je récupère les components qui appartient aux sections de la page
        $componentManager = new ComponentManager(Component::class, 'component');
        $components = $componentManager->componentsSection($id);

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            print_r($components);
            $components->setCategorie($_POST['categorie']);
            $componentManager->save($components);

            Helpers::alert_popup('component modifié avec succès');
        }
        
        $this->render('edit-component-page', 'back', [
            'component' => $components
        ]);
    }

    public function deleteComponentPageAction($id){
        $componentManager = new ComponentManager(Component::class, 'component');

        $componentManager->delete($id);
        helpers::alert_popup("component supprimé avec succès");
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

    public function showSectionsPageAction(){
        $pageManager = new PageManager(PageManager::class, 'page');
        $pages = $pageManager->read();

        $sectionManager = new SectionManager(ElementPageBuilder::class, 'section');
        $sections = $sectionManager->read();

        $this->render('show-section-pages','back',[
            'sections' => $sections,
            'pages' => $pages
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

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(!empty($_POST['size'])){
                    $section = new Section();
                    $sectionManager = new SectionManager(ElementPageBuilder::class, 'section');

                    $section->setPage_id($page->getId());
                    $section->setSize($_POST['size']);

                    $nbSections = $sectionManager->count([
                        'page_id' => $page->getId()
                    ]);
                    
                    if($page->getGabarit() >= $nbSections){
                        $section->setPosition($nbSections + 1);
                        $sectionManager->save($section);

                        echo "<script>alert('section ajouté avec succès');</script>";

                        // on refrech la page courante
                        $newUrl = "/".str_replace(' ','_',$page->getTitle());
                        echo "<meta http-equiv='refresh' content='0;url='.$newUrl />";

                    }else{
                        echo "<script>alert('nombre maximum de section atteint pour cette page !');</script>";
                    }
                }else{
                    $component = new Component();
                    
                    $component->setCategorie($_POST['categorie']);
                    $component->setSection_id($_POST['section_id']);
                    $component->setPosition(1);

                    $componentManager = new ComponentManager(Component::class, 'component');

                    $componentManager->save($component);

                    echo "<script>alert('component ajouté avec succès');</script>";

                    // on refrech la page courante
                    $newUrl = "/".str_replace(' ','_',$page->getTitle());
                    echo "<meta http-equiv='refresh' content='0;url='.$newUrl />";
                }
        }
    }
}