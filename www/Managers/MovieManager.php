<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\Movie;

class MovieManager extends DB{

    public function _construct(){
        parent::__construct(Movie::class,'movie');
    }

    public function read($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'movie', 'm');
            
                if(isset($id)){
                    $query->where('m.id = :idmovie')
                    ->setParameters('idmovie', $id);
                }
                return $query->getQuery()
                ->getArrayResult(Movie::class);
        }
    }

    public function deleteMovie($id)
    {
        $this->delete($id);
    }
}
