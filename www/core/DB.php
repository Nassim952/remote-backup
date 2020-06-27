<?php

namespace cms\core;

use cms\models\users;
use cms\models\PDOConnection;

class DB
{
    private $table;
    private $connection;
    protected $class;

    public function __construct(string $class, string $table, BDDInterface $connection = null)
    {
        $this->class = $class;
        $this->table =  DB_PREFIXE.$table;
        
        $this->connection = $connection;
        if(NULL === $connection)
            $this->connection = new PDOConnection();
    }


    public function find(int $id): ?Model
    {
        $sql = "SELECT * FROM $this->table where id = :id";

        $result = $this->connection->query($sql, [':id' => $id]);
        
        return $result->getOneOrNullResult($this->class);
      
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM $this->table";

        $result = $this->connection->query($sql);

        return $result->getArrayResult($this->class);
      
    }

    public function findBy(array $params, array $order = null): array
    {
        $results = array();
        $sql = "SELECT * FROM $this->table where ";

        // Select * FROM users WHERE firstname LIKE :firstname ORDER BY id desc
        foreach($params as $key => $value) {
            if(is_string($value)) {
                $comparator = 'LIKE';
            } else {
                $comparator = '=';
            }
            $sql .= " $key $comparator :$key and"; 
            // Select * FROM users WHERE firstname LIKE :firstname and
            $params[":$key"] = $value;
            unset($params[$key]);
        }
        $sql = rtrim($sql, 'and');
        // Select * FROM users WHERE firstname LIKE :firstname
        if ($order) {
            $sql .= "ORDER BY ". key($order). " ". $order[key($order)]; 
        }
        // Select * FROM users WHERE firstname LIKE :firstname ORDER BY id desc
        $result = $this->connection->query($sql, $params);
        return $result->getArrayResult($this->class);   
    }

    public function count(array $params): int
    {
        $sql = "SELECT COUNT(*) FROM $this->table where ";

        foreach($params as $key => $value) {
            if(is_string($value)) {
                $comparator = 'LIKE';
            } else {
                $comparator = '=';
            }
            $sql .= " $key $comparator :$key and"; 
            $params[":$key"] = $value;
            unset($params[$key]);
        }

        $sql = rtrim($sql, 'and');

        $result = $this->connection->query($sql, $params);
        return $result->getValueResult();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM $this->table where id = :id";
        $result = $this->connection->query($sql, [':id' => $id]);

        return true;
    }

    public function save($objectToSave)
    {
        $objectArray =  $objectToSave->__toArray();
        $columnsData = array_values($objectArray);
        $columns = array_keys($objectArray);

        // On met 2 points devant chaque clé du tableau
        $params = array_combine(
            array_map(function($k){ 
                    return ':'.$k; }, 
                    array_keys($objectArray)
                ),
            $objectArray
        );
        
        if (!is_numeric($objectToSave->getId())) {
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

    protected function sql($sql, $parameters = null)
    {
        if ($parameters) {
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute($parameters);

            return $queryPrepared;
        } else {
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute();

            return $queryPrepared;
        }
    }
    
}