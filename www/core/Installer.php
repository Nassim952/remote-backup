<?php

namespace cms\core;

use PDOException;
use Exception;
use PDO;

class Installer
{
	public  function connectDatabase()
	{
		$dbhost = '';
		$dbname = '';
		$dbuser = '';
		$dbpassword = '';
		$error = false;
		
		if(isset($_POST['Installer_dbhost'])){
			$dbhost = $_POST['Installer_dbhost'];
		}
		
		if(isset($_POST['Installer_dbname'])){
			$dbname = $_POST['Installer_dbname'];
		}
		
		if(isset($_POST['Installer_dbuser'])){
			$dbuser = $_POST['Installer_dbuser'];
		}

		if(isset($_POST['Installer_dbpassword'])){
			$dbpassword = $_POST['Installer_dbpassword'];
		}

		try {
			$pdo = new PDO("mysql:host=".$dbhost.";dbname=".$dbname,$dbuser,$dbpassword);

		} catch(PDOException $e){
			syslog(LOG_ERR, "PDO Error : ".$e->getMessage());
			$error = true;
		}

		if($error){
			return false;
		} else {

			//Installation de la base de données
			if(file_exists(".sql"))
			{
				try {
					//var_dump(file_get_contents(".sql"));
					$stmt = $pdo->prepare(file_get_contents(".sql"));
					$stmt->execute();
				} catch(PDOException $e){
					//print_r($e->getMessage());
					syslog(LOG_ERR, "PDO Error : ".$e->getMessage());
				}	
				
			} else {
				throw new Exception("File Exeption");
			}

			// //Création de la conf
			// $confProd = file('.prod');
			// if (null === $conf || empty($conf)){
			// 	foreach ($confProd as $key => $line) {
			// 		if( strpos($line, 'USER_DB') !== FALSE )
			// 				$conf[$key] = "USER_DB = $dbuser \n";
			// 		if( strpos($line, 'PWD_DB') !== FALSE )
			// 				$conf[$key] = "PWD_DB = $dbpassword \n";
			// 		if( strpos($line, 'HOST_DB') !== FALSE )
			// 				$conf[$key] = "HOST_DB = $dbhost \n";
			// 		if( strpos($line, 'NAME_DB') !== FALSE )
			// 				$conf[$key] = "NAME_DB = $dbname \n";
			// 		if( strpos($line, 'DBPORT') !== FALSE )
			// 				$conf[$key] = "PORT_DB = 8888 \n";
			// 		// $fp = fopen('.prod','r+');
			// 		// ftruncate($fp,0);
			// 		// rewind($fp);
			// 	}
			// } else {

				$conf[] = "USER_DB = $dbuser \n";
				$conf[] = "PWD_DB = $dbpassword \n";
				$conf[] = "HOST_DB = $dbhost \n";
				$conf[] = "NAME_DB = $dbname \n";
				$conf[] = "PORT_DB = 8888 \n";

			// }
			$conf[] =  'APP_INSTALLED = true;'. "\n";
		
			file_put_contents('.prod', $conf);

			print_r($conf);

			return true;
		}
	}
}
