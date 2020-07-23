<?php

namespace cms\core\Exeptions;

use \Exception;

class ExeptionHandler extends Exception
{ 
    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous = null);    
        file_put_contents('etc/logs/log.php',$this->getMessage().PHP_EOL,  (filesize('etc/logs/log.php')>=1200)? :FILE_APPEND);
    }  
}