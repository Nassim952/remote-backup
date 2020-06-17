<?php

namespace cms\Managers;

use cms\core\DB;

class ComponentManager extends DB{

    public function _construct()
    {
        parent::_construct(Component::class,'component');
    }

    public function getSectionComponents(int $id = null)
    {
        $query = (new QueryBuilder())
            ->select('c, p')/// p.id as post_id, u.id as user_id,
            ->from(PREFIXE_DB.'component', 'c')
            ->join(PREFIXE_DB.'user', 'u');
            
            if($id) {
                $query->where('p.author = :iduser')
                ->setParameter('iduser', $id);
            }
            return $query->getQuery()
            ->getArrayResult(Post::class);
    }
}

