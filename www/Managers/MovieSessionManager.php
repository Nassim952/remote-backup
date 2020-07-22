<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\MovieSession;

class MovieSessionManager extends DB{

    public function _construct(){
        parent::__construct(MovieSession::class,'MovieSession');
    }

    public function read($id = null){
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'movie_session', 'ms');
            
                if(isset($id)){
                    $query->where('ms.id = :idmoviesession')
                    ->setParameters('idmoviesession', $id);
                }
                return $query->getQuery()
                ->getArrayResult();
    }

    public function deleteMovieSession($id)
    {
        $this->delete($id);
    }
}