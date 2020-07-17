<?php

namespace cms\Managers;

use cms\core\DB;
use cms\core\builder\QueryBuilder;
use cms\models\Comment;

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

    public function read($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'comment', 'c');
            
                if(isset($id)){
                    $query->where('c.id = :idcomment')
                    ->setParameters('idcomment', $id);
                }
                return $query->getQuery()
                ->getArrayResult(Comment::class);
           
        }
    }
    
    // fonction qui supprime un element de la base de donnée
    public function deleteComment($id)
    {
        $this->delete($id);
    }
  
    // SELECT c.id, comment, post_date,user_id,target, target_type FROM `bape_comment` as c JOIN `bape_user` AS u WHERE c.user_id = 5
    public function getAuthor($id)
    {
        $query = (new QueryBuilder())
        ->select('c.id, comment, post_date, user_id,target, target_type')
        ->from(DB_PREFIXE.'comment', 'c')
        ->join(DB_PREFIXE.'user','u');

        if(isset($id)){
            $query->where('c.user_id = :idcomment')
            ->setParameters('idcomment', $id);
        }
        
        return $query->getQuery()
            ->getArrayResult(Comment::class);
        
    }
 }