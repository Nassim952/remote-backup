<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\User;

class UserManager extends DB{

    public function _construct(){
        parent::__construct(User::class,'users');
    }

    public function create(User $user){
        {
            $query = (new QueryBuilder())
                ->select('u.login')/// u.id as user_id,
                ->from(DB_PREFIXE.'user', 'u');
            
                if($id) {
                    $query->where('u.id = :iduser')
                    ->setParameters('iduser', $id);
                }
                return $query->getQuery()
                ->getArrayResult(User::class);
        }
    }

    public function read($id = null){
        {
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'user', 'u');
            
                if(isset($id)){
                    $query->where('u.id = :iduser')
                    ->setParameters('iduser', $id);
                }
                return $query->getQuery()
                ->getArrayResult(User::class);
        }
    }

    public function getUserStatut($id){
        {
            $query = (new QueryBuilder())
                ->select('u.statut')/// u.id as user_id,
                ->from(DB_PREFIXE.'user', 'u');
            
                if($id) {
                    $query->where('u.id = :iduser')
                    ->setParameters('iduser', $id);
                }
                return $query->getQuery()
                ->getArrayResult(User::class);
        }
    }

    public function getUserAllow($id){
        {
            $query = (new QueryBuilder())
                ->select('u.Allow')/// u.id as user_id,
                ->from(DB_PREFIXE.'user', 'u');
            
                if($id) {
                    $query->where('u.id = :iduser')
                    ->setParameters('iduser', $id);
                }
                return $query->getQuery()
                ->getArrayResult(User::class);
        }
    }

    
    public function checkUserInDb($email, $password, $users)
    {
        foreach ($users as $user) {
            if ($user->getEmail() == $email && $user->getPassword() == $password) {
                return $user;
            }
        }
    }

    public function checkSave($email, $password, $users)
    {
        foreach ($users as $value) {
            if ($value->getEmail() == $email && $value->getPassword() == $password) {
                return true;
            }
        }
    }

    public function getTypeUser()
    {
        if(isset($_SESSION))
        {
            $typeUser = $_SESSION['user']['type'];
            return $typeUser;
        }
    }

    public function getUserByToken($token)
    {
        $query = (new QueryBuilder())
                ->select()
                ->from(DB_PREFIXE.'user', 'u')
                ->where('u.token = :token')
                ->setParameters('token', $token);
        return $query->getQuery()
            ->getArrayResult(User::class);
    }

}