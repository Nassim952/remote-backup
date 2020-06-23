<?php

namespace cms\core\builder;

class QueryBuilder {

    protected $connection;
    protected $query = null;
    protected $parameters = [];
    protected $join = null;
    protected $from = null;
    protected $select = null;
    protected $group = null;
    protected $alias = null;
    

//SETTERS
    protected function __construct(BDDInterface $connection = null)
    {
        setConnection($connection);
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setSelect($select)
    {
        $this->select = $select;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }


//GETTERS
    public function getQuery()
    {
        return $this->query;
    }

    public function getSelect()
    {
        return $this->select;
    }

    public function getFrom()
    {
        return $this->from;
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

//OPERATIONS
    public function select(string $values = '*'):QueryBuilder
    {
        $select =  "SELECT $values";
        buildSelect($select);
        return $this;
    }

    public function from(string $table, string $alias = null):QueryBuilder
    {
       $query = "FROM $table AS $alias";

       if (null !== $alias) {
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

    public function addParameter(string $key, string $value):QueryBuilder
    {
        if (null != $key && null != $value) {
            $this->parameters[$key ] = $value;
        }
        return $this;
    }

    public function join(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    { 
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget);
        
        setAlias( (null === $aliasTarget) ? $table : $aliasTarget);

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToJoin($query);

        return $this;
    } 

    public function innerJoin(string $table, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    { 
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "INNER");
        setAlias($aliasTarget);

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToJoin($query);

        return $this;
    } 

    public function leftJoin(array $table, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    {
        [$table, $aliasTarget] = explode(" ", $table);

        $query = buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "LEFT");
        setAlias($aliasTarget);

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToJoin($query);

        return $this;
    }

    public function rightJoin(array $tableDef, string $fieldSource = 'id', string $fieldTarget = 'id', array $select = null):QueryBuilder
    {
        [$table, $aliasTarget] = explode(" ", $table);
        
        $query = buildJoin($table, $aliasTarget, $fieldSource, $fieldTarget, "RIGHT");
        setAlias($aliasTarget);

        if (null !== $select) {
            buildSelect($select, $this->alias);
        }
        addToJoin($query);

        return $this;
    }

    public function groupBy($group)
    {
        $query = "GROUP BY $group";
        addToQuery($query);

        return $this;
    }

//PRIVATE FUNCTION
    private function buildJoin(string $table, string $aliasTarget, string $fieldSource, string $fieldTarget , string $join = null):QueryBuilder
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

    private function on(string $table, string $aliasTarget, string $fieldSource, string $fieldTarget)
    {
        return (null === $aliasTarget) ? " ON $this->alias.$fieldSource = $table.$fieldTarget" : "ON $this->alias.$fieldSource = $aliasTarget.$fieldTarget";
    }

    private function buildSelect(array $fields, $aliasTarget = null)
    {
        $select = null;

        if (null === $aliasTarget) {
            $select .= "$fields";
        } else {
            if (!empty($select)) {
                foreach($fields as $field) {
                    $select .= "$aliasTarget.$field";
                }
            } else {
                $select .= "$aliasTarget.*";
            } 
        }
        addToSelect($select);
    }


    public function addToFrom(string $from)
    {
        $from = $this->getFrom().$from.' ';
        setFrom($from);
    }

    public function addToQuery(string $query)
    {
        $query = $this->getQuery().$query.' ';
        setQuery($query);
    }

    public function addToJoin(string $join)
    {
        $join = $this->getJoin().$join.' ';
        setJoin($join);
    }

    private function addToSelect(string $select)
    {
        $select = $this->getQuery().$select.' ';
        setQuery($query);
    }
}