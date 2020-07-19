<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\Room;

class RoomManager extends DB{

    public function _construct(){
        parent::__construct(Room::class,'room');
    }

    public function read($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'room', 'r');
            
                if(isset($id)){
                    $query->where('r.id = :idroom')
                    ->setParameters('idroom', $id);
                }
                return $query->getQuery()
                ->getArrayResult(Room::class);
        }
    }

    public function deleteRoom($id)
    {
        $this->delete($id);
    }
}