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
					// var_dump(file_get_contents(".sql"));
					$stmt = $pdo->prepare(file_get_contents(".sql"));
					$stmt->execute();
				} catch(PDOException $e){
					print_r($e->getMessage());
					syslog(LOG_ERR, "PDO Error : ".$e->getMessage());
				}	
				
			} else {
				throw new Exception("File Exeption");
			}

			//Création de la conf
			$conf = file('.prod');
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
			file_put_contents('.prod', $conf);

			return true;
        }
	}
}
