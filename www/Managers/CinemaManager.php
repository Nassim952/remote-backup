<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\Cinema;

class CinemaManager extends DB{

    public function _construct(){
        parent::__construct(Cinema::class,'cinema');
    }

    public function read($id = null){
    {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'cinema', 'c');
            
                if(isset($id)){
                    $query->where('c.id = :idcinema')
                    ->setParameters('idcinema', $id);
                }
                return $query->getQuery()
                ->getArrayResult(Cinema::class);
        }
    }

    public function readName($id = null){
    {
            $query = (new QueryBuilder())
                ->select('name')
                ->from(DB_PREFIXE.'cinema', 'c');
            
                if(isset($id)){
                    $query->where('c.id = :idcinema')
                    ->setParameters('idcinema', $id);
                }
                return $query->getQuery()
                ->getValueResult();
        }
    }
}