<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;



/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }


    /**
      * @return Query
    */

    public function findAllVisibleQuery(PropertySearch $search)
    {

        $query =  $this->findVisibleQuery();


        if($search->getMaxPrince())
        {

            $query = $query->andwhere('p.prince  <= :maxPrince')
                           ->setParameter('maxPrince', $search->getMaxPrince());
        }

        if($search->getMinSurface())
        {

            $query = $query->andwhere('p.surface  >= :minSurface')
                           ->setParameter('minSurface', $search->getMinSurface());
        }

        if($search->getOpt()->count() > 0)
        {
            $k = 0;
          foreach ($search->getOpt() as $opt)
          {
              $k++;
                $query = $query
                    ->andWhere(":opt$k MEMBER OF p.opts")
                    ->setParameter("opt$k", $opt);
          }
        }

       return $query->getQuery();
      



    }

     /**
      * @return Property[] Returns an array of Property objects
    */

    public function findLatest(): array
    {

        return $this->createQueryBuilder('p')->Where('p.sold = false')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();


    }

    /**
     * @return Querybuilder
     */
    

    private function findVisibleQuery()
    {

        return $this->createQueryBuilder('p')
        ->Where('p.sold = false');


    }
    

}
