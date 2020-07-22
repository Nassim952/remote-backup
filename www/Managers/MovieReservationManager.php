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
                ->select('ms.id, ms.date_screaning, ms.movie_id, ms.room_id, r.nbr_places, ms.nbr_place_rest, m.title, r.name_room, c.name, c.id as cinema_id')
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
                ->select('mr.id as id_resa, mr.user_email, ms.date_screaning, ms.id, mr.nbr_places, m.title, r.name_room, c.name')
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

    public function getNbrPlaceReserved($movie_session_id){
        $query = (new QueryBuilder())
                ->select('sum(mr.nbr_places)')
                ->from(DB_PREFIXE.'movie_reservation', 'mr')
                ->where('mr.movie_session_id = :movie_session_id')
                ->setParameters('movie_session_id', $movie_session_id);

                return $query->getQuery()
                ->getValueResult();
    }

    public function getTotalReservation($frequences = "monthly"){
        $year_select = '';
        $year_groupBy = '';
        $month_select = '';
        $month_groupBy = '';
        $day_select = '';
        $day_groupBy = '';
        
        if($frequences === "yearly") {
            $year_select = ', Year(ms.date_screaning) as year'; 
            $year_groupBy = ' Year(ms.date_screaning)'; 
        }

        if($frequences === "monthly") {    
            $month_select = ',Month(ms.date_screaning) as month, Year(ms.date_screaning) as year'; 
            $month_groupBy = 'Month(ms.date_screaning), Year(ms.date_screaning)'; 
        }

        if($frequences === "daily") {    
            $day_select = ',Day(ms.date_screaning) as day, Month(ms.date_screaning) as month, Year(ms.date_screaning) as year'; 
            $day_groupBy = 'Day(ms.date_screaning), Month(ms.date_screaning), Year(ms.date_screaning)'; 
        }
           

        $query = (new QueryBuilder())
                ->select('SUM(mr.nbr_places) as total' . $day_select . $month_select . $year_select)
                ->from(DB_PREFIXE.'movie_reservation', 'mr');
        
                $query->setAlias('mr');

                $query->join(DB_PREFIXE.'movie_session ms', 'movie_session_id', 'id')
                ->groupBy($day_groupBy . $month_groupBy . $year_groupBy);

                return $query->getQuery()
                ->getArrayResult();
    }

    public function deleteMovieReservation($id)
    {
        $this->delete($id);
    }
}