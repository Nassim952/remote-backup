<?php

namespace www\core\Connection;

use www\core\Connection\PDOResult;

class PDOConnection implements BDDInterface{

    protected $pdo;

    public function connect(){

        try {
            $this->pdo = new PDO(DRIVER_DB.":host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PWD_DB);
        } catch(Exception $e) {
            echo("SQL Error : ".$e->getMessage());
        }

    }

    public function query($sql, $parameters = null){
        try{
            if ($parameters) {
                $queryPrepared = $this->pdo->prepare($sql);
                $queryPrepared->execute($parameters);
                return new PDOResult($queryPrepared);
            } else {
                $queryPrepared = $this->pdo->prepare($sql);
                $queryPrepared->execute();
                return new PDOResult($queryPrepared);
            }
        }
        catch (Exception $e)
        {
            echo('Exeption. Message d\'erreur : '.$e->getMessage());
        }

    }


}