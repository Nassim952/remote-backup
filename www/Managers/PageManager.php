<?php 
namespace cms\managers;

use cms\core\Builder\QueryBuilder;
use cms\core\DB;
use cms\models\Page;

class PageManager extends DB
{
    public function _construct()
    {   
        parent::__construct(Page::class, 'page');
        
    }

    // fonction qui liste les elements de la base de données
    public function read($id = null){
        $query = (new QueryBuilder())
        ->select('*')
        ->from(DB_PREFIXE.'page', ' ');
        if (isset($id)){
            $query->where('p.id = :idpage')
            ->setParameters(('idpage'),$id);
        }
        return $query->getQuery()
        ->getArrayResult(Page::class);
    
    }

    // fonction qui supprime un element de la base de donnée
    public function deletePage($id)
    {
        $this->delete($id);
    }
}