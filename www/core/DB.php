<?php

namespace cms\core;

use cms\models\users;
use cms\models\PDOConnection;

class DB{
    private $table;
    private $connection;
    private $class;

    public function __construct(string $class, BDDInterface $connection = null)
    {

        $this->class = $class;
        $this->table = str_replace('cms\models\user', 'users', PREFIXE_DB.get_called_class());
       
        if(!$connection){
            $this->connection = new PDOConnection;
        }
       
    }

    public function initBdd()
    {
        if(!file_exists(".sql")){
            return false;
        }
        //.sql
        $sql = trim(file_get_contents(".sql"));

        $this->connection->query($sql);

    }

    public function find(int $id): ?\App\Models\Model
    {
            $Sql = "SELECT * FROM ".$this->table. "WHERE id= ".$id;

            $queryPrepared = $this->connection->querry($sql);
            $queryPrepared->execute();

            return (new $this->class())->load($queryPrepared->fetch());
    }

    public function findAll(): array
    {

        $Sql = "SELECT * FROM ".$this->table. "WHERE id= ".$id;

        $result = $this->connection->query($sql);

        $rows = $rows->getArrayResult();

        $results = array_map(function($row){

            return (new $this->class())->load($row);
            },$rows
        );
            
        return $results;

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

        $result = $this->connection->query($sql, $params);
        
        $rows = $result->getArrayResult();
        
        $results = array_map(function($row){

            return (new $this->class())->load($row);
            },$rows
        );

        return $results;

    }

    public function count(array $params): int
    {
        $sql = "SELECT COUNT(*) FROM $this->table where ";

        foreach($params as $key => $value) {
            if(is_string($value))
                $comparator = 'LIKE';
            else 
                $comparator = '=';
            $sql .= " $key $comparator :$key and"; 

            $params[":$key"] = $value;
            unset($params[$key]);
        }
        
        $sql = rtrim($sql, 'and');
        $result = $this->connection->query($sql, $params);
        
        return $result->getValueResult();
    }
   
    public function save($oToSave): bool
    {
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

        return true;
    } 

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM $this->table where id = :id";
        $result = $this->connection->query($sql, [':id' => $id]);

        return true;
    }

}
