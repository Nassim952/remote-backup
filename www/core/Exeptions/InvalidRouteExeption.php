<?php

namespace cms\core\Exeptions;

use \Exception;
use \cms\core\View;

class InvalidRouteExeption extends Exception
{  
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous = null);
        file_put_contents('etc/logs/error.php',"Invalide Route access: ".$this->getMessage().PHP_EOL, (filesize('etc/logs/log.php')>=1200)? :FILE_APPEND);
    }
}