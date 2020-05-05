<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

     /**
      * @return Category[] Returns an array of Category objects
      */

    public function list()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function sort()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->andWhere('c.id < 15')
            ->getQuery()
            ->getResult()
            ;
    }

//    public function findAllEmailAlphabetical()
//    {
//        return $this->createQueryBuilder('u')
//            ->orderBy('u.email', 'ASC')
//            ->getQuery()
//            ->execute()
//            ;
//    }



}
