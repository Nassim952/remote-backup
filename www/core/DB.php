<?php

namespace cms\core;

use cms\core\Connection\PDOConnection;
use cms\core\Connection\BDDInterface;


class DB
{
    private $table;
    private $connection;
    protected $class;

    public function __construct(string $class, string $table, BDDInterface $connection = null)
    {
        $this->class = $class;
        $this->table = DB_PREFIXE.$table;
        $this->connection = $connection;
        if(NULL === $connection)
            $this->connection = new PDOConnection();
    }

    public function initBdd(string $bdd = "")
    {
        if (!file_exists($bdd.".sql")) {
            return false;
        }
        //.sql
        $sql = trim(file_get_contents($bdd.".sql"));

        $this->connection->query($sql);
    }
    
    // : ?\App\Models\Model
    public function find(int $id)
    {
            $sql = "SELECT * FROM ".$this->table. "WHERE id = ".$id;

            $queryPrepared = $this->connection->query($sql);
            $queryPrepared->execute();

        $result = $this->connection->query($sql, [':id' => $id]);
        
        return $result->getOneOrNullResult($this->class);
      
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM ".$this->table. "WHERE id= ".$id;
        $result = $this->connection->query($sql);
        $rows = $result->getArrayResult();
        $results = array_map(
                        function($row)
                        {
                            return (new $this->class())->load($row);
                        },$rows
                    );     
        return $results;
    }

    public function findBy(array $params,array $order = null): array
    {
        $sql = "SELECT * FROM $this->table WHERE ";
        // Select * FROM users WHERE firstname LIKE :firstname ORDER BY id desc

        foreach($params as $key => $value)
        {
            if(is_string($value))
            {
                $separator = "LIKE";
            } else {
                $separator = '=';
            }
            $sql .= " $key $separator :$key and"; 

            // Select * FROM users WHERE firstname LIKE :firstname and
            $params[":$key"] = $value;
            unset($params[$key]);
        }

        // Select * FROM users WHERE firstname LIKE :firstname
        $sql = rtrim($sql,'and');

        if($order)
        {
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

    public function save($objectToSave)
    {
        $objectArray =  $objectToSave->__toArray();

        $columnsData = array_values($objectArray);

        $columns = array_keys($objectArray);

        // On met 2 points devant chaque clé du tableau
        $params = [];
        foreach($objectArray as $key => $value)
        {
            if($value instanceof Model)
            {
                $params[":$key"] = $value->getId();
                $this->save($value);
            } else {
                $params[":$key"] = $value;
            }
        }

        array_pop($columns);
        array_pop($params);

        if (!is_numeric($objectToSave->getId())) {

            //remove the last array index [class] 
            array_shift($columns);
            array_shift($params);

            //INSERT
            $sql = "INSERT INTO ".$this->table." (".implode(",", $columns).") VALUES (:".implode(",:", $columns).");";
        } else {
            //UPDATE
            foreach ($columns as $column) {
                $sqlUpdate[] = $column."=:".$column;
            }
            $sql = "UPDATE ".$this->table." SET ".implode(",", $sqlUpdate)." WHERE id=:id;";
        }
        $this->connection->query($sql, $params);    
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table where id = :id";
        $this->connection->query($sql, [':id' => $id]);
        return true;
    }
    
}