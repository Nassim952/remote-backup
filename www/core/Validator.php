<?php

namespace cms\core;

use cms\managers\UserManager;

class Validator
{

	public static function formValidate( $config , $data ){
		$listOfErrors = [];
		$checkEmail = new UserManager('User','user');

		//Vérification du bon nb de input
		if(count($config["fields"]) == count($data)) 
		{
			// print_r($config);
			// print_r($data);
			foreach($config["fields"] as $value => $configField){
				//Vérifier que les names existent et Vérifier les required
				if (isset($data[$value]) && ($configField["required"] && !empty($data[$value]))) 
				{
					//Vérifier le format de l'email
					if ($configField["type"] == "email")
					{
						if (self::emailValidate($data[$value])) 
						{
							if (!empty($checkEmail->findBy(["email" => $data[$value]]))) 
							{
								array_push($listOfErrors, "l'email est déjà existant");
							}
						}
					}
					if($configField["placeholder"] == "Votre mot de passe") 
					{
						if(self::pwdValidate($data[$value])){
							$listOfErrors[] = $configField["errorMsg"];
						}
					}
					if($configField["placeholder"] == "Confirmation")
					{
						if($data["password"] != $data["confirmpwd"]){
							
							$listOfErrors[] = $configField["errorMsg"];
						}
					}
					if (isset($_POST['input']) && sizeof($_POST['input']) > 0)
					{
						// If the captcha is valid 
						if ($_POST['input'] == $_SESSION['captcha']){
							$msg = '<span style="color:green">SUCCESSFUL!!!</span>'; 
						} else {
							$msg = '<span style="color:red">CAPTCHA FAILED!!!</span>';
						} 			 
				} else {
					return ["Tentative de hack"];
				}
			} else {
			return ["Tentative de hack"];
		}
		return $listOfErrors;
	}

	public static function formLoginValidate( $config, $data )
	{
		$listOfErrors = [];

		//Vérification du bon nb de input
		if(count($config["fields"]) == count($data)) {
			foreach($config["fields"] as $name => $configField){
				//Vérifier que les names existent et Vérifier les required
				if (isset($data[$name]) 
					&& ($configField["required"] && !empty($data[$name]))) {
					//Vérifier le format de l'email
					if (($configField["name"] == "username") && empty(UserManager::findBy(["username" => $data[$name]]))) {			
							$listOfErrors[] = $configField["errorMsg"];	
					} elseif($configField["type"] = "password" && !self::pwdValidate($data[$name])) {
						$listOfErrors[] = $configField["errorMsg"];
					}
					if (isset($_POST['input']) && sizeof($_POST['input']) > 0) 
  
						// If the captcha is valid 
						if ($_POST['input'] == $_SESSION['captcha']) 
							$msg = '<span style="color:green">SUCCESSFUL!!!</span>'; 
						else 
							$msg = '<span style="color:red">CAPTCHA FAILED!!!</span>'; 
				} else {
					return ["Tentative de hack !!!"];
				}
			}
		} else {
			return ["Tentative de hack !!!"];
		}
		return $listOfErrors;
	}

	public static function emailValidate($email) 
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public static function maxValidate($string, $length)
	{
		return strlen(trim($string)) <= $length;
	}

	public static function minValidate($string, $length)
	{
		return strlen(trim($string)) >= $length;
	}

	public static function pwdValidate($pwd)
	{
		$uppercase = preg_match('@[A-Z]@', $pwd);
		$lowercase = preg_match('@[a-z]@', $pwd);
		$number    = preg_match('@[0-9]@', $pwd);

		if(!$uppercase || !$lowercase || !$number || strlen($pwd) < 8) {
			return true;
		}
	}

	public static function formAddFilmValidate( $config, $data){
		$listOfErrors = [];

		//Vérification du bon nb de input
		if(count($config["fields"]) == count($data)) {
			foreach($config["fields"] as $name => $configField){
				//Vérifier que les names existent et Vérifier les required
				if (isset($data[$name]) 
					&& ($configField["required"] && !empty($data[$name]))) {
					//Vérifier le format de l'email
					if (($configField["id"] == "title") && empty(UserManager::findBy(["title" => $data[$name]]))) {			
							$listOfErrors[] = $configField["errorMsg"];	
					} elseif($configField["type"] = "password" && !self::pwdValidate($data[$name])) {
						$listOfErrors[] = $configField["errorMsg"];
					}
					//Vérifier le captcha
				} else {
					return ["Tentative de hack !!!"];
				}
			}
		} else {
			return ["Tentative de hack !!!"];
		}
		return $listOfErrors;
	}
}

