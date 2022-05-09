<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    function tri_asc()
{
    return $this->createQueryBuilder('categorie')
    ->orderBy('categorie.nameCategorie ','ASC')
    ->getQuery()->getResult();
}
    function tri_desc()
{
    return $this->createQueryBuilder('categorie')
        ->orderBy('categorie.nameCategorie ','DESC')
        ->getQuery()->getResult();
}

    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByname($categorie)
    {
        return $this->createQueryBuilder('r')
            ->where('r.nameCategorie Like :Nom')
            ->setParameter('Nom', '%'.$categorie.'%')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findBynameBack($categorie)
    {
        return $this->createQueryBuilder('r')
            ->where('r.nameCategorie Like :Nom')
            ->setParameter('Nom', '%'.$categorie.'%')
            ->getQuery()
            ->getResult()
            ;
    }
}
