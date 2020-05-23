<?php

namespace mvc\core;

use mvc\models\users;
use PDO;

class DB{
    private $table;
    private $connection;
    private $class;

    public function __construct(string $class, BDDInterface $vonnection = null)
    {

        $this->class = $classe;
        $this->table = str_replace('mvc\models\users', 'users', PREFIXE_DB.get_called_class());
       
        if(!$connection){
            $this->connection = new PDOConnection;
        }
       
    }

    public function find(int $id): ?\App\Models\Model
    {
            $Sql = "SELECT * FROM ".$this->table. "WHERE id= ".$id;

            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute();

            return (new $this->class())->hydrate($queryPrepared->fetch());
    }

    public function findAll(): array
    {

        $Sql = "SELECT * FROM ".$this->table. "WHERE id= ".$id;

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

        $aData=$queryPrepared->fetchAll();

        array_map(function($data){

            return (new User())->hydrate($data);
            },$aData
        );
            return (new User())->hydrate($queryPrepared->fetchAll());

    }

    public function count(){
        $sql="select * from ".$this->table;

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();

        $result = $queryPrepared->fetchAll();

        print_r($result);
    }

    public function findBy(array $params,array $order): array
    {
        $Sql = "SELECT * FROM $this->table WHERE ";

        foreach($params as $key => $value)
        {
            if(is_string($value))
            {
                $separator = "LIKE";
            } else {

                $separator = "=";
            }

            $sql .="$key $separator :$key and";

            $params[":$key"] = $value;
            unset($params[$key]);
        }

        $sql = rtrim($sql,'and');

        if($order)
        {
            $sql .= "ORDER BY ". key($order). " ". $order[key($order)];
        }

    }

    public function save($oToSave){

        $oArray =  $oToSave->__toArray();

        $columnsData = array_values($oArray);
        $columns = array_keys($oArray);
        // On met 2 points devant chaque clé du tableau
        $params = array_combine(
                    array_map(function($k){
                        return ':'.$k; 
                    }, 
                    array_keys($oArray)),
                    $oArray
                );
        
        if (!is_numeric($oToSave->getId())) {
            array_shift($columns);
            array_shift($params);
            //INSERT
            $sql = "INSERT INTO ".$this->table." (".implode(",", $columns).") VALUES (:".implode(",:", $columns).");";
            //foreach()
        } else {
            //UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column."=:".$column;
            }
            $sql = "UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id;";
        }
        $this->connection->query($sql, $params);
    } 
}