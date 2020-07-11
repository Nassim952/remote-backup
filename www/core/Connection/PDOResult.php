<?php 

namespace cms\core\Connection;

use cms\core\Model;
use cms\models\User;
use cms\core\Connection\ResultInterface;
use PDO;
use Throwable;


class PDOResult implements ResultInterface
{

    protected $statement;
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }


    public function getArrayResult($class = null): array
    {
        // $string = 'cms\models\ '.$class;
        // $object = str_replace(' ', '', $string);

        // $instance = new $object();
        // // print_r($instance);

        // // $user = new User();
        // // print_r($user);
        
        $object = new User;
        
        $result =  $this->statement->fetchAll(PDO::FETCH_ASSOC);
        if($class) {
            $results = [];
            foreach ($result as $key => $value) {
            array_push($results, ($object->hydrate($value)));
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
