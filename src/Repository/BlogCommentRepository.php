<?php

namespace App\Repository;

use App\Entity\BlogComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlogComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogComment[]    findAll()
 * @method BlogComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogComment::class);
    }
    public function findAllComBlog()
    {
        return $this->createQueryBuilder('e')
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    // /**
    //  * @return BlogComment[] Returns an array of BlogComment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogComment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
