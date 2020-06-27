<?php

namespace cms\core;

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
	public function addSection(string $section, array $data)
	{
		if (!file_exists("views/sections/".$section.".gab.php")) {
			throw new Exception("ce gabarit de section  n'existe pas");
		}
		include "views/sections/".$section.".gab.php";
	}
		
	// affiche le template et ce qui va avec
	public function __destruct()
	{
		extract($this->data);
		include "views/templates/".$this->template.".tpl.php"; 
	}
	
}









