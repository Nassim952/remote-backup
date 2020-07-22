<?php


namespace cms\core\Builder;

use cms\core\Connection\BDDInterface;
use cms\core\Connection\PDOConnection;
use cms\core\Connection\ResultInterface;

class QueryBuilder {

    protected $connection;
    protected $query = null;
    protected $parameters = [];
    protected $where = null;
    protected $join = null;
    protected $from = null;
    protected $select = null;
    protected $group = null;
    protected $alias = null;
    

//SETTERS
    public function __construct(BDDInterface $connection = null)
    {
        $this->setConnection($connection);
    }

    public function setConnection(BDDInterface $connection = null){
        $this->connection = $connection;
        if(NULL === $connection)
            $this->connection = new PDOConnection();
            
        $this->query = "";
        $this->parameters = [];
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setSelect(string $select)
    {
        $this->select = $select;
    }

    public function setWhere($where)
    {
        $this->where = $where;

        return $this;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }

    public function setJoin($join)
    {
        $this->join = $join;
    }

    public function setParameters(string $key, string $value): QueryBuilder
    {
        $this->parameters[":$key"] = $value;

        return $this;
    }


//GETTERS

    public function getSelect()
    {
        return $this->select;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getParameters()
    {
       return $this->parameters;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function getJoin()
    {
        return $this->join;
    }

//OPERATIONS
    public function distinct()
    {
        $select =  "SELECT DISTINCT";
        $this->buildSelect($select);
        return $this;
    }
    public function select(string $values = '*'):QueryBuilder
    {
        if(null === $this->select)
        {
            $select =  "SELECT $values";
            $this->buildSelect($select);
            return $this;
        }
        else
        {
            $select = "{$this->select}{$values}";
            $this->buildSelect($select);
            return $this;
        }

    }
    
    public function from(string $table, string $alias = null):QueryBuilder
    {
        $from = "FROM $table ";

        if (null !== $alias) {
            $from .= "AS $alias";
            $this->alias = $alias;
        }
        
        $this->addToFrom($from);

        return $this;  
    }

    public function where(string $conditions):QueryBuilder
    {
        if (!stristr($this->getWhere(), 'WHERE')) {
            $where = 'WHERE';
        } else {
            $where = 'AND';
        }
        $query = "$where $conditions";
        $this->addToWhere($query);

        return $this; 
    }

    public function addParameter(string $key, string $value):QueryBuilder
    {
        if (null != $key && null != $value) {
            $this->parameters[$key ] = $value;
        }
        return $this;
    }

    public function join(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', string $select = null):QueryBuilder
    { 
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = $this->buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget);

        if (null !== $select) {
            $this->buildSelect($select, $this->alias);
        }
        $this->addToJoin($query);

        return $this;
    } 

    public function innerJoin(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', string $select = null):QueryBuilder
    { 
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = $this->buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "INNER");
        $this->setAlias($aliasTarget);

        if (null !== $select) {
            $this->buildSelect($select, $this->alias);
        }
        $this->addToJoin($query);

        return $this;
    } 

    public function leftJoin(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', string $select = null):QueryBuilder
    {
        [$table, $aliasTarget] = explode(" ", $table);

        $query = $this->buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "LEFT");
        $this->setAlias($aliasTarget);

        if (null !== $select) {
            $this->buildSelect($select, $this->alias);
        }
        $this->addToJoin($query);

        return $this;
    }

    public function rightJoin(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', string $select = null):QueryBuilder
    {
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = $this->buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "RIGHT");
        $this->setAlias($aliasTarget);

        if (null !== $select) {
            $this->buildSelect($select, $this->alias);
        }
        $this->addToJoin($query);

        return $this;
    }

    public function groupBy($group)
    {
        $group = "GROUP BY $group";
        $this->group .= $group;

        return $this;
    }

//PRIVATE FUNCTION
    private function buildJoin(string $table, string $aliasTarget, string $fieldSource, string $fieldTarget , string $join = null): string
    {
        switch ($join) {
            case 'LEFT':
                $query = "LEFT JOIN $table $aliasTarget ";
                break;
            case 'RIGHT':
                $query = "RIGHT JOIN $table $aliasTarget  ";
                break;
            case 'INNER':
                $query = "INNER JOIN $table $aliasTarget ";
                break;
            case null:
                $query = "JOIN $table $aliasTarget ";
                break;
        }

        $query .= $this->on($table, $aliasTarget, $fieldSource, $fieldTarget);
        return $query;
    }

    private function on(string $table, string $aliasTarget, string $fieldSource, string $fieldTarget) :string
    { 
        return (null === $aliasTarget) ? " ON $this->alias.$fieldSource = $table.$fieldTarget" : "ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget";
    }

    private function buildSelect(string $fields, $aliasTarget = null)
    {
        $select = null;

        if (null === $aliasTarget) {
            $select .= "$fields";
        } else {
            if (!empty($fields) || $fields === null) {

                foreach (explode('', $fields) as $field) {
                    $select .= "$aliasTarget.$field";
                }
            } else {
                $select .= "$aliasTarget.*";
            } 
        }
        $this->addToSelect($select);
    }


    public function addToFrom(string $from)
    {
        $from = $this->getFrom().$from.' ';
        $this->setFrom($from);
    }

    public function addToJoin(string $join)
    {
        $join = $this->getJoin().$join.' ';
        $this->setJoin($join);
    }

    public function addToWhere(string $where)
    {
        $where = $this->where.$where.' ';
        
        $this->where = $where;
    }

    private function addToSelect(string $select)
    {
        $select = $this->getSelect().$select.' ';
        $this->setQuery($select);
    }

    public function getQuery(): ResultInterface
    {
        $this->query = "{$this->query}{$this->from}{$this->join}{$this->where}{$this->group};";
        // print_r($this->query."\n");
        $result =  $this->connection->query($this->query, $this->parameters);
        return $result;
    }
    
}