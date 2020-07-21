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
    public function getFilmComments( $id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'comment', 'c');
            
                if(isset($id)){
                    $query->where('c.target = :target')
                    ->setParameters('target', $id);
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
  
    public function getAuthor($user_id = null)
    {
        $query = (new QueryBuilder())
        ->select('c.id, comment, post_date, user_id,target, target_type')
        ->from(DB_PREFIXE.'comment' , 'c')
        ->join(DB_PREFIXE.'user u','c.user_id','id');

        if(isset($user_id)){
            $query->where('c.user_id = :idcomment')
            ->setParameters('idcomment', $user_id);
        }
        
        return $query->getQuery()
            ->getArrayResult(Comment::class);
        
    }
 }