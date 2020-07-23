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
		$dbdriver = '';
		$dbprefixe = '';
		$dbname = '';
		$dbuser = '';
		$dbpassword = '';
		$error = false;
		
		if(isset($_POST['Installer_db_driver'])){
			$dbdriver = $_POST['Installer_db_driver'];
		}

		if(isset($_POST['Installer_db_prefixe'])){
			$dbprefixe = $_POST['Installer_db_prefixe'];
		}

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
					$stmt = $pdo->prepare(file_get_contents(".sql"));
					$stmt->execute();
				} catch(PDOException $e){
					syslog(LOG_ERR, "PDO Error : ".$e->getMessage());
				}	
				
			} else {
				throw new Exception("File Exeption");
			}

				$conf[] = "USER_DB=$dbuser\r\n";
				$conf[] = "PWD_DB=$dbpassword\r\n";
				$conf[] = "HOST_DB=$dbhost\r\n";
				$conf[] = "NAME_DB=$dbname\r\n";
				$conf[] = "DB_DRIVER=$dbdriver\r\n";
				$conf[] = "PREFIXE_DB=$dbprefixe\r\n";
				$conf[] = "PORT_DB=8888\r\n";

			// }
			$conf[] =  'APP_INSTALLED=true'."\r\n";
		
			file_put_contents('.prod', $conf);

			return true;
		}
	}
}
