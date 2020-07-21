<?php

namespace cms\managers;

use cms\core\Builder\ElementPageBuilder;
use cms\core\DB;
use cms\core\Builder\QueryBuilder;

class SectionManager extends DB{

    public function _construct(){
        parent::__construct(ElementPageBuilder::class,'section');
    }

    public function read($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'section', 's');
            
                if(isset($id)){
                    $query->where('s.id = :idsection')
                    ->setParameters('idsection', $id);
                }
                return $query->getQuery()
                ->getArrayResult(ElementPageBuilder::class);
        }
    }

    public function sectionsPage($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'section', 's')
                ->join(DB_PREFIXE.'page p','page_id');
            
                if(isset($id)){
                    $query->where('s.page_id = :idpage')
                    ->setParameters('idpage', $id);
                }
                return $query->getQuery()
                ->getArrayResult(ElementPageBuilder::class);
        }
    }
}
