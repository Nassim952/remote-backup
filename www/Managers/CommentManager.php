<?php

namespace cms\Managers;

use cms\core\DB;
use cms\core\builder\QueryBuilder;

class CommentManager extends DB{

    public function _construct(){
        parent::__construct(Comment::class,'comment');
    }

    public function getUserComments(int $id = null)
    {
        $query = (new QueryBuilder())
            ->select('c, u')/// p.id as post_id, u.id as user_id,
            ->from(PREFIXE_DB.'comment', 'c')
            ->join(PREFIXE_DB.'user', 'u');
            
            if($id) {
                $query->where('p.author = :iduser')
                ->setParameter('iduser', $id);
            }
            return $query->getQuery()
            ->getArrayResult(Post::class);
    }
}