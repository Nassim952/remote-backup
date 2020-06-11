<?php

namespace cms\core;

class QueryBuilder {

    protected $connection;
    protected $query;
    protected $parameters;
    protected $select;
    protected $from;
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
        $select = "SELECT $values";

        buildSelect($select);

        return $this;
    }

    public function from(string $table, string $alias = null):QueryBuilder
    {
       $query = "FROM $table AS $alias";

       if(null !== $alias) {
        $this->$alias = $alias;
       }
       addToQuery($query);

       return $this;  
    }

    public function where(string $conditions):QueryBuilder
    {
        if (!stristr($this->query, 'WHERE')) {
            $where = 'WHERE';
        } else {
            $where = 'AND';
        }
        $query = "$where $conditions";
        addToQuery($query);

        return $this; 
    }

    public function setParameter(string $key, string $value):QueryBuilder
    {
        if (null != $key && null != $value) {
            $this->parameters[$key ] = $value;
        }
        return $this;
    }

    public function innerJoin(array $tableDef, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    {
        $aliasTarget = array_shift(array_keys($tableDef));
        $query = join($tableDef, $aliasTarget, $fieldSource, $fieldTarget, "INNER");
        $this->alias = $aliasTarget;

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToQuery($query);

        return $this;
    } 

    public function leftJoin(array $tableDef, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    {
        $aliasTarget = array_shift(array_keys($tableDef));
        $query = join($tableDef, $aliasTarget, $fieldSource, $fieldTarget, "LEFT");
        $this->alias = $aliasTarget;

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToQuery($query);

        return $this;
    }

    public function rightJoin(array $tableDef, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    {
        $aliasTarget = array_shift(array_keys($tableDef));

        $query = join($tableDef, $aliasTarget, $fieldSource, $fieldTarget, "RIGHT");

        $this->alias = $aliasTarget;

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToQuery($query);

        return $this;
    }

    public function group($group)
    {
        $query = "GROUP BY $group";
        addToQuery($query);

        return $this;
    }

    public function addToQuery(string $query)
    {
        $this->query .= $query.' ';
    }


    public function getQuery(): ResultInterface
    {
        $this->query = $this->select.$this->query;
        return $this->connection->query($this->query, $this->parameters);
    }

//PRIVATE FUNCTION
    private function join(array $tableDef, string $aliasTarget, string $fieldSource, string $fieldTarget , string $join = null):QueryBuilder
    {
        switch ($join) {
            case 'LEFT':
                $query = "LEFT JOIN $tableDef[$aliasTarget] AS $aliasTarget ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget ";
                break;
            case 'RIGHT':
                $query = "RIGHT JOIN $tableDef[$aliasTarget] AS $aliasTarget ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget ";
                break;
            case 'INNER':
                $query = "INNER JOIN $tableDef[$aliasTarget] AS $aliasTarget ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget ";
                break;
            case null:
                $query = "JOIN $tableDef[$aliasTarget] AS $aliasTarget ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget ";
                break;
        }

        return $query;
    }

    private function buildSelect(array $fields, $aliasTarget = null)
    {
        $select = null;

        if (null === $aliasTarget) {
            $select .= "$fields";
        } else {
            foreach($fields as $field) {
                $select .= "$aliasTarget\.$field";
            }
        }
        addToSelect($select);
    }

    private function addToSelect(string $select)
    {
        $this->select .= $select.' ';
    }
}