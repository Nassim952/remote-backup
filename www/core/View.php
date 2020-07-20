<?php

namespace cms\core;

use Exception;

class View
{
	private $view;
	private $template;
	private $data = [];

	public function __construct(string $view, string $template="back")
	{
		$this->setTemplate($template);
		$this->setView($view);
	}

	//redéfini la propriété avec la variable template récupérée via le controleur
	public function setTemplate(string $template)
	{
		$this->template = strtolower(trim($template));

		if (!file_exists("views/templates/".$this->template.".tpl.php")) {
			die("Le template n'existe pas");
		}
	}

	//redéfini la propriété avec la variable view récupérée via le controleur
	public function setView(string $view)
	{
		$this->view = strtolower(trim($view));

		if (!file_exists("views/".$this->view.".php")) {
			throw new Exception("La vue n'existe pas");
		}
	}

	// envoie les donnée à la vue
	public function assign($key, $value)
	{
		$this->data[$key] = $value;
	}

	//inclue le modal si il existe
	public function addModal(string $modal, array $data)
	{
		if (!file_exists("views/modals/".$modal.".mod.php")) {
			throw new Exception("Le modal n'existe pas");
		}
		include "views/modals/".$modal.".mod.php";
	}

	//inclue une section si elle existe
	public function addSection($section, array $data)
	{
		if (!file_exists("views/sections/default.gab.php")) {
			throw new NotFoundException("ce gabarit de section  n'existe pas");
		}
		${"components".$section->getPage_id()} = $data;
		${"sections".$section->getPage_id()} = $section;
		$page = $this->data['page'];
		include "views/sections/default.gab.php";
	}

	//inclue une section si elle existe
	public function formView(string $formName, string $formTemplate = "base")
    {
        if (!file_exists("views/forms/".$formTemplate.".view.php")) {
            throw new NotFoundException("Le template de formulaire n'existe pas!!!");
        }
        $form = $this->data[$formName];// Objet Form
        include "views/forms/".$formTemplate.".view.php";
    }

		
	// affiche le template et ce qui va avec
	public function __destruct()
	{
		extract($this->data);
		include "views/templates/".$this->template.".tpl.php"; 
	}
	
}









