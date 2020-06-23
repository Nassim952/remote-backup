
  <?php
class Validator
{


	public static function formRegisterValidate($config, $data )
	{
		$listOfErrors = [];

		//Vérification du bon nb de input
		if(count($config["fields"]) == count($data)) {
			foreach($config["fields"] as $name => $configField){
				//Vérifier que les names existent et Vérifier les required
				if (isset($data[$name]) 
					&& ($configField["required"] && !empty($data[$name]))) {

					if (isset($configField["maxString"]) 
						&& !self::maxValidate($data[$name], $configField["maxString"])) {
							$listOfErrors[] = $configField["errorMsg"];
					} elseif (isset($configField["minString"]) 
						&& !self::minValidate($data[$name], $configField["minString"])) {
							$listOfErrors[] = $configField["errorMsg"];
					}
					//Vérifier le format de l'email
					if ($configField["type"] == "email") {
						if (self::emailValidate($data[$name])) {
							if (!empty(UserManager::findBy(["email" => $data[$name]]))) {
								$listOfErrors[] = $configField["errorMsg"];
							}
							//vérifier l'unicté de l'email
						} else {
							$listOfErrors[] = $configField["errorMsg"];
						}
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
		return strlen($pwd) >= 6 && strlen($pwd) <= 32 && 
		preg_match("/[a-z]/", $pwd) && 
		preg_match("/[A-Z]/", $pwd) && 
		preg_match("/[0-9]/", $pwd);
	}
}

