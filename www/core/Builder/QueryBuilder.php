<?php

namespace cms\core\Builder;

use cms\core\Connection\BDDInterface;
use cms\core\Connection\PDOConnection;
use cms\core\Connection\ResultInterface;

class QueryBuilder
{
    protected $connection;
    protected $query;
    protected $parameters;
    protected $alias;

    public function __construct(BDDInterface $connection = NULL)
    {
        $this->connection = $connection;
        if(NULL === $connection)
            $this->connection = new PDOConnection();
            
        $this->query = "";
        $this->parameters = [];
    }

    public function select( string $values = '*'): QueryBuilder
    {
        $this->addToQuery("SELECT $values");
        
        return $this;
    }

    public function from( string $table, string $alias): QueryBuilder
    {
        $this->addToQuery("FROM $table $alias");
        $this->alias = $alias;

        return $this;
    }

    public function where( string $conditions): QueryBuilder
    {
        $this->addToQuery("WHERE $conditions");
        
        return $this;
    }

    public function setParameters(string $key, string $value): QueryBuilder
    {
        $this->parameters[":$key"] = $value;

        return $this;
    }

    public function join(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'): QueryBuilder
    {
        $aliasSource = $this->alias;

        $this->addToQuery("JOIN $table $aliasTarget ON $aliasTarget.$fieldTarget = $aliasSource.$fieldSource");

        return $this;
    } 



    public function leftJoin(string $table, string $aliasTarget, string $fieldSource = 'id', string $fieldTarget = 'id'): QueryBuilder
    {
        $aliasSource = $this->alias;

        $this->addToQuery("LEFT JOIN $table $aliasTarget ON $aliasTarget.$fieldTarget = $aliasSource.$fieldSource");

        return $this;
    } 


    public function addToQuery(string $query): QueryBuilder
    {
        $this->query .= $query. " ";

        return $this;
    }

    public function getQuery(): ResultInterface
    {
        $result =  $this->connection->query($this->query, $this->parameters);

        return $result;
        
    }
}