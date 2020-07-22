<?php

namespace cms\core\Connection;

use PDOException;
use PDO;
use Throwable;

class PDOConnection implements BDDInterface{

    protected $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO(DRIVER_DB.":host=".HOST_DB.";dbname=".NAME_DB.";charset=utf8", USER_DB, PWD_DB);
        } catch(Throwable $e) {
            echo("SQL Error : ".$e->getMessage());
        }

    }

    public function query(string $query , array $parameters = null)
    {
        if ($parameters) {   
            $queryPrepared = $this->pdo->prepare($query);
            
            try{
                $queryPrepared->execute($parameters);
            } catch(PDOException $p) {
                syslog(LOG_ERR, "PDO Error : ".$p->getMessage());
            }
            return new PDOResult($queryPrepared);
        } else {
            $queryPrepared = $this->pdo->prepare($query);
            $queryPrepared->execute();
            return new PDOResult($queryPrepared);
        }
    }

}