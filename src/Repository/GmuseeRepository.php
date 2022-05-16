<?php

namespace App\Repository;

use App\Entity\Gmusee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gmusee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gmusee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gmusee[]    findAll()
 * @method Gmusee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GmuseeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gmusee::class);
    }
    public function findGmuseeByNom($nom): mixed
    {
        return $this->createQueryBuilder('gmusee')
            ->where('gmusee.nom LIKE :nom')
            ->setParameter('nom', '%'.$nom.'%')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Gmusee[] Returns an array of Gmusee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gmusee
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
