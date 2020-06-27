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
				} else {
					return ["Tentative de hack"];
				}
			}
		} else {
			return ["Tentative de hack"];
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
}

