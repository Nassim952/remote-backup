<?php


class Installer
{
    public  function init()
    {

		$view = new View("installation","front");
		$view->assign('config',$this->configFormInstall());
		$view->assign('form','form');
		$view->assign('values',['dbhost' => 'localhost']);
	}

    public  function connectDatabase()
    {

		$dbhost = '';
		$dbname = '';
		$dbuser = '';
		$dbpassword = '';
		$error = false;
		
		if(isset($_POST['dhhost'])){
			$dbhost = $_POST['dhhost'];
		}
		
		if(isset($_POST['dbname'])){
			$dbname = $_POST['dbname'];
		}
		
		if(isset($_POST['dbuser'])){
			$dbuser = $_POST['dbuser'];
		}

		if(isset($_POST['dbpassword'])){
			$dbpassword = $_POST['dbpassword'];
		}

		try {
			$pdo = new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpassword);
		} catch(Exception $e){
			$error = true;
		}

	    if($error){
            $msg = array("status"=> 'error',    "message"=>'Informations non valide');
        } else {
            $msg = array("status"=> 'success',    "message"=>'Information correcte');

	        //Installation de la base de données
	        $sql=file_get_contents("datas/default_database.sql");
	       
	        $pdo->query($sql);

			//Création de la conf
			$conf = file('conf.inc.default.php');
			foreach ($conf as $key => $line) {
			    if( strpos($line, 'DBUSER') !== FALSE )
			            $conf[$key] = 'define("DBUSER","'. $dbuser .'");'. "\n";
			    if( strpos($line, 'DBPWD') !== FALSE )
			            $conf[$key] = 'define("DBPWD","'. $dbpassword .'");'. "\n";
			    if( strpos($line, 'DBHOST') !== FALSE )
			            $conf[$key] = 'define("DBHOST","'. $dbhost .'");'. "\n";
			    if( strpos($line, 'DBNAME') !== FALSE )
			            $conf[$key] = 'define("DBNAME","'. $dbname .'");'. "\n";
			    if( strpos($line, 'DBPORT') !== FALSE )
			            $conf[$key] = 'define("DBPORT","'. '3306' .'");'. "\n";
			}
			$conf[] =  'define("APP_INSTALLED",true);'. "\n";

			file_put_contents('conf.inc.php', $conf);

        }
        print_r(json_encode($msg)) ;

	}


    private function configFormInstall()
    {
        return [
            "config"=>["method"=>"POST",  "action"=>"/webdrivingschool/install", "value"=>"Enregistrer","back" =>"","type" => "button"],
            "input"=>[
                "dbhost" =>[
                    "type" =>"text",
                    "placeholder"=>"Nom de l'hôte",
                    "required"=>true,
                    "label"=>" Hôte"
                ],
                "dbname" =>[
                    "type" =>"text",
                    "placeholder"=>"Nom de la base de données",
                    "required"=>true,
                    "label"=>"Database"
                ],
                "dbuser" =>[
                    "type" =>"text",
                    "placeholder"=>"Nom de l'utilisateur",
                    "label"=>"Utilisateur"
                ],
                "dbpassword" =>[
                    "type" =>"password",
                    "placeholder"=>"Mot de passe de l'utilisateur",
                    "label"=>"Mot de passe"
                ],
            ]
        ];
    }
}
