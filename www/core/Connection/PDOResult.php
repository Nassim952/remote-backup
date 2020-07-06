<?php 

namespace cms\core\Connection;

use cms\core\Model;
use cms\core\Connection\ResultInterface;
use PDO;


class PDOResult implements ResultInterface
{

    protected $statement;
    
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function getArrayResult(string $class = null): array
    {
        $result =  $this->statement->fetchAll(PDO::FETCH_ASSOC);

        if($class) {
            $class = "cms\\models\\".$class;
            $results = [];
            foreach ($result as $key => $value) {
                array_push($results, (new $class())->hydrate($value));
            }
            return $results;
        }
        return $result;
    }

    public function getOneOrNullResult(string $class = null): ?Model
    {
        $result =  $this->statement->fetch(); 

        if($class)
            return (new $class())->hydrate($result);

        return $result;
    }

    public function getValueResult()
    {
        return $this->statement->fetchColumn();
    }
}
