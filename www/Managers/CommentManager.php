<?php

namespace cms\Managers;

use cms\core\DB;

class CommentManager extends DB{

    public function _construct(){
        parent::_construct(Comment::class,'comment');
    }

    public function getUserComment(int $id)
    {
        return (new QueryBuilder())
        ->select('c.*,u.*')
        ->from(PREFIXE_DB.'comment', 'c')
        ->join(PREFIXE_DB.'user', 'u')
        ->where('c.author =: iduser', $id)
        ->setParameter('iduser',$id)
        ->getQuery()
        ->getArrayResult(Comment::class);
    }

}