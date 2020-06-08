<?php

namespace cms\core;

class QueryBuilder {

    protected $connection;
    protected $query;
    protected $parameters;
    protected $alias;

    protected function __construct(BDDInterface $connection = null)
    {
        if (null == $connection)
        {
            $this->connection = new PDOConnection;
        } else {
            $this->connection = $connection;
        }
    }

    public function select(string $values = '*'):QueryBuilder
    {
        $query = "SELECT $values";

        addToQuery($query);
    }
    public function from(string $table, string $alias):QueryBuilder
    {
       $query = "FROM $table AS $alias";
       
       addToQuery($query);   
    }
    public function where(string $conditions):QueryBuilder
    {
        if(!stristr($this->query, 'WHERE')){
            $where = 'WHERE';
        } else {
            $where = 'AND';
        }
        $query = "$where $conditions";

        addToQuery($query);      
    }

    public function setParameter(string $key, string $value):QueryBuilder
    {
        if (null != $key && null != $value){
            $this->parameters[$key ] = $value;
        }    
    }

    public function join(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'):QueryBuilder
    {
        $query = "JOIN $table AS $aliasTarget ON $fieldSource = $fieldTarget ";
        addToQuery($query);
    }

    public function innerJoin(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'):QueryBuilder
    {
        $query = "INNER JOIN $table AS $aliasTarget ON $fieldSource = $fieldTarget ";
        addToQuery($query);
    } 

    public function leftJoin(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'):QueryBuilder
    {
        $query = "LEFT JOIN $table AS $aliasTarget ON $fieldSource = $fieldTarget ";
        addToQuery($query);
    }

    public function rightJoin(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'):QueryBuilder
    {
        $query = "RIGHT JOIN $table AS $aliasTarget ON $fieldSource = $fieldTarget ";
        addToQuery($query);
    }

    public function addToQuery(string $query):QueryBuilder
    {
        $this->query .= $query;
    }

    public function getQuery(): ResultInterface
    {
        return $this->connection->query($this->query, $this->parameters);
    }
}