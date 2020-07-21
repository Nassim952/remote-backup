<?php

namespace cms\managers;

use cms\core\DB;
use cms\core\Builder\QueryBuilder;
use cms\models\MovieReservation;

class MovieReservationManager extends DB{

    public function _construct(){
        parent::__construct(MovieReservation::class,'MovieReservation');
    }

    public function read($id = null){
            $query = (new QueryBuilder())
                ->select('*')
                ->from(DB_PREFIXE.'movie_reservation', 'mr');
            
                if(isset($id)){
                    $query->where('mr.id = :idmoviereservation')
                    ->setParameters('idmoviereservation', $id);
                }
                return $query->getQuery()
                ->getArrayResult(MovieReservation::class);
    }

    public function getSeance($cinema_id = null, $movie_id = null, $date = null){
        $query = (new QueryBuilder())
                ->select('ms.id, ms.date_screaning, ms.movie_id, ms.room_id, r.nbr_places, ms.nbr_place_rest, m.title, r.name_room, c.name')
                ->from(DB_PREFIXE.'movie_session', 'ms')
                ->join(DB_PREFIXE.'movie m', 'ms.movie_id', 'id')
                ->join(DB_PREFIXE.'room r', 'ms.room_id', 'id')
                ->join(DB_PREFIXE.'cinema c', 'r.cinema_id', 'id');

                if(!empty($cinema_id)){
                    $query->where('c.id = :idcinema')
                    ->setParameters('idcinema', $cinema_id);
                }
                if(!empty($movie_id)){
                    $query->where('m.id = :idmovie')
                    ->setParameters('idmovie', $movie_id);
                }
                if(!empty($date)){
                    $query->where('ms.date_screaning LIKE :datescreaning')
                    ->setParameters('datescreaning', $date.'%');
                }
            
                return $query->getQuery()
                ->getArrayResult();
    }

    public function getReservations($user_email = null, $cinema_id = null, $movie_id = null, $date = null){
        $query = (new QueryBuilder())
                ->select('mr.id, mr.user_email, ms.date_screaning, ms.id, mr.nbr_places, m.title, r.name_room, c.name')
                ->from(DB_PREFIXE.'movie_session', 'ms')
                ->join(DB_PREFIXE.'movie_reservation mr', 'ms.id', 'movie_session_id')
                ->join(DB_PREFIXE.'movie m', 'ms.movie_id', 'id')
                ->join(DB_PREFIXE.'room r', 'ms.room_id', 'id')
                ->join(DB_PREFIXE.'cinema c', 'r.cinema_id', 'id');

                if(!empty($user_email)){
                    $query->where('mr.user_email = :user_email')
                    ->setParameters('user_email', $user_email);
                }
                if(!empty($cinema_id)){
                    $query->where('c.id = :idcinema')
                    ->setParameters('idcinema', $cinema_id);
                }
                if(!empty($movie_id)){
                    $query->where('m.id = :idmovie')
                    ->setParameters('idmovie', $movie_id);
                }
                if(!empty($date)){
                    $query->where('ms.date_screaning LIKE :datescreaning')
                    ->setParameters('datescreaning', $date.'%');
                }

                return $query->getQuery()
                ->getArrayResult();
    }

    public function deleteMovieReservation($id)
    {
        $this->delete($id);
    }
}