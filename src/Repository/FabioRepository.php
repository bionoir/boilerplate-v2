<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Fabio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * 
 * @template T of Fabio
 * @template-extends ServiceEntityRepository<Fabio>
 * 
 * @method Fabio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fabio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fabio[]    findAll()
 * @method Fabio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * 
 */
class FabioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fabio::class);
    }

    // /**
    //  * @return Fabio[] Returns an array of Fabio objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fabio
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
