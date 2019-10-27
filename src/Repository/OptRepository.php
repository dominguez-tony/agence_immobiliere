<?php

namespace App\Repository;

use App\Entity\Opt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Opt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Opt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Opt[]    findAll()
 * @method Opt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Opt::class);
    }

    // /**
    //  * @return Opt[] Returns an array of Opt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Opt
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
