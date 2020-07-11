<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;

class ComponentManager extends DB{

    public function _construct()
    {
        parent::__construct(Component::class,'component');
    }

    public function getSectionComponents(int $id = null)
    {
        $query = (new QueryBuilder())
            ->select('c, p')/// p.id as post_id, u.id as user_id,
            ->from(DB_PREFIXE.'component', 'c')
            ->join(DB_PREFIXE.'user', 'u');
            
            if($id) {
                $query->where('p.author = :iduser')
                ->setParameters('iduser', $id);
            }
            return $query->getQuery()
            ->getArrayResult(Post::class);
    }
}

